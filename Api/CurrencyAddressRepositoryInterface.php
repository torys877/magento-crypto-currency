<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Api;

use Crypto\CryptoCurrency\Api\Data\CurrencyAddressInterface;
use Crypto\CryptoCurrency\Model\ResourceModel\CurrencyAddress\Collection;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

interface CurrencyAddressRepositoryInterface
{
    /**
     * @param int $currencyAddressId
     * @return CurrencyAddressInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $currencyAddressId): CurrencyAddressInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return Collection
     */
    public function getList(SearchCriteriaInterface $searchCriteria): Collection;

    /**
     * Save currency address entity
     *
     * @param CurrencyAddressInterface $currencyAddress
     * @return CurrencyAddressInterface
     * @throws CouldNotSaveException
     */
    public function save(CurrencyAddressInterface $currencyAddress): CurrencyAddressInterface;
}
