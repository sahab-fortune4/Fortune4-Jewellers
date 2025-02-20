<?php

namespace Jewellers\FormSubmission\Controller\Adminhtml\Submission;


use Magento\Backend\App\Action\Context;

class Delete extends \Magento\Backend\App\Action
{
    private $collectionFactory;
    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        \Jewellers\FormSubmission\Model\SubmissionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * Delete item action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $entity_id = $this->getRequest()->getParam('entity_id');
        if ($entity_id) {
            try {
                // init model and delete
                $model = $this->collectionFactory->create()->load($entity_id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the item.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $entity_id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a item to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
