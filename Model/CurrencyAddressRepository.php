<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Model;

use Crypto\CryptoCurrency\Api\BlockchainRepositoryInterface;
use Crypto\CryptoCurrency\Api\CurrencyAddressRepositoryInterface;
use Crypto\CryptoCurrency\Api\Data\CurrencyAddressInterface;
use Crypto\CryptoCurrency\Model\Data\CurrencyAddress as CurrencyAddressEntity;

use Crypto\CryptoCurrency\Model\Data\CurrencyAddressFactory;
use Crypto\CryptoCurrency\Model\ResourceModel\CurrencyAddress as CurrencyAddress;
use Crypto\CryptoCurrency\Model\ResourceModel\CurrencyAddress\Collection;
use Crypto\CryptoCurrency\Model\ResourceModel\CurrencyAddress\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class CurrencyAddressRepository implements CurrencyAddressRepositoryInterface
{
    private CurrencyAddress $currencyAddressResource;
    private CurrencyAddressFactory $currencyAddressFactory;
    private CollectionProcessorInterface $collectionProcessor;
    private CollectionFactory $collectionFactory;
    private BlockchainRepositoryInterface $blockchainRepository;
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    public function __construct(
        CurrencyAddress $currencyAddressResource,
        CurrencyAddressFactory $currencyAddressFactory,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory,
        BlockchainRepositoryInterface $blockchainRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->currencyAddressResource = $currencyAddressResource;
        $this->currencyAddressFactory = $currencyAddressFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
        $this->blockchainRepository = $blockchainRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getById(int $currencyAddressId): CurrencyAddressInterface
    {
        /** @var CurrencyAddressEntity $currencyAddress */
        $currencyAddress = $this->currencyAddressFactory->create();
        $this->currencyAddressResource->load($currencyAddress, $currencyAddressId);

        if (!$currencyAddress->getEntityId()) {
            throw new NoSuchEntityException(__('The currency address with the "%1" ID doesn\'t exist.', $currencyAddressId));
        }

        return $currencyAddress;
    }

    public function getList(SearchCriteriaInterface $searchCriteria): Collection
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        return $collection;
    }

    public function save(CurrencyAddressInterface $currencyAddress): CurrencyAddressInterface
    {
        try {
            $this->currencyAddressResource->save($currencyAddress);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $currencyAddress;
    }
}
