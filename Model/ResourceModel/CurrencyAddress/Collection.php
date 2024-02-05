<?php
/*
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */

namespace Crypto\CryptoCurrency\Model\ResourceModel\CurrencyAddress;

use Crypto\CryptoCurrency\Model\Data\CurrencyAddress as Model;
use Crypto\CryptoCurrency\Model\ResourceModel\CurrencyAddress as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'crypto_blockchain_currency_address_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
