# omnipay-tenpay

## Usage

```php
class TenpayController extends Yaf_Controller_Abstract
{
    public function purchaseAction()
    {
        $config = Yaf_Registry::get('config');
        $gateway = \Omnipay\Omnipay::create('Tenpay');
        $gateway->setPartner($config['tenpay']['partner']);
        $gateway->setKey($config['tenpay']['key']);
        $gateway->setReturnUrl($_POST['return_url']);
        $gateway->setNotifyUrl($_POST['notify_url']);
        $response = $gateway->purchase($_POST)->send();
	$this->redirect($response->getRedirectUrl());
        return false;
    }

    public function notifyAction()
    {
	$config = Yaf_Registry::get('config');
        $gateway = \Omnipay\Omnipay::create('Tenpay');
        $gateway->setPartner($config['tenpay']['partner']);
        $gateway->setKey($config['tenpay']['key']);
        $options = array('request_params'=> array_merge($_POST, $_GET));
        $response = $gateway->completePurchase($options)->send();
        if ($response->isPaid()) {
            $notifyData = $response->getRequestData();

            // 判断是否即时到帐
            if ($notifyData['trade_mode'] == 1) {
                $response = $gateway->query([
                    'notify_id' => $notifyData['notify_id']
                ])->send();

                if ($response->isPaid()) {
                    $queryData = $response->getData();
                    if ($notifyData['trade_state'] == 0 && $queryData['retcode'] == 0) {
                        $tradeOrderInfo = GetTradeOrderDetailInfo($notifyData['out_trade_no']);
                        if (bccomp((float)$tradeOrderInfo->Amount, (float)$notifyData['total_fee'], 2) === 0) {
				echo 'success';
                        }
                    }
                }
            }
        }
        echo "fail";
        return false;	
    }
}
```
