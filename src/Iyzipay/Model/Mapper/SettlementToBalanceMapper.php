<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\SettlementToBalance;

class SettlementToBalanceMapper extends SettlementToBalanceResourceMapper
{
    public static function create($rawResult = null)
    {
        return new SettlementToBalanceMapper($rawResult);
    }

    public function mapSettlementToBalanceFrom(SettlementToBalance $settlementToBalance, $jsonObject)
    {
        parent::mapSettlementToBalanceResourceFrom($settlementToBalance, $jsonObject);

        return $settlementToBalance;
    }

    public function mapSettlementToBalance(SettlementToBalance $settlementToBalance)
    {
        return $this->mapSettlementToBalanceFrom($settlementToBalance, $this->jsonObject);
    }
}
