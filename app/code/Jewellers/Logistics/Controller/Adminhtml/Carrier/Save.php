<?php

namespace Jewellers\Logistics\Controller\Adminhtml\Carrier;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Jewellers\Logistics\Model\Carrier;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var Purchased
     */
    protected $reviewData;

    /**
     * @var Session
     */
    protected $adminsession;

    /**
     * @param Action\Context $context
     * @param Purchased $reviewData
     * @param Session $adminsession
     */
    public function __construct(
        Action\Context $context,
        Purchased $reviewData,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->reviewData = $reviewData;
        $this->adminsession = $adminsession;
    }

    /**
     * Save blog record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();

        
        if ($data) {
            // if($data['data']['products']) {
            //     $data['product_id'] = implode(',', $data['data']['products']);
            // }
            // echo "<pre>";
            // print_r($data);
            // die;
            // $data['product_id'] = 0;
            $review_id = $this->getRequest()->getParam('id');
            if ($review_id) {
                $this->reviewData->load($review_id);
                $data['updated_at'] = date('Y-m-d H:i:s'); // Update the updated_at field
            }else {
                // When adding new record, we set created_at and updated_at
                $data['created_at'] = date('Y-m-d H:i:s'); // Set created_at for new records
                $data['updated_at'] = date('Y-m-d H:i:s'); // Set updated_at for new records
            }

            $this->reviewData->setData($data);

            try {
                $this->reviewData->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['id' => $this->reviewData->getId(), '_current' => true]);
                    }
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}