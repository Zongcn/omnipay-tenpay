<?php
namespace Omnipay\Tenpay;
use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Tenpay';
    }

    public function getDefaultParameters()
    {
        return array(
            'bank_type' => 'DEFAULT',
            'fee_type' => '1',
            'sign_type' => 'MD5',
            'service_version' => '1.0',
            'input_charset' => 'GBK',
            'sign_key_index' => '1',
            'trade_mode' => 1,
            'trans_type' => 1
        );
    }

    public function setKey($value)
    {
        $this->setParameter('key', $value);
    }

    public function setPartner($value)
    {
        return $this->setParameter('partner', $value);
    }

    public function setNotifyUrl($value)
    {
        return $this->setParameter('notify_url', $value);
    }


    public function setReturnUrl($value)
    {
        return $this->setParameter('return_url', $value);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Tenpay\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Tenpay\Message\PurchaseRequest', $parameters);
    }
    /**
     * @param array $parameters
     *
     * @return \Omnipay\Tenpay\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Tenpay\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Tenpay\Message\QueryNotifyRequest
     */
    public function query($parameters = array ())
    {
        return $this->createRequest('\Omnipay\Tenpay\Message\QueryNotifyRequest', $parameters);
    }
}