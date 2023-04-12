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
 * Time: 下午4:17
 */

namespace AppleIapVerify;

/**
 * Class InAppTransaction
 * @package AppleIapVerify
 *
 * @property-read  int $quantity
 * @property-read  string $product_id
 * @property-read string $transaction_id
 * @property-read string $original_transaction_id
 * @property-read string $purchase_date
 * @property-read string $purchase_date_ms
 * @property-read string $purchase_date_pst
 * @property-read string $is_trial_period
 * @property-read string $in_app_ownership_type
 */
class InAppTransaction
{
    protected $transaction = [];

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    public function toArray()
    {
        return $this->transaction;
    }

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this->transaction[$name] = $value;
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->transaction[$name] ?? null;
    }
}
