<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Ui\Component\Form;

use Crypto\CryptoCurrency\Model\ResourceModel\Blockchain\CollectionFactory as BlockchainCollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class BlockchainDataProvider extends AbstractDataProvider
{
    public function __construct(
        BlockchainCollectionFactory $blockchainCollectionFactory,
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $blockchainCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
}
