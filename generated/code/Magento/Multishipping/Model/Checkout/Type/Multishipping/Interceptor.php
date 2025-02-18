<?php
namespace Magento\Multishipping\Model\Checkout\Type\Multishipping;

/**
 * Interceptor class for @see \Magento\Multishipping\Model\Checkout\Type\Multishipping
 */
class Interceptor extends \Magento\Multishipping\Model\Checkout\Type\Multishipping implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Checkout\Model\Session $checkoutSession, \Magento\Customer\Model\Session $customerSession, \Magento\Sales\Model\OrderFactory $orderFactory, \Magento\Customer\Api\AddressRepositoryInterface $addressRepository, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\Session\Generic $session, \Magento\Quote\Model\Quote\AddressFactory $addressFactory, \Magento\Quote\Model\Quote\Address\ToOrder $quoteAddressToOrder, \Magento\Quote\Model\Quote\Address\ToOrderAddress $quoteAddressToOrderAddress, \Magento\Quote\Model\Quote\Payment\ToOrderPayment $quotePaymentToOrderPayment, \Magento\Quote\Model\Quote\Item\ToOrderItem $quoteItemToOrderItem, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Payment\Model\Method\SpecificationInterface $paymentSpecification, \Magento\Multishipping\Helper\Data $helper, \Magento\Sales\Model\Order\Email\Sender\OrderSender $orderSender, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, \Magento\Quote\Api\CartRepositoryInterface $quoteRepository, \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder, \Magento\Framework\Api\FilterBuilder $filterBuilder, \Magento\Quote\Model\Quote\TotalsCollector $totalsCollector, array $data = [], ?\Magento\Quote\Api\Data\CartExtensionFactory $cartExtensionFactory = null, ?\Magento\Directory\Model\AllowedCountries $allowedCountryReader = null, ?\Magento\Multishipping\Model\Checkout\Type\Multishipping\PlaceOrderFactory $placeOrderFactory = null, ?\Psr\Log\LoggerInterface $logger = null, ?\Magento\Framework\Api\DataObjectHelper $dataObjectHelper = null)
    {
        $this->___init();
        parent::__construct($checkoutSession, $customerSession, $orderFactory, $addressRepository, $eventManager, $scopeConfig, $session, $addressFactory, $quoteAddressToOrder, $quoteAddressToOrderAddress, $quotePaymentToOrderPayment, $quoteItemToOrderItem, $storeManager, $paymentSpecification, $helper, $orderSender, $priceCurrency, $quoteRepository, $searchCriteriaBuilder, $filterBuilder, $totalsCollector, $data, $cartExtensionFactory, $allowedCountryReader, $placeOrderFactory, $logger, $dataObjectHelper);
    }

    /**
     * {@inheritdoc}
     */
    public function getQuoteShippingAddressesItems()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getQuoteShippingAddressesItems');
        return $pluginInfo ? $this->___callPlugins('getQuoteShippingAddressesItems', func_get_args(), $pluginInfo) : parent::getQuoteShippingAddressesItems();
    }

    /**
     * {@inheritdoc}
     */
    public function removeAddressItem($addressId, $itemId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'removeAddressItem');
        return $pluginInfo ? $this->___callPlugins('removeAddressItem', func_get_args(), $pluginInfo) : parent::removeAddressItem($addressId, $itemId);
    }

    /**
     * {@inheritdoc}
     */
    public function setShippingItemsInformation($info)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setShippingItemsInformation');
        return $pluginInfo ? $this->___callPlugins('setShippingItemsInformation', func_get_args(), $pluginInfo) : parent::setShippingItemsInformation($info);
    }

    /**
     * {@inheritdoc}
     */
    public function updateQuoteCustomerShippingAddress($addressId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'updateQuoteCustomerShippingAddress');
        return $pluginInfo ? $this->___callPlugins('updateQuoteCustomerShippingAddress', func_get_args(), $pluginInfo) : parent::updateQuoteCustomerShippingAddress($addressId);
    }

    /**
     * {@inheritdoc}
     */
    public function setQuoteCustomerBillingAddress($addressId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setQuoteCustomerBillingAddress');
        return $pluginInfo ? $this->___callPlugins('setQuoteCustomerBillingAddress', func_get_args(), $pluginInfo) : parent::setQuoteCustomerBillingAddress($addressId);
    }

    /**
     * {@inheritdoc}
     */
    public function setShippingMethods($methods)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setShippingMethods');
        return $pluginInfo ? $this->___callPlugins('setShippingMethods', func_get_args(), $pluginInfo) : parent::setShippingMethods($methods);
    }

    /**
     * {@inheritdoc}
     */
    public function setPaymentMethod($payment)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setPaymentMethod');
        return $pluginInfo ? $this->___callPlugins('setPaymentMethod', func_get_args(), $pluginInfo) : parent::setPaymentMethod($payment);
    }

    /**
     * {@inheritdoc}
     */
    public function createOrders()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'createOrders');
        return $pluginInfo ? $this->___callPlugins('createOrders', func_get_args(), $pluginInfo) : parent::createOrders();
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'save');
        return $pluginInfo ? $this->___callPlugins('save', func_get_args(), $pluginInfo) : parent::save();
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'reset');
        return $pluginInfo ? $this->___callPlugins('reset', func_get_args(), $pluginInfo) : parent::reset();
    }

    /**
     * {@inheritdoc}
     */
    public function validateMinimumAmount()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'validateMinimumAmount');
        return $pluginInfo ? $this->___callPlugins('validateMinimumAmount', func_get_args(), $pluginInfo) : parent::validateMinimumAmount();
    }

    /**
     * {@inheritdoc}
     */
    public function getMinimumAmountDescription()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMinimumAmountDescription');
        return $pluginInfo ? $this->___callPlugins('getMinimumAmountDescription', func_get_args(), $pluginInfo) : parent::getMinimumAmountDescription();
    }

    /**
     * {@inheritdoc}
     */
    public function getMinimumAmountError()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getMinimumAmountError');
        return $pluginInfo ? $this->___callPlugins('getMinimumAmountError', func_get_args(), $pluginInfo) : parent::getMinimumAmountError();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderIds($asAssoc = false)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getOrderIds');
        return $pluginInfo ? $this->___callPlugins('getOrderIds', func_get_args(), $pluginInfo) : parent::getOrderIds($asAssoc);
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerDefaultBillingAddress()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomerDefaultBillingAddress');
        return $pluginInfo ? $this->___callPlugins('getCustomerDefaultBillingAddress', func_get_args(), $pluginInfo) : parent::getCustomerDefaultBillingAddress();
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerDefaultShippingAddress()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomerDefaultShippingAddress');
        return $pluginInfo ? $this->___callPlugins('getCustomerDefaultShippingAddress', func_get_args(), $pluginInfo) : parent::getCustomerDefaultShippingAddress();
    }

    /**
     * {@inheritdoc}
     */
    public function getCheckoutSession()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCheckoutSession');
        return $pluginInfo ? $this->___callPlugins('getCheckoutSession', func_get_args(), $pluginInfo) : parent::getCheckoutSession();
    }

    /**
     * {@inheritdoc}
     */
    public function getQuote()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getQuote');
        return $pluginInfo ? $this->___callPlugins('getQuote', func_get_args(), $pluginInfo) : parent::getQuote();
    }

    /**
     * {@inheritdoc}
     */
    public function getQuoteItems()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getQuoteItems');
        return $pluginInfo ? $this->___callPlugins('getQuoteItems', func_get_args(), $pluginInfo) : parent::getQuoteItems();
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerSession()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomerSession');
        return $pluginInfo ? $this->___callPlugins('getCustomerSession', func_get_args(), $pluginInfo) : parent::getCustomerSession();
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomer()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomer');
        return $pluginInfo ? $this->___callPlugins('getCustomer', func_get_args(), $pluginInfo) : parent::getCustomer();
    }

    /**
     * {@inheritdoc}
     */
    public function addData(array $arr)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'addData');
        return $pluginInfo ? $this->___callPlugins('addData', func_get_args(), $pluginInfo) : parent::addData($arr);
    }

    /**
     * {@inheritdoc}
     */
    public function setData($key, $value = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setData');
        return $pluginInfo ? $this->___callPlugins('setData', func_get_args(), $pluginInfo) : parent::setData($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function unsetData($key = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'unsetData');
        return $pluginInfo ? $this->___callPlugins('unsetData', func_get_args(), $pluginInfo) : parent::unsetData($key);
    }

    /**
     * {@inheritdoc}
     */
    public function getData($key = '', $index = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getData');
        return $pluginInfo ? $this->___callPlugins('getData', func_get_args(), $pluginInfo) : parent::getData($key, $index);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataByPath($path)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDataByPath');
        return $pluginInfo ? $this->___callPlugins('getDataByPath', func_get_args(), $pluginInfo) : parent::getDataByPath($path);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataByKey($key)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDataByKey');
        return $pluginInfo ? $this->___callPlugins('getDataByKey', func_get_args(), $pluginInfo) : parent::getDataByKey($key);
    }

    /**
     * {@inheritdoc}
     */
    public function setDataUsingMethod($key, $args = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setDataUsingMethod');
        return $pluginInfo ? $this->___callPlugins('setDataUsingMethod', func_get_args(), $pluginInfo) : parent::setDataUsingMethod($key, $args);
    }

    /**
     * {@inheritdoc}
     */
    public function getDataUsingMethod($key, $args = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getDataUsingMethod');
        return $pluginInfo ? $this->___callPlugins('getDataUsingMethod', func_get_args(), $pluginInfo) : parent::getDataUsingMethod($key, $args);
    }

    /**
     * {@inheritdoc}
     */
    public function hasData($key = '')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'hasData');
        return $pluginInfo ? $this->___callPlugins('hasData', func_get_args(), $pluginInfo) : parent::hasData($key);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(array $keys = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toArray');
        return $pluginInfo ? $this->___callPlugins('toArray', func_get_args(), $pluginInfo) : parent::toArray($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToArray(array $keys = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'convertToArray');
        return $pluginInfo ? $this->___callPlugins('convertToArray', func_get_args(), $pluginInfo) : parent::convertToArray($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function toXml(array $keys = [], $rootName = 'item', $addOpenTag = false, $addCdata = true)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toXml');
        return $pluginInfo ? $this->___callPlugins('toXml', func_get_args(), $pluginInfo) : parent::toXml($keys, $rootName, $addOpenTag, $addCdata);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToXml(array $arrAttributes = [], $rootName = 'item', $addOpenTag = false, $addCdata = true)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'convertToXml');
        return $pluginInfo ? $this->___callPlugins('convertToXml', func_get_args(), $pluginInfo) : parent::convertToXml($arrAttributes, $rootName, $addOpenTag, $addCdata);
    }

    /**
     * {@inheritdoc}
     */
    public function toJson(array $keys = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toJson');
        return $pluginInfo ? $this->___callPlugins('toJson', func_get_args(), $pluginInfo) : parent::toJson($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToJson(array $keys = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'convertToJson');
        return $pluginInfo ? $this->___callPlugins('convertToJson', func_get_args(), $pluginInfo) : parent::convertToJson($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function toString($format = '')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'toString');
        return $pluginInfo ? $this->___callPlugins('toString', func_get_args(), $pluginInfo) : parent::toString($format);
    }

    /**
     * {@inheritdoc}
     */
    public function __call($method, $args)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, '__call');
        return $pluginInfo ? $this->___callPlugins('__call', func_get_args(), $pluginInfo) : parent::__call($method, $args);
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isEmpty');
        return $pluginInfo ? $this->___callPlugins('isEmpty', func_get_args(), $pluginInfo) : parent::isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($keys = [], $valueSeparator = '=', $fieldSeparator = ' ', $quote = '"')
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'serialize');
        return $pluginInfo ? $this->___callPlugins('serialize', func_get_args(), $pluginInfo) : parent::serialize($keys, $valueSeparator, $fieldSeparator, $quote);
    }

    /**
     * {@inheritdoc}
     */
    public function debug($data = null, &$objects = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'debug');
        return $pluginInfo ? $this->___callPlugins('debug', func_get_args(), $pluginInfo) : parent::debug($data, $objects);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'offsetSet');
        return $pluginInfo ? $this->___callPlugins('offsetSet', func_get_args(), $pluginInfo) : parent::offsetSet($offset, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'offsetExists');
        return $pluginInfo ? $this->___callPlugins('offsetExists', func_get_args(), $pluginInfo) : parent::offsetExists($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'offsetUnset');
        return $pluginInfo ? $this->___callPlugins('offsetUnset', func_get_args(), $pluginInfo) : parent::offsetUnset($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'offsetGet');
        return $pluginInfo ? $this->___callPlugins('offsetGet', func_get_args(), $pluginInfo) : parent::offsetGet($offset);
    }
}
