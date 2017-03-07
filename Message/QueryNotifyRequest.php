<?php
namespace Omnipay\Tenpay\Message;
use Omnipay\Tenpay\Helper;

class QueryNotifyRequest extends AbstractRequest
{
    protected $endpoint = 'https://gw.tenpay.com/gateway/simpleverifynotifyid.xml';

    public function getData()
    {
        $this->validate('partner', 'key', 'notify_id');
        $data = array(
            'partner' => $this->getPartner(),
            'notify_id' => $this->getNotifyId()
        );
        $data['sign'] = Helper::createSign($data, $this->getKey());
        return $data;
    }

    public function setNotifyId($value)
    {
        $this->setParameter('notify_id', $value);
    }

    public function getNotifyId()
    {
        return $this->getParameter('notify_id');
    }

    public function sendData($data)
    {
        $requestUrl = "{$this->endpoint}?" . http_build_query($data);
        $request = $this->httpClient->get($requestUrl);
        $response = $request->send()->getBody();

        $response = Helper::xml2array($response);

        $sign = Helper::createSign($response, $this->getKey());
        $responseData = array();

        if (isset($response['sign']) && $response['sign'] && $sign === strtolower($response['sign'])) {
            $responseData['sign_match'] = true;
        } else {
            $responseData['sign_match'] = false;
        }

        if ($responseData['sign_match'] && isset($response['retcode']) && $response['retcode'] == 0) {
            $responseData['paid'] = true;
        } else {
            $responseData['paid'] = false;
        }

        return $this->response = new QueryNotifyResponse($this, $responseData);
    }
}