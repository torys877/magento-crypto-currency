<?php
/*
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */

namespace Crypto\CryptoCurrency\Model\Data;

use Crypto\CryptoCurrency\Api\Data\CurrencyAddressInterface;
use Crypto\CryptoCurrency\Model\ResourceModel\CurrencyAddress as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class CurrencyAddress extends AbstractModel implements CurrencyAddressInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'crypto_blockchain_currency_address_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * Getter for NetworkId.
     *
     * @return int|null
     */
    public function getBlockchainNetworkId(): ?int
    {
        return $this->getData(self::BLOCKCHAIN_NETWORK_ID) === null ? null
            : (int)$this->getData(self::BLOCKCHAIN_NETWORK_ID);
    }

    /**
     * Setter for NetworkId.
     *
     * @param int|null $networkId
     *
     * @return void
     */
    public function setBlockchainNetworkId(?int $networkId): self
    {
        return $this->setData(self::BLOCKCHAIN_NETWORK_ID, $networkId);
    }

    /**
     * Getter for CurrencyId.
     *
     * @return int|null
     */
    public function getCurrencyId(): ?int
    {
        return $this->getData(self::CURRENCY_ID) === null ? null
            : (int)$this->getData(self::CURRENCY_ID);
    }

    /**
     * Setter for CurrencyId.
     *
     * @param int|null $currencyId
     *
     * @return void
     */
    public function setCurrencyId(?int $currencyId): self
    {
        return $this->setData(self::CURRENCY_ID, $currencyId);
    }

    /**
     * Getter for CurrencyAddress.
     *
     * @return string|null
     */
    public function getTokenAddress(): ?string
    {
        return $this->getData(self::TOKEN_ADDRESS);
    }

    /**
     * Setter for CurrencyAddress.
     *
     * @param string|null $currencyAddress
     *
     * @return void
     */
    public function setTokenAddress(?string $currencyAddress): self
    {
        return $this->setData(self::TOKEN_ADDRESS, $currencyAddress);
    }

    /**
     * Getter for MerchantAddress.
     *
     * @return string|null
     */
    public function getMerchantAddress(): ?string
    {
        return $this->getData(self::MERCHANT_ADDRESS);
    }

    /**
     * Setter for MerchantAddress.
     *
     * @param string|null $merchantAddress
     *
     * @return void
     */
    public function setMerchantAddress(?string $merchantAddress): self
    {
        return $this->setData(self::MERCHANT_ADDRESS, $merchantAddress);
    }
}
