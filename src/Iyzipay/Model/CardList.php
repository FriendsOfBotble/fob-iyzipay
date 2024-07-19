<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\CardListMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\RetrieveCardListRequest;

class CardList extends IyzipayResource
{
    private $cardUserKey;
    private $cardDetails;

    public static function retrieve(RetrieveCardListRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/cardstorage/cards', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return CardListMapper::create($rawResult)->jsonDecode()->mapCardList(new CardList());
    }

    public function getCardUserKey()
    {
        return $this->cardUserKey;
    }

    public function setCardUserKey($cardUserKey)
    {
        $this->cardUserKey = $cardUserKey;
    }

    public function getCardDetails()
    {
        return $this->cardDetails;
    }

    public function setCardDetails($cardDetails)
    {
        $this->cardDetails = $cardDetails;
    }
}
