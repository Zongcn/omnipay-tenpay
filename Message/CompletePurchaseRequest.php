<?php
namespace Omnipay\Tenpay\Message;
use Omnipay\Tenpay\Helper;

class CompletePurchaseRequest extends AbstractRequest
{
    public function setRequestParams($requestParams)
    {
        $this->setParameter('request_params', $requestParams);
    }

    public function getRequestParams()
    {
        return $this->getParameter('request_params');
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $data = $this->getRequestParams();
        return $data;
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        $data = $this->getData();
        $sign = Helper::createSign($data, $this->getKey());

        $responseData = array ();
        if (isset($data['sign']) && $data['sign'] && $sign === strtolower($data['sign'])) {
            $responseData['sign_match'] = true;
        } else {
            $responseData['sign_match'] = false;
        }

        if ($responseData['sign_match'] && isset($data['trade_state']) && $data['trade_state'] == 0) {
            $responseData['paid'] = true;
        } else {
            $responseData['paid'] = false;
        }

        return $this->response = new CompletePurchaseResponse($this, $responseData);
    }

}