<?php
namespace Jewellers\Blog\Controller\Router;

/**
 * Interceptor class for @see \Jewellers\Blog\Controller\Router
 */
class Interceptor extends \Jewellers\Blog\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Jewellers\Blog\Service\PostIdChecker $postIdChecker, \Magento\Framework\App\ActionFactory $actionFactory)
    {
        $this->___init();
        parent::__construct($postIdChecker, $actionFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'match');
        return $pluginInfo ? $this->___callPlugins('match', func_get_args(), $pluginInfo) : parent::match($request);
    }
}
