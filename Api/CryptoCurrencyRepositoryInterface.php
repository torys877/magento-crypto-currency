<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Api;

use Crypto\CryptoCurrency\Api\Data\CurrencyAddressInterface;
use Crypto\CryptoCurrency\Model\ResourceModel\Blockchain\Collection as BlockchainCollection;
use Crypto\CryptoCurrency\Model\ResourceModel\CurrencyAddress\Collection as CurrencyAddressCollection;
use Crypto\Currency\Api\CurrencyRepositoryInterface;

interface CryptoCurrencyRepositoryInterface extends CurrencyRepositoryInterface
{
    /**
     * @param string $currencyCode
     * @return BlockchainCollection
     */
    public function getAllCurrencyBlockchainsByCode(string $currencyCode): BlockchainCollection;

    /**
     * @param string $currencyCode
     * @return bool
     */
    public function isCurrencyActive(string $currencyCode): bool;

    /**
     * @param string $currencyCode
     * @return CurrencyAddressCollection
     */
    public function getAllCurrencyAddressesByCode(string $currencyCode): CurrencyAddressCollection;

    /**
     * @param int $currencyId
     * @param int $blockchainNetworkId
     * @return CurrencyAddressInterface
     */
    public function getCurrencyAddress(int $currencyId, int $blockchainNetworkId): CurrencyAddressInterface;

    /**
     * @param string $blockchainCode
     * @param string $currencyCode
     * @return CurrencyAddressInterface
     */
    public function getCurrencyAddressByBlockchainCode(string $blockchainCode, string $currencyCode): CurrencyAddressInterface;
}
