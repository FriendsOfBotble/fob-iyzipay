<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\IyzipayResourceMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Subscription\SubscriptionDetails;

class SubscriptionDetailsResourceMapper extends IyzipayResourceMapper
{
    public static function create($rawResult = null)
    {
        return new SubscriptionDetailsResourceMapper($rawResult);
    }

    public function mapSubscriptionDetailsResourceFrom(SubscriptionDetails $create, $jsonObject)
    {
        parent::mapResourceFrom($create, $jsonObject);

        if (isset($jsonObject->data->referenceCode)) {
            $create->setReferenceCode($jsonObject->data->referenceCode);
        }
        if (isset($jsonObject->data->parentReferenceCode)) {
            $create->setParentReferenceCode($jsonObject->data->parentReferenceCode);
        }
        if (isset($jsonObject->data->pricingPlanReferenceCode)) {
            $create->setPricingPlanReferenceCode($jsonObject->data->pricingPlanReferenceCode);
        }
        if (isset($jsonObject->data->customerReferenceCode)) {
            $create->setCustomerReferenceCode($jsonObject->data->customerReferenceCode);
        }
        if (isset($jsonObject->data->subscriptionStatus)) {
            $create->setSubscriptionStatus($jsonObject->data->subscriptionStatus);
        }
        if (isset($jsonObject->data->trialDays)) {
            $create->setTrialDays($jsonObject->data->trialDays);
        }
        if (isset($jsonObject->data->trialStartDate)) {
            $create->setTrialStartDate($jsonObject->data->trialStartDate);
        }
        if (isset($jsonObject->data->trialEndDate)) {
            $create->setTrialEndDate($jsonObject->data->trialEndDate);
        }
        if (isset($jsonObject->data->createdDate)) {
            $create->setCreatedDate($jsonObject->data->createdDate);
        }
        if (isset($jsonObject->data->startDate)) {
            $create->setStartDate($jsonObject->data->startDate);
        }
        if (isset($jsonObject->data->endDate)) {
            $create->setEndDate($jsonObject->data->endDate);
        }
        if (isset($jsonObject->data->orders)) {
            $create->setOrders($jsonObject->data->orders);
        }
        if (isset($jsonObject->data->customerEmail)) {
            $create->setCustomerEmail($jsonObject->data->customerEmail);
        }
        if (isset($jsonObject->data->pricingPlanName)) {
            $create->setPricingPlanName($jsonObject->data->pricingPlanName);
        }
        if (isset($jsonObject->data->productName)) {
            $create->setProductName($jsonObject->data->productName);
        }
        if (isset($jsonObject->data->productReferenceCode)) {
            $create->setProductReferenceCode($jsonObject->data->productReferenceCode);
        }

        return $create;
    }

    public function mapSubscriptionDetails(SubscriptionDetails $subscriptionDetails)
    {
        return $this->mapSubscriptionDetailsResourceFrom($subscriptionDetails, $this->jsonObject);
    }
}
