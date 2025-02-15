<?php
namespace Jewellers\MetalPrice\Model;

use Magento\Framework\HTTP\Client\Curl; // For API requests
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface; // To load/save products
use Psr\Log\LoggerInterface; // For logging errors/debug info
use Magento\Framework\App\Config\ScopeConfigInterface; // For reading system configuration

class MetalPriceService
{
    protected $curl; 
    protected $productCollectionFactory; 
    protected $logger; 
    protected $scopeConfig;
    protected $productRepository;

    /**
     * Constructor.
     *
     * @param Curl $curl
     * @param ProductCollectionFactory $productCollectionFactory
     * @param LoggerInterface $logger
     * @param ScopeConfigInterface $scopeConfig
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        Curl $curl,
        ProductCollectionFactory $productCollectionFactory,
        LoggerInterface $logger,
        ScopeConfigInterface $scopeConfig,
        ProductRepositoryInterface $productRepository
    ) {
        $this->curl = $curl;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
        $this->productRepository = $productRepository;
    }

    /**
     * Fetch current metal rates from the external API.
     *
     * @return array Associative array of metal rates, e.g. ['gold' => 8190.3291, 'silver' => 92.7928, ...]
     */
    public function fetchMetalRates()
    {
        try {
            // For demo, we're hardcoding the API key and parameters.
            // In a real-world scenario, these should be stored in configuration.
            $apiKey = 'XXXXXXXX23232323'; // Replace with your actual API key.
            $currency = 'INR';
            $unit = 'g';

            // Build the API URL.
            $url = "https://api.metals.dev/v1/latest?api_key=" . $apiKey . "&currency=" . $currency . "&unit=" . $unit;

            // Set cURL options.
            $this->curl->setOption(CURLOPT_RETURNTRANSFER, true);
            $this->curl->setOption(CURLOPT_HTTPHEADER, ["Accept: application/json"]);

            // Execute the GET request.
            $this->curl->get($url);
            $response = $this->curl->getBody();
            $statusCode = $this->curl->getStatus();

            if ($statusCode != 200) {
                $this->logger->error("MetalPrice API returned status code: " . $statusCode);
                return [];
            }

            $data = json_decode($response, true);

            if (isset($data['status']) && $data['status'] === 'success') {
                if (isset($data['metals'])) {
                    return $data['metals'];
                }
                $this->logger->error("MetalPrice API response missing 'metals' key: " . $response);
                return [];
            } else {
                $this->logger->error("MetalPrice API error: " . $response);
                return [];
            }
        } catch (\Exception $e) {
            $this->logger->error("Exception while fetching metal rates: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Retrieve a product collection of products with metal attribute data.
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getProductsWithMetal()
    {
        // Create a product collection.
        $collection = $this->productCollectionFactory->create();
        
        // Select required attributes.
        $collection->addAttributeToSelect([
                'name',               
                'jewelry_type',       
                'making_charge',      
                'metal',              // The metal attribute (should be a dropdown with values like "Gold", "Silver", etc.)
                'purity',             // For gold, purity (e.g., 18, 22, or 24)
                'weight'              // Metal weight in grams
            ])
            ->addAttributeToFilter('metal', ['neq' => ''])  // Only products with a metal value.
            ->addAttributeToFilter('status', 1)             // Only enabled products.
            ->addFieldToFilter('type_id', 'simple');        // Only simple products, as an example.

        return $collection;
    }

    /**
     * Update product prices based on metal rates and product attributes.
     *
     * Calculation for gold:
     *   - effectiveRate = 24K rate adjusted by purity (e.g. 22K = rate * (22/24))
     * For other metals, effectiveRate = API rate.
     * 
     * Then, final price is:
     *   newPrice = (effectiveRate * weight) +
     *              (makingChargeAmount) +
     *              (GST on metal) +
     *              (GST on making charge)
     *
     * Where:
     *   - makingChargeAmount = baseMetalPrice * (makingChargePercent/100)
     *   - GST on metal = baseMetalPrice * (gstOnMetalsPercent/100)
     *   - GST on making charge = makingChargeAmount * (gstOnMakingChargePercent/100)
     *
     * @return void
     */
    public function updateProductPrices()
    {
        // For demonstration, we simulate the API response.
        // In a real scenario, call fetchMetalRates() to get the dynamic data.
        $metalRates = [
            'gold' => 8190.3291,   // 24K gold rate per gram
            'silver' => 92.7928,   // Silver rate per gram
            'platinum' => 2800.6105,
            'palladium' => 2795.7848,
            // add additional metals as needed.
        ];

        // GST percentages (these can also be set in configuration)
        $gstOnMetalsPercent = 3;          // e.g., 3% GST on metal value
        $gstOnMakingChargePercent = 5;    // e.g., 5% GST on making charge

        $collection = $this->getProductsWithMetal();

        foreach ($collection as $product) {
            // Get the metal type label (e.g., "Gold") and convert to lowercase for lookup.
            $metalType = strtolower($product->getAttributeText('metal'));
            // Get purity for gold (if applicable). Default to 24 if not set.
            $purity = (float)$product->getData('purity');
            if (!$purity) {
                $purity = 24;
            }
            // Get metal weight in grams.
            $metalWeight = (float)$product->getData('weight');
            // Get making charge percentage (e.g., 10 means 10%).
            $makingChargePercent = (float)$product->getData('making_charge');

            // Ensure that the API has returned a rate for the metal.
            if (isset($metalRates[$metalType])) {
                $rateFor24K = $metalRates[$metalType];
                // For gold, adjust the effective rate based on purity.
                if ($metalType === 'gold') {
                    switch ($purity) {
                        case 24:
                            $effectiveRate = $rateFor24K; // 24K gold uses the full rate.
                            break;
                        case 22:
                            $effectiveRate = $rateFor24K * (22 / 24); // 22K gold.
                            break;
                        case 18:
                            $effectiveRate = $rateFor24K * (18 / 24); // 18K gold.
                            break;
                        default:
                            $effectiveRate = $rateFor24K * ($purity / 24); // Default proportional calculation.
                            break;
                    }
                } else {
                    // For metals other than gold, simply use the API rate.
                    $effectiveRate = $rateFor24K;
                }

                // Calculate base metal price.
                $baseMetalPrice = $effectiveRate * $metalWeight;
                // Calculate making charge amount.
                $makingChargeAmount = $baseMetalPrice * ($makingChargePercent / 100);
                // Calculate GST on metal.
                $gstOnMetals = $baseMetalPrice * ($gstOnMetalsPercent / 100);
                // Calculate GST on making charge.
                $gstOnMakingCharge = $makingChargeAmount * ($gstOnMakingChargePercent / 100);

                // Final new price.
                $newPrice = $baseMetalPrice + $makingChargeAmount + $gstOnMetals + $gstOnMakingCharge;

                // Update product price.
                $product->setPrice($newPrice);
                try {
                    // Save product and log the update.
                    $this->productRepository->save($product);
                    $this->logger->debug("Updated product ID " . $product->getId() . " with new price: " . $newPrice);
                } catch (\Exception $e) {
                    $this->logger->error("Error updating product ID " . $product->getId() . ": " . $e->getMessage());
                }
            } else {
                $this->logger->error("Metal rate not found for product ID " . $product->getId());
            }
        }
    }
}
