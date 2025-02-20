<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By : Sahab Lal Gautam
 */
namespace Jewellers\FormSubmission\Block\Adminhtml\AdminMenu\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        $form_id = $this->context->getRequest()->getParam('entity_id');

        if ($form_id) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        $form_id = $this->context->getRequest()->getParam('entity_id');
        return $this->getUrl('*/*/delete', ['entity_id' => $form_id]);
    }
}