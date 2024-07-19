<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Customer;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;

class SubscriptionCreateCustomerRequest extends Request
{
    private $customer;

    public function __construct()
    {
        $this->customer =  new Customer();
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
        return JsonBuilder::fromJsonObject($this->getCustomer()->getJsonObject($this->getLocale(), $this->getConversationId()))
            ->getObject();
    }
}
