<?php
/*
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */

namespace Crypto\CryptoCurrency\Api\Data;

interface BlockchainInterface
{
    /**
     * String constants for property names
     */
    public const ENTITY_ID = "entity_id";
    public const NETWORK_ID = "network_id";
    public const CODE = "code";
    public const NAME = "name";
    public const BLOCK_EXPLORER_URL = "block_explorer_url";
    public const IS_BLOCK_EXPLORER_CHECK = "is_block_explorer_check";
    public const BLOCK_EXPLORER_API_URL = "block_explorer_api_url";
    public const BLOCK_EXPLORER_API_KEY = "block_explorer_api_key";

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
    public function getNetworkId(): ?int;

    /**
     * Setter for NetworkId.
     *
     * @param int|null $networkId
     *
     * @return void
     */
    public function setNetworkId(?int $networkId): self;

    /**
     * Getter for Name.
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Setter for Name.
     *
     * @param string|null $name
     *
     * @return void
     */
    public function setName(?string $name): self;

    /**
     * Getter for Code.
     *
     * @return string|null
     */
    public function getCode(): ?string;

    /**
     * Setter for Code.
     *
     * @param string|null $code
     *
     * @return void
     */
    public function setCode(?string $code): self;

    /**
     * Getter for BlockExplorerUrl.
     *
     * @return string|null
     */
    public function getBlockExplorerUrl(): ?string;

    /**
     * Setter for BlockExplorerUrl.
     *
     * @param string|null $blockExplorerUrl
     *
     * @return void
     */
    public function setBlockExplorerUrl(?string $blockExplorerUrl): self;

    /**
     * Getter for block explorer check.
     *
     * @return bool|null
     */
    public function getIsBlockExplorerCheck(): ?bool;

    /**
     * Setter for block explorer check.
     *
     * @param bool|null $isCheck
     *
     * @return void
     */
    public function setIsBlockExplorerCheck(?bool $isCheck): self;

    /**
     * Getter for block explorer api url.
     *
     * @return string|null
     */
    public function getBlockExplorerApiUrl(): ?string;

    /**
     * Setter for block explorer api url.
     *
     * @param string|null $blockExplorerApiUrl
     *
     * @return void
     */
    public function setBlockExplorerApiUrl(?string $blockExplorerApiUrl): self;

    /**
     * Getter for block explorer api key.
     *
     * @return string|null
     */
    public function getBlockExplorerApiKey(): ?string;

    /**
     * Setter for block explorer api key.
     *
     * @param string|null $blockExplorerApiKey
     *
     * @return void
     */
    public function setBlockExplorerApiKey(?string $blockExplorerApiKey): self;
}
