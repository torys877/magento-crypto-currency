<?php
/*
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */

namespace Crypto\CryptoCurrency\Model\Data;

use Crypto\CryptoCurrency\Api\Data\BlockchainInterface;
use Crypto\CryptoCurrency\Model\ResourceModel\Blockchain as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Blockchain extends AbstractModel implements BlockchainInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'crypto_blockchain_networks_model';

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
    public function getNetworkId(): ?int
    {
        return $this->getData(self::NETWORK_ID) === null ? null
            : (int)$this->getData(self::NETWORK_ID);
    }

    /**
     * Setter for NetworkId.
     *
     * @param int|null $networkId
     *
     * @return void
     */
    public function setNetworkId(?int $networkId): self
    {
        return $this->setData(self::NETWORK_ID, $networkId);
    }

    /**
     * Getter for Name.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /**
     * Setter for Name.
     *
     * @param string|null $name
     *
     * @return void
     */
    public function setName(?string $name): self
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Getter for BlockExplorerUrl.
     *
     * @return string|null
     */
    public function getBlockExplorerUrl(): ?string
    {
        return $this->getData(self::BLOCK_EXPLORER_URL);
    }

    /**
     * Setter for BlockExplorerUrl.
     *
     * @param string|null $blockExplorerUrl
     *
     * @return void
     */
    public function setBlockExplorerUrl(?string $blockExplorerUrl): self
    {
        return $this->setData(self::BLOCK_EXPLORER_URL, $blockExplorerUrl);
    }

    public function getCode(): ?string
    {
        return $this->getData(self::CODE) === null ? null
            : (string) $this->getData(self::CODE);
    }

    public function setCode(?string $code): self
    {
        return $this->setData(self::CODE, $code);
    }

    public function getIsBlockExplorerCheck(): ?bool
    {
        return $this->getData(self::IS_BLOCK_EXPLORER_CHECK) === null ? null
            : (bool)$this->getData(self::IS_BLOCK_EXPLORER_CHECK);
    }

    public function setIsBlockExplorerCheck(?bool $isCheck): BlockchainInterface
    {
        return $this->setData(self::IS_BLOCK_EXPLORER_CHECK, $isCheck);
    }

    public function getBlockExplorerApiUrl(): ?string
    {
        return $this->getData(self::BLOCK_EXPLORER_API_URL) === null ? null
            : (string)$this->getData(self::BLOCK_EXPLORER_API_URL);
    }

    public function setBlockExplorerApiUrl(?string $blockExplorerApiUrl): BlockchainInterface
    {
        return $this->setData(self::BLOCK_EXPLORER_API_URL, $blockExplorerApiUrl);
    }

    public function getBlockExplorerApiKey(): ?string
    {
        return $this->getData(self::BLOCK_EXPLORER_API_KEY) === null ? null
            : (string)$this->getData(self::BLOCK_EXPLORER_API_KEY);
    }

    public function setBlockExplorerApiKey(?string $blockExplorerApiKey): BlockchainInterface
    {
        return $this->setData(self::BLOCK_EXPLORER_API_KEY, $blockExplorerApiKey);
    }
}
