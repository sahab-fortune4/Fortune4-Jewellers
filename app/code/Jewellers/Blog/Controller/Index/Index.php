<?php

declare(strict_types=1);

namespace Jewellers\Blog\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultInterface;

class Index implements HttpGetActionInterface
{
    public function __construct(private PageFactory $pageFactory)
    {}

    public function execute(): ResultInterface
    {
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set(__('Blog'));

        return $page;
    }
}
