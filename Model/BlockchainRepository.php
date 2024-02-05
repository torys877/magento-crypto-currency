<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Model;

use Crypto\CryptoCurrency\Api\BlockchainRepositoryInterface;
use Crypto\CryptoCurrency\Api\Data\BlockchainInterface;
use Crypto\CryptoCurrency\Model\Data\Blockchain as BlockchainEntity;
use Crypto\CryptoCurrency\Model\Data\BlockchainFactory;
use Crypto\CryptoCurrency\Model\ResourceModel\Blockchain as BlockchainResource;
use Crypto\CryptoCurrency\Model\ResourceModel\Blockchain\Collection;

use Crypto\CryptoCurrency\Model\ResourceModel\Blockchain\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class BlockchainRepository implements BlockchainRepositoryInterface
{
    private BlockchainResource $blockchainResource;
    private BlockchainFactory $blockchainFactory;
    private CollectionProcessorInterface $collectionProcessor;
    private CollectionFactory $collectionFactory;

    public function __construct(
        BlockchainResource $blockchainResource,
        BlockchainFactory $blockchainFactory,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory
    ) {
        $this->blockchainResource = $blockchainResource;
        $this->blockchainFactory = $blockchainFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
    }

    public function getById(int $blockchainId): BlockchainInterface
    {
        /** @var BlockchainEntity $blockchain */
        $blockchain = $this->blockchainFactory->create();
        $this->blockchainResource->load($blockchain, $blockchainId);

        if (!$blockchain->getEntityId()) {
            throw new NoSuchEntityException(__('The blockchain with the "%1" ID doesn\'t exist.', $blockchainId));
        }

        return $blockchain;
    }

    public function getByCode(string $blockchainCode): BlockchainInterface
    {
        /** @var BlockchainEntity $blockchain */
        $blockchain = $this->blockchainFactory->create();
        $this->blockchainResource->load($blockchain, $blockchainCode, BlockchainInterface::CODE);

        if (!$blockchain->getEntityId()) {
            throw new NoSuchEntityException(__('The blockchain with the "%1" code doesn\'t exist.', $blockchainCode));
        }

        return $blockchain;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): Collection
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        return $collection;
    }

    public function save(BlockchainInterface $blockchain): BlockchainInterface
    {
        try {
            $this->blockchainResource->save($blockchain);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $blockchain;
    }

    public function getAll(): Collection
    {
        return $this->collectionFactory->create();
    }
}
