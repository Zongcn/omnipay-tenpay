<?php
namespace Omnipay\Tenpay\Message;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return true;
    }


    public function getRedirectUrl()
    {
        if ($this->getRedirectMethod() == 'GET') {
            $reqPar = "";
            $parameters = $this->getRedirectData();
            ksort($parameters);
            foreach($parameters as $k => $v) {
                $reqPar .= $k . "=" . urlencode($v) . "&";
            }

            //去掉最后一个&
            $reqPar = substr($reqPar, 0, strlen($reqPar)-1);

            return $this->getRequest()->getEndpoint() . "?" . $reqPar;
        } else {
            return $this->getRequest()->getEndpoint();
        }
    }


    public function getRedirectMethod()
    {
        return 'GET';
    }


    public function getRedirectData()
    {
        return $this->data;
    }
}