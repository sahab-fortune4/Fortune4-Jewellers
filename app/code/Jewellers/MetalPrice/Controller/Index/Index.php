<?php
namespace Jewellers\MetalPrice\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    /**
     * @var \Jewellers\MetalPrice\Model\MetalPriceService
     */
    protected $metalPriceService;

    /**
     * Constructor.
     *
     * @param Context $context
     * @param \Jewellers\MetalPrice\Model\MetalPriceService $metalPriceService
     */
    public function __construct(
        Context $context,
        \Jewellers\MetalPrice\Model\MetalPriceService $metalPriceService
    ) {
        parent::__construct($context);
        $this->metalPriceService = $metalPriceService;
    }

    /**
     * Execute method called when the controller is accessed.
     *
     * This method triggers the update of product prices based on metal rates.
     *
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute()
    {
        // Call the service method that updates product prices.
        $this->metalPriceService->updateProductPrices();

        // Create a raw result to display a simple message.
        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $resultRaw->setContents("Price update complete.");
        return $resultRaw;
    }
}
