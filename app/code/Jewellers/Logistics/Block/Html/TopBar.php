<?php

namespace Jewellers\Logistics\Block\Html;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;

class TopBar extends Template
{
    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Constructor
     *
     * @param Template\Context      $context
     * @param CustomerSession       $customerSession
     * @param ScopeConfigInterface  $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param array                 $data
     */
    public function __construct(
        Template\Context $context,
        CustomerSession $customerSession,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->scopeConfig     = $scopeConfig;
        $this->storeManager    = $storeManager;
        parent::__construct($context, $data);
    }

    /**
     * Check if customer is logged in
     *
     * @return bool
     */
    public function isCustomerLoggedIn()
    {
        return $this->customerSession->isLoggedIn();
    }

    /**
     * Get Customer Account URL
     *
     * @return string
     */
    public function getCustomerAccountUrl()
    {
        return $this->getUrl('customer/account');
    }

    /**
     * Get Customer Login URL
     *
     * @return string
     */
    public function getCustomerLoginUrl()
    {
        return $this->getUrl('customer/account/login');
    }

    /**
     * Get Customer Register URL
     *
     * @return string
     */
    public function getCustomerRegisterUrl()
    {
        return $this->getUrl('customer/account/create');
    }

    public function getStoreUrl()
    {
        return $this->getBaseUrl();
    }


    public function getCurrentCurrencyCode()
    {
        return $this->storeManager->getStore()->getCurrentCurrencyCode();
    }

    /**
     * Get Customer Logout URL
     *
     * @return string
     */
    public function getLogoutUrl()
    {
        return $this->getUrl('customer/account/logout');
    }

    /**
     * Retrieve store address from configuration
     *
     * @return string|null
     */
    public function getStoreAddress()
    {
        return $this->scopeConfig->getValue(
            'general/store_information/street_line1',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Retrieve store phone number from configuration
     *
     * @return string|null
     */
    public function getStorePhoneNumber()
    {
        return $this->scopeConfig->getValue(
            'general/store_information/phone',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Retrieve gold 18k price from configuration
     *
     * @return string|null
     */
    public function getGold18kPrice()
    {
        return $this->scopeConfig->getValue(
            'general/metalprice/gold_18k_price',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Retrieve gold 22k price from configuration
     *
     * @return string|null
     */
    public function getGold22kPrice()
    {
        return $this->scopeConfig->getValue(
            'general/metalprice/gold_22k_price',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Retrieve gold 24k price from configuration
     *
     * @return string|null
     */
    public function getGold24kPrice()
    {
        return $this->scopeConfig->getValue(
            'general/metalprice/gold_24k_price',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Retrieve silver price from configuration
     *
     * @return string|null
     */
    public function getSilverPrice()
    {
        return $this->scopeConfig->getValue(
            'general/metalprice/silver_price',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
