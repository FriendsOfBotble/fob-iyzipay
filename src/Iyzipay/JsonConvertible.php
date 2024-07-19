<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay;

interface JsonConvertible
{
    public function getJsonObject();

    public function toJsonString();
}
