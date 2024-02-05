<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Model;

use Crypto\CryptoCurrency\Api\BlockchainRepositoryInterface;
use Crypto\CryptoCurrency\Api\CryptoCurrencyRepositoryInterface;
use Crypto\CryptoCurrency\Api\CurrencyAddressRepositoryInterface;
use Crypto\CryptoCurrency\Api\Data\BlockchainInterface;
use Crypto\CryptoCurrency\Api\Data\CryptoCurrencyInterface;
use Crypto\CryptoCurrency\Api\Data\CryptoCurrencyInterfaceFactory;
use Crypto\CryptoCurrency\Api\Data\CurrencyAddressInterface;
use Crypto\CryptoCurrency\Model\ResourceModel\Blockchain\Collection as BlockchainCollection;
use Crypto\CryptoCurrency\Model\ResourceModel\CurrencyAddress\Collection as CurrencyAddressCollection;
use Crypto\Currency\Api\Data\CurrencyInterface;
use Crypto\Currency\Model\CurrencyRepository;
use Crypto\Currency\Model\Data\Currency;
use Crypto\Currency\Model\Data\Currency as CurrencyEntity;
use Crypto\Currency\Model\Data\CurrencyFactory;
use Crypto\Currency\Model\ResourceModel\Currency as Resource;
use Crypto\Currency\Model\ResourceModel\Currency\Collection as CurrencyCollection;
use Crypto\Currency\Model\ResourceModel\Currency\CollectionFactory;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\NoSuchEntityException;

class CryptoCurrencyRepository extends CurrencyRepository implements CryptoCurrencyRepositoryInterface
{
    protected CurrencyAddressRepositoryInterface $currencyAddressRepository;
    protected BlockchainRepositoryInterface $blockchainRepository;
    protected SearchCriteriaBuilder $searchCriteriaBuilder;
    protected FilterBuilder $filterBuilder;
    protected CryptoCurrencyInterfaceFactory $cryptoCurrencyInterfaceFactory;

    public function __construct(
        Resource $resource,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory,
        CurrencyFactory $currencyFactory,
        CurrencyAddressRepositoryInterface $currencyAddressRepository,
        BlockchainRepositoryInterface $blockchainRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        CryptoCurrencyInterfaceFactory $cryptoCurrencyInterfaceFactory
    ) {
        parent::__construct(
            $resource,
            $collectionProcessor,
            $collectionFactory,
            $currencyFactory,
            $searchCriteriaBuilder
        );

        $this->currencyAddressRepository = $currencyAddressRepository;
        $this->blockchainRepository = $blockchainRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->cryptoCurrencyInterfaceFactory = $cryptoCurrencyInterfaceFactory;
    }

    public function getAllCurrencyBlockchainsByCode(string $currencyCode): BlockchainCollection
    {
        $currencyAddressCollection = $this->getAllCurrencyAddressesByCode($currencyCode);
        $blockchainIds = [];

        if ($currencyAddressCollection->count()) {
            foreach ($currencyAddressCollection->getItems() as $currencyAddressItem) {
                /** @var CurrencyAddressInterface $currencyAddressItem */
                $blockchainIds[] = $currencyAddressItem->getBlockchainNetworkId();
            }
        }

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(BlockchainInterface::ENTITY_ID, $blockchainIds, 'in')
            ->create();

        return $this->blockchainRepository->getList($searchCriteria);
    }

    public function getAllCurrencyAddressesByCode(string $currencyCode): CurrencyAddressCollection
    {
        /** @var CryptoCurrencyInterface $currency */
        $currency = $this->getByCode($currencyCode);
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(CurrencyAddressInterface::CURRENCY_ID, $currency->getId())
            ->create();

        $currencyAddressCollection = $this->currencyAddressRepository->getList($searchCriteria);

        return $currencyAddressCollection;
    }

    /**
     * @param string $currencyCode
     * @return bool
     */
    public function isCurrencyActive(string $currencyCode): bool
    {
        try {
            /** @var CryptoCurrencyInterface $currency */
            $currency = $this->getByCode($currencyCode);
            if (!$currency->getStatus() || !$currency->getIsCrypto()) {
                return false;
            }

            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter(CurrencyAddressInterface::CURRENCY_ID, $currency->getId())
                ->addFilter(CurrencyAddressInterface::MERCHANT_ADDRESS, null, 'notnull')
                ->create();

            $currencyAddressCollection = $this->currencyAddressRepository
                ->getList($searchCriteria);

            if ($currencyAddressCollection->count()) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }

    /**
     * Get all active currency where merchant address is defined
     *
     * @return CurrencyCollection
     */
    public function getAllActiveCurrencies(): CurrencyCollection
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(CurrencyInterface::STATUS, CurrencyInterface::STATUS_ENABLE)
            ->addFilter(CryptoCurrencyInterface::IS_CRYPTO, 1)
            ->create();

        $collection = $this->getList($searchCriteria);
//        $collection->getSelect()->joinInner(
//            ['ca' => CurrencyAddressResource::TABLE_NAME],
//            'main_table.entity_id = ca.currency_id',
//            [
//                CurrencyAddressInterface::BLOCKCHAIN_NETWORK_ID => 'ca.' . CurrencyAddressInterface::BLOCKCHAIN_NETWORK_ID,
//                CurrencyAddressInterface::TOKEN_ADDRESS => 'ca.' . CurrencyAddressInterface::TOKEN_ADDRESS,
//                CurrencyAddressInterface::MERCHANT_ADDRESS => 'ca.' . CurrencyAddressInterface::MERCHANT_ADDRESS,
//
//            ])
//            ->where(sprintf('ca.%s is not null', CurrencyAddressInterface::MERCHANT_ADDRESS));

        return $collection;
    }

    public function getCurrencyAddress(int $currencyId, int $blockchainNetworkId): CurrencyAddressInterface
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(CurrencyAddressInterface::BLOCKCHAIN_NETWORK_ID, $blockchainNetworkId)
            ->addFilter(CurrencyAddressInterface::CURRENCY_ID, $currencyId)
            ->create();

        $collection = $this->currencyAddressRepository->getList($searchCriteria);

        /** @var CurrencyAddressInterface $currencyAddress */
        $currencyAddress = $collection->getFirstItem();

        return $currencyAddress;
    }

    public function getByCode(string $currencyCode): CryptoCurrencyInterface
    {
        /** @var CurrencyEntity $currency */
        $cryptoCurrency = $this->cryptoCurrencyInterfaceFactory->create();
        $this->resource->load($cryptoCurrency, $currencyCode, CryptoCurrencyInterface::CODE);

        if (!$cryptoCurrency->getEntityId()) {
            throw new NoSuchEntityException(__('The crypto currency with the "%1" code doesn\'t exist.', $currencyCode));
        }

        return $cryptoCurrency;
    }

    public function getCurrencyAddressByBlockchainCode(string $blockchainCode, string $currencyCode): CurrencyAddressInterface
    {
        $currency = $this->getByCode($currencyCode);
        $blockchain = $this->blockchainRepository->getByCode($blockchainCode);

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(CurrencyAddressInterface::CURRENCY_ID, $currency->getId())
            ->addFilter(CurrencyAddressInterface::BLOCKCHAIN_NETWORK_ID, $blockchain->getId())
            ->create();

        return $this->currencyAddressRepository->getList($searchCriteria)->getFirstItem();
    }
}
