<?php

namespace Jewellers\FormSubmission\Controller\Adminhtml\Submission;

use Magento\Backend\App\Action\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\View\Result\PageFactory;

class Add extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ProductRepositoryInterface $productRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->productRepository = $productRepository;
    }

    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Jewellers_FormSubmission::submission');
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Jewellers_FormSubmission::submission');
        $resultPage->addBreadcrumb(__('Custom Form'), __('Custom Form'));
        $resultPage->getConfig()->getTitle()->prepend(__('Add Custom Form'));

      
        return $resultPage;
    }

}
