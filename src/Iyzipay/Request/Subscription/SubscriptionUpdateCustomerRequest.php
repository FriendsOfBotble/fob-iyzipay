<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Customer;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;

class SubscriptionUpdateCustomerRequest extends Request
{
    private $customer;
    private $customerReferenceCode;

    public function __construct()
    {
        $this->customer =  new Customer();
    }

    public function getCustomerReferenceCode()
    {
        return $this->customerReferenceCode;
    }

    public function setCustomerReferenceCode($customerReferenceCode)
    {
        $this->customerReferenceCode = $customerReferenceCode;
    }
    public function getCustomer()
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject($this->getCustomer()->getJsonObject($this->getLocale(), $this->getConversationId(), $this->getCustomerReferenceCode()))
            ->getObject();
    }
}
