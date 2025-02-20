<?php
namespace Jewellers\FormSubmission\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Jewellers\FormSubmission\Model\SubmissionFactory;
use Magento\Framework\Controller\Result\Redirect;

class Save extends Action
{
    protected $submissionFactory;

    public function __construct(
        Context $context,
        SubmissionFactory $submissionFactory
    ) {
        parent::__construct($context);
        $this->submissionFactory = $submissionFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            try {
                $submission = $this->submissionFactory->create();
                $submission->setData($data);
                $submission->save();
                $this->messageManager->addSuccessMessage(__('Your form has been submitted successfully.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Unable to submit your form. Please try again.'));
            }
        }
        // Redirect back to the referring page
        return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
    }
}
