<?php
namespace Omnipay\Tenpay;

class Helper
{
    public static function createSign($data, $key) {
        $signPars = "";
        ksort($data);
        foreach($data as $k => $v) {
            if("" != $v && "sign" != $k) {
                $signPars .= $k . "=" . $v . "&";
            }
        }
        $signPars .= "key=" . $key;
        return strtolower(md5($signPars));
    }

    //获取xml编码
    public static function getXmlEncode($xml) {
        $ret = preg_match ("/<?xml[^>]* encoding=\"(.*)\"[^>]* ?>/i", $xml, $arr);
        if($ret) {
            return strtoupper ( $arr[1] );
        } else {
            return "";
        }
    }

    public static function xml2array($xml)
    {
        $xmlArray = array();
        $xml = simplexml_load_string($xml);
        $encode = self::getXmlEncode($xml);

        if($xml && $xml->children()) {
            foreach ($xml->children() as $node) {
                //有子节点
                if ($node->children()) {
                    $k = $node->getName();
                    $nodeXml = $node->asXML();
                    $v = substr($nodeXml, strlen($k)+2, strlen($nodeXml)-2*strlen($k)-5);

                } else {
                    $k = $node->getName();
                    $v = (string)$node;
                }

                if ($encode !="" && $encode != "UTF-8") {
                    $k = iconv("UTF-8", $encode, $k);
                    $v = iconv("UTF-8", $encode, $v);
                }

                $xmlArray[$k] = $v;
            }
        }

        return $xmlArray;
    }
}