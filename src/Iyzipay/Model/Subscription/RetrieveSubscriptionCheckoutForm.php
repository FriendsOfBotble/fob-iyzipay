<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Subscription\RetrieveSubscriptionCheckoutFormMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription\RetrieveSubscriptionCreateCheckoutFormRequest;

class RetrieveSubscriptionCheckoutForm extends IyzipayResource
{
    private $referenceCode;
    private $parentReferenceCode;
    private $pricingPlanReferenceCode;
    private $customerReferenceCode;
    private $subscriptionStatus;
    private $trialDays;
    private $trialStartDate;
    private $trialEndDate;
    private $createdDate;
    private $startDate;
    private $endDate;

    public static function retrieve(RetrieveSubscriptionCreateCheckoutFormRequest $request, Options $options)
    {
        $uri = $options->getBaseUrl() . '/v2/subscription/checkoutform/' . $request->getCheckoutFormToken();
        $rawResult = parent::httpClient()->getV2($uri, parent::getHttpHeadersV2($uri, $request, $options), $request->toJsonString());

        return RetrieveSubscriptionCheckoutFormMapper::create($rawResult)->jsonDecode()->mapSubscriptionCreateCheckoutForm(new RetrieveSubscriptionCheckoutForm());
    }

    public function getReferenceCode()
    {
        return $this->referenceCode;
    }
    public function setReferenceCode($referenceCode)
    {
        $this->referenceCode = $referenceCode;
    }
    public function getParentReferenceCode()
    {
        return $this->parentReferenceCode;
    }
    public function setParentReferenceCode($parentReferenceCode)
    {
        $this->parentReferenceCode = $parentReferenceCode;
    }
    public function getPricingPlanReferenceCode()
    {
        return $this->pricingPlanReferenceCode;
    }
    public function setPricingPlanReferenceCode($pricingPlanReferenceCode)
    {
        $this->pricingPlanReferenceCode = $pricingPlanReferenceCode;
    }
    public function getCustomerReferenceCode()
    {
        return $this->customerReferenceCode;
    }
    public function setCustomerReferenceCode($customerReferenceCode)
    {
        $this->customerReferenceCode= $customerReferenceCode;
    }
    public function getSubscriptionStatus()
    {
        return $this->subscriptionStatus;
    }
    public function setSubscriptionStatus($subscriptionStatus)
    {
        $this->subscriptionStatus = $subscriptionStatus;
    }
    public function getTrialDays()
    {
        return $this->trialDays;
    }
    public function setTrialDays($trialDays)
    {
        $this->trialDays = $trialDays;
    }
    public function getTrialStartDate()
    {
        return $this->trialStartDate;
    }
    public function setTrialStartDate($trialStartDate)
    {
        $this->trialStartDate = $trialStartDate;
    }
    public function getTrialEndDate()
    {
        return $this->trialEndDate;
    }
    public function setTrialEndDate($trialEndDate)
    {
        $this->trialEndDate = $trialEndDate;
    }
    public function getCreatedDate()
    {
        return $this->createdDate;
    }
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }
    public function getStartDate()
    {
        return $this->startDate;
    }
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }
    public function getEndDate()
    {
        return $this->endDate;
    }
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }
}
