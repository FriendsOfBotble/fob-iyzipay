<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\IyzipayResourceMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Subscription\RetrieveList;

class RetrieveListResourceMapper extends IyzipayResourceMapper
{
    public static function create($rawResult = null)
    {
        return new RetrieveListResourceMapper($rawResult);
    }

    public function mapRetrieveListResourceFrom(RetrieveList $create, $jsonObject)
    {
        parent::mapResourceFrom($create, $jsonObject);

        if (isset($jsonObject->data->totalCount)) {
            $create->setTotalCount($jsonObject->data->totalCount);
        }
        if (isset($jsonObject->data->currentPage)) {
            $create->setCurrentPage($jsonObject->data->currentPage);
        }
        if (isset($jsonObject->data->pageCount)) {
            $create->setPageCount($jsonObject->data->pageCount);
        }
        if (isset($jsonObject->data->items)) {
            $create->setItems($jsonObject->data->items);
        }

        return $create;
    }

    public function mapRetrieveList(RetrieveList $retrieveList)
    {
        return $this->mapRetrieveListResourceFrom($retrieveList, $this->jsonObject);
    }
}
