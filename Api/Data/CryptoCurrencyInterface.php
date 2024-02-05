<?php
/*
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Api\Data;

use Crypto\Currency\Api\Data\CurrencyInterface;

interface CryptoCurrencyInterface extends CurrencyInterface
{
    const IS_CRYPTO = "is_crypto";
    const IS_TOKEN = "is_token";
    const CRYPTO_CODE = "crypto_code";
    const ABI = "contract_abi";

    /**
     * Getter for Is Crypto.
     *
     * @return bool|null
     */
    public function getIsCrypto(): ?bool;

    /**
     * Setter for Is Crypto.
     *
     * @param bool|null $isCrypto
     *
     * @return void
     */
    public function setIsCrypto(?bool $isCrypto): self;

    /**
     * Getter for IsToken.
     *
     * @return bool|null
     */
    public function getIsToken(): ?bool;

    /**
     * Setter for IsToken.
     *
     * @param bool|null $isToken
     *
     * @return void
     */
    public function setIsToken(?bool $isToken): self;

    /**
     * Getter for Crypto Code.
     * @return string|null
     */
    public function getCryptoCode(): ?string;

    /**
     * Setter for Crypto Code.
     *
     * @param string $cryptoCode
     * @return self
     */
    public function setCryptoCode(string $cryptoCode): self;

    /**
     * Getter for Token ABI.
     * @return string|null
     */
    public function getAbi(): ?string;

    /**
     * Setter for Token ABI.
     *
     * @param string $abi
     * @return self
     */
    public function setAbi(string $abi): self;
}
