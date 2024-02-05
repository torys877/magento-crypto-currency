<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Api;

use Crypto\CryptoCurrency\Api\Data\BlockchainInterface;
use Crypto\CryptoCurrency\Model\ResourceModel\Blockchain\Collection;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

interface BlockchainRepositoryInterface
{
    /**
     * @param int $blockchainId
     * @return BlockchainInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $blockchainId): BlockchainInterface;

    /**
     * @param string $blockchainCode
     * @return BlockchainInterface
     * @throws NoSuchEntityException
     */
    public function getByCode(string $blockchainCode): BlockchainInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return Collection
     */
    public function getList(SearchCriteriaInterface $searchCriteria): Collection;

    /**
     * Save blockchain
     *
     * @param BlockchainInterface $blockchain
     * @return BlockchainInterface
     * @throws CouldNotSaveException
     */
    public function save(BlockchainInterface $blockchain): BlockchainInterface;

    /**
     * @return Collection
     */
    public function getAll(): Collection;
}
