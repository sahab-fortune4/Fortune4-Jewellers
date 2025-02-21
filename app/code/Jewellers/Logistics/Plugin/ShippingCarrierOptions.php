<?php
namespace Jewellers\Logistics\Plugin;

use Magento\Shipping\Model\Config\Source\Carrier as CarrierSource;
use Jewellers\Logistics\Model\ResourceModel\Carrier\CollectionFactory as CarrierCollectionFactory;

class ShippingCarrierOptions
{
    /**
     * @var CarrierCollectionFactory
     */
    protected $carrierCollectionFactory;

    public function __construct(
        CarrierCollectionFactory $carrierCollectionFactory
    ) {
        $this->carrierCollectionFactory = $carrierCollectionFactory;
    }

    /**
     * Merge custom carrier options from your custom table into the default options.
     *
     * @param CarrierSource $subject
     * @param array $result Default carrier options array.
     * @return array Merged array of carrier options.
     */
    public function afterToOptionArray(CarrierSource $subject, $result)
    {
        // Fetch custom carriers from the custom table.
        $customCarriers = $this->carrierCollectionFactory->create();
        $customOptions = [];
        foreach ($customCarriers as $carrier) {
            // Assuming your table has 'carrier_id' and 'name' fields.
            $customOptions[] = [
                'value' => $carrier->getId(),
                'label' => $carrier->getTitle()
            ];
        }

        // Merge the custom options into the default options.
        return array_merge($result, $customOptions);
    }
}
