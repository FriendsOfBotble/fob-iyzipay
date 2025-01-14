<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Card;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\CardList;

class CardListMapper extends IyzipayResourceMapper
{
    public static function create($rawResult = null)
    {
        return new CardListMapper($rawResult);
    }

    public function mapCardListFrom(CardList $cardList, $jsonObject)
    {
        parent::mapResourceFrom($cardList, $jsonObject);

        if (isset($jsonObject->cardUserKey)) {
            $cardList->setCardUserKey($jsonObject->cardUserKey);
        }
        if (isset($jsonObject->cardDetails)) {
            $cardList->setCardDetails($this->mapCardDetails($jsonObject->cardDetails));
        }

        return $cardList;
    }

    public function mapCardList(CardList $cardList)
    {
        return $this->mapCardListFrom($cardList, $this->jsonObject);
    }

    private function mapCardDetails($cardDetails)
    {
        $cards = [];

        foreach ($cardDetails as $index => $cardDetail) {
            $cards[$index] = CardMapper::create()->mapCardFrom(new Card(), $cardDetail);
        }

        return $cards;
    }
}
