<?php
/*
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */

namespace Crypto\CryptoCurrency\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CurrencyAddress extends AbstractDb
{
    public const TABLE_NAME = 'crypto_blockchain_currency_address';
    /**
     * @var string
     */
    protected $_eventPrefix = 'crypto_blockchain_currency_address_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, 'entity_id');
        $this->_useIsObjectNew = true;
    }
}
