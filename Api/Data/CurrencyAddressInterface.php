<?php
/*
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */

namespace Crypto\CryptoCurrency\Api\Data;

interface CurrencyAddressInterface
{
    /**
     * String constants for property names
     */
    public const ENTITY_ID = "entity_id";
    public const BLOCKCHAIN_NETWORK_ID = "blockchain_network_id";
    public const CURRENCY_ID = "currency_id";
    public const TOKEN_ADDRESS = "token_address";
    public const MERCHANT_ADDRESS = "merchant_address";

    /**
     * Retrieve entity id
     *
     * @return mixed
     */
    public function getEntityId();

    /**
     * @param int $entityId
     * @return mixed
     */
    public function setEntityId($entityId);

    /**
     * Getter for NetworkId.
     *
     * @return int|null
     */
    public function getBlockchainNetworkId(): ?int;

    /**
     * Setter for NetworkId.
     *
     * @param int|null $networkId
     *
     * @return void
     */
    public function setBlockchainNetworkId(?int $networkId): self;

    /**
     * Getter for CurrencyId.
     *
     * @return int|null
     */
    public function getCurrencyId(): ?int;

    /**
     * Setter for CurrencyId.
     *
     * @param int|null $currencyId
     *
     * @return void
     */
    public function setCurrencyId(?int $currencyId): self;

    /**
     * Getter for TokenAddress.
     *
     * @return string|null
     */
    public function getTokenAddress(): ?string;

    /**
     * Setter for TokenAddress.
     *
     * @param string|null $currencyAddress
     *
     * @return void
     */
    public function setTokenAddress(?string $currencyAddress): self;

    /**
     * Getter for MerchantAddress.
     *
     * @return string|null
     */
    public function getMerchantAddress(): ?string;

    /**
     * Setter for MerchantAddress.
     *
     * @param string|null $merchantAddress
     *
     * @return void
     */
    public function setMerchantAddress(?string $merchantAddress): self;
}
