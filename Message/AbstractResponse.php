<?php
namespace Omnipay\Tenpay\Message;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        $data = $this->getData();

        return isset($data['return_code']) && $data['return_code'] == 'SUCCESS';
    }
}