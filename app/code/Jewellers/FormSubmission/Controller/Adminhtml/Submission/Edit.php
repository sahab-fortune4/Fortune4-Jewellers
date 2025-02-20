<?php
namespace Jewellers\FormSubmission\Controller\Adminhtml\Submission;

use Magento\Framework\Controller\ResultFactory;
use Jewellers\FormSubmission\Model\Submission;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        // Create a result page
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Record'));
        return $resultPage;
    }
}
