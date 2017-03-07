<?php
namespace Omnipay\Tenpay\Message;

class QueryNotifyResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return $this->isPaid();
    }

    public function isPaid()
    {
        $data = $this->getData();

        return $data['paid'];
    }

    public function isSignMatch()
    {
        $data = $this->getData();

        return $data['sign_match'];
    }

    public function getRequestData()
    {
        return $this->request->getData();
    }
}