<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;

class UCSInitializeRequest extends Request
{
    private $email;
    private $gsmNumber;

    public function getGsmNumber()
    {
        return $this->gsmNumber;
    }

    public function setGsmNumber($gsmNumber)
    {
        $this->gsmNumber = $gsmNumber;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email= $email;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add('email', $this->getEmail())
            ->add('gsmNumber', $this->getGsmNumber())
            ->getObject();
    }
}
