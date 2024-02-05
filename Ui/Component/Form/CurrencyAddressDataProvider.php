<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Ui\Component\Form;

use Crypto\CryptoCurrency\Model\ResourceModel\CurrencyAddress\CollectionFactory as CurrencyAddressCollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class CurrencyAddressDataProvider extends AbstractDataProvider
{
    public function __construct(
        CurrencyAddressCollectionFactory $collectionFactory,
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
}
