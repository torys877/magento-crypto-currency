<?php

/*
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */

namespace Crypto\CryptoCurrency\Model\Data;

use Crypto\CryptoCurrency\Api\Data\CryptoCurrencyInterface;
use Crypto\Currency\Model\Data\Currency;

class CryptoCurrency extends Currency implements CryptoCurrencyInterface
{
    public function getIsCrypto(): ?bool
    {
        return $this->getData(self::IS_CRYPTO) === null ? null
            : (bool)$this->getData(self::IS_CRYPTO);
    }

    public function setIsCrypto(?bool $isCrypto): CryptoCurrencyInterface
    {
        return $this->setData(self::IS_CRYPTO, $isCrypto);
    }

    /**
     * Getter for IsToken.
     *
     * @return bool|null
     */
    public function getIsToken(): ?bool
    {
        return $this->getData(self::IS_TOKEN) === null ? null
            : (bool)$this->getData(self::IS_TOKEN);
    }

    /**
     * Setter for IsToken.
     *
     * @param bool|null $isToken
     *
     * @return void
     */
    public function setIsToken(?bool $isToken): self
    {
        return $this->setData(self::IS_TOKEN, $isToken);
    }

    public function getCryptoCode(): ?string
    {
        return $this->getData(self::CRYPTO_CODE) === null ? null
            : (string)$this->getData(self::CRYPTO_CODE);
    }

    public function setCryptoCode(string $cryptoCode): CryptoCurrencyInterface
    {
        return $this->setData(self::CRYPTO_CODE, $cryptoCode);
    }

    public function getAbi(): ?string
    {
        return $this->getData(self::ABI) === null ? null
            : (string)$this->getData(self::ABI);
    }

    public function setAbi(string $abi): CryptoCurrencyInterface
    {
        return $this->setData(self::ABI, $abi);
    }
}
