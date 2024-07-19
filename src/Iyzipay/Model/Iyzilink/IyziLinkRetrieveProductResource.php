<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Iyzilink;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;

class IyziLinkRetrieveProductResource extends IyzipayResource
{
    private $item;

    public function getItem()
    {
        return $this->item;
    }

    public function setItem($item)
    {
        $this->item = $item;
    }
}
