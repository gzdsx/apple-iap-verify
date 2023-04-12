<?php
/**
 * ============================================================================
 * Copyright (c) 2015-2023 贵州大师兄信息技术有限公司 All rights reserved.
 * siteַ: https://www.gzdsx.cn
 * ============================================================================
 * @author:     David Song<songdewei@163.com>
 * @version:    v1.0.0
 * ---------------------------------------------
 * Date: 2023/4/12
 * Time: 下午4:06
 */

namespace AppleIapVerify;

/**
 * Class VerifyClient
 * @package AppleIapVerify
 */
class VerifyClient
{
    private static $secret; // APP固定**，在itunes中获取
    private $password; // APP固定**，在itunes中获取
    private $receipt_data;

    public function __construct($password = null)
    {
        if ($password) {
            $this->password = $password;
        } else {
            $this->password = static::$secret;
        }
    }

    public static function register($secret)
    {
        static::$secret = $secret;
    }

    /**
     * @param mixed $password
     * @return VerifyClient
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param mixed $receipt_data
     * @return VerifyClient
     */
    public function setReceiptData($receipt_data)
    {
        $this->receipt_data = $receipt_data;
        return $this;
    }

    /**
     * @param int $sandbox
     * @return VerifyResponse
     */
    public function verify($sandbox = 0)
    {
        $this->password = $this->password ?: static::$secret;
        $json = $this->acurl($sandbox);
        return new VerifyResponse(json_decode($json, true));
    }

    private function acurl($sandbox = 0)
    {
        $POSTFIELDS = json_encode([
            "receipt-data" => $this->receipt_data,
            'password' => $this->password
        ]);

        //正式购买地址 沙盒购买地址
        $url_buy = "https://buy.itunes.apple.com/verifyReceipt";
        $url_sandbox = "https://sandbox.itunes.apple.com/verifyReceipt";
        $url = $sandbox ? $url_sandbox : $url_buy;

        //简单的curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDS);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
