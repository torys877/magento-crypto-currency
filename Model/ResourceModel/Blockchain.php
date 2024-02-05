<?php
/*
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */

namespace Crypto\CryptoCurrency\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Blockchain extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'crypto_blockchain_networks_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('crypto_blockchain_networks', 'entity_id');
        $this->_useIsObjectNew = true;
    }
}
