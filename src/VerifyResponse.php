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
 * Time: 下午4:14
 */

namespace AppleIapVerify;

/**
 * Class VerifyResponse
 * @package AppleIapVerify
 *
 * @property-read array $receipt
 * @property-read string $environment
 * @property-read int $status
 */
class VerifyResponse
{
    protected $response = [];
    protected $statusMap = [
        '21000' => 'App Store不能读取你提供的JSON对象',
        '21002' => 'receipt-data域的数据有问题',
        '21003' => 'receipt无法通过验证',
        '21004' => '提供的shared secret不匹配你账号中的shared secret',
        '21005' => 'receipt服务器当前不可用',
        '21006' => 'receipt合法，但是订阅已过期。服务器接收到这个状态码时，receipt数据仍然会解码并一起发送',
        '21007' => 'receipt是Sandbox receipt，但却发送至生产系统的验证服务',
        '21008' => 'receipt是生产receipt，但却发送至Sandbox环境的验证服务'
    ];

    public function __construct($response = [])
    {
        $this->response = $response;
    }

    public function isSuccess()
    {
        return $this->status == 0;
    }

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this->response[$name] = $value;
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->response[$name] ?? null;
    }
}
