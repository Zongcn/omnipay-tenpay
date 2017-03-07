<?php
namespace Omnipay\Tenpay\Message;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Tenpay\Helper;

class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate(
            'key',
            'subject',
            'body',
            'out_trade_no',
            'total_fee',
            'notify_url',
            'spbill_create_ip'
        );

        $data = array(
            'partner' => $this->getPartner(),
            'out_trade_no' => $this->getOutTradeNo(),
            'total_fee' => $this->getTotalFee(),
            'return_url' => $this->getReturnUrl(),
            'notify_url' => $this->getNotifyUrl(),
            'body' => $this->getBody(),
            'subject' => $this->getSubject(),
            'bank_type' => 'DEFAULT',
            'fee_type' => 1,
            'sign_type' => 'MD5',
            'service_version' => '1.0',
            'input_charset' => 'utf-8',
            'sign_key_index' => 1,
            'trade_mode' => 1,
            'spbill_create_ip' => $this->getSpbillCreateIp()
        );
        $data['sign'] = Helper::createSign($data, $this->getKey());
        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}