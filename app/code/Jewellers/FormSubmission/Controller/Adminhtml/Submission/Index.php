<?php
namespace Jewellers\FormSubmission\Controller\Adminhtml\Submission;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
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

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Jewellers_FormSubmission::submission');
        $resultPage->addBreadcrumb(__('Form Submission Data'), __('Form Submission Data'));
        $resultPage->getConfig()->getTitle()->prepend(__('Form Submission Data'));
        return $resultPage;
    }
}
