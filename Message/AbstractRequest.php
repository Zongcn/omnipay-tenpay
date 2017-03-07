<?php
namespace Omnipay\Tenpay\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $endpoint = 'https://gw.tenpay.com/gateway/pay.htm';

    public function getKey()
    {
        return $this->getParameter('key');
    }

    public function setKey($value)
    {
        $this->setParameter('key', $value);
    }

    public function getPartner()
    {
        return $this->getParameter('partner');
    }

    public function setPartner($value)
    {
        $this->setParameter('partner', $value);
    }

    public function getOutTradeNo()
    {
        return $this->getParameter('out_trade_no');
    }


    public function setOutTradeNo($value)
    {
        $this->setParameter('out_trade_no', $value);
    }

    public function getTotalFee()
    {
        return $this->getParameter('total_fee');
    }

    public function setTotalFee($value)
    {
        $this->setParameter('total_fee', $value);
    }

    public function getReturnUrl()
    {
        return $this->getParameter('return_url');
    }

    public function setReturnUrl($value)
    {
        $this->setParameter('return_url', $value);
    }

    public function getNotifyUrl()
    {
        return $this->getParameter('notify_url');
    }

    public function setNotifyUrl($value)
    {
        $this->setParameter('notify_url', $value);
    }

    public function getBody()
    {
        return $this->getParameter('body');
    }

    public function setBody($value)
    {
        $this->setParameter('body', $value);
    }

    public function getSubject()
    {
        return $this->getParameter('subject');
    }

    public function setSubject($value)
    {
        $this->setParameter('subject', $value);
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function getSpbillCreateIp()
    {
        return $this->getParameter('spbill_create_ip');
    }

    public function setSpbillCreateIp($value)
    {
        $this->setParameter('spbill_create_ip', $value);
    }
}