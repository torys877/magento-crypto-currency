<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Controller\Adminhtml;

use Crypto\CryptoCurrency\Model\BlockchainRepository;
use Crypto\CryptoCurrency\Model\CurrencyAddressRepository;
use Crypto\CryptoCurrency\Model\Data\BlockchainFactory;
use Crypto\CryptoCurrency\Model\Data\CurrencyAddressFactory;
use Crypto\CryptoCurrency\Model\ResourceModel\Blockchain;
use Crypto\CryptoCurrency\Model\ResourceModel\CurrencyAddress;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Controller\Result\JsonFactory;

abstract class Entity extends Action
{
    protected Context $context;
    protected BlockchainRepository $blockchainRepository;
    protected CurrencyAddressRepository $currencyAddressRepository;
    protected BlockchainFactory $blockchainFactory;
    protected CurrencyAddressFactory $currencyAddressFactory;
    protected JsonFactory $jsonFactory;
    protected ForwardFactory $resultForwardFactory;
    protected Blockchain $blockchainResource;
    protected CurrencyAddress $currencyAddressResource;

    public function __construct(
        Context $context,
        BlockchainRepository $blockchainRepository,
        CurrencyAddressRepository $currencyAddressRepository,
        BlockchainFactory $blockchainFactory,
        CurrencyAddressFactory $currencyAddressFactory,
        JsonFactory $jsonFactory,
        ForwardFactory $resultForwardFactory,
        Blockchain $blockchainResource,
        CurrencyAddress $currencyAddressResource
    ) {
        $this->blockchainRepository = $blockchainRepository;
        $this->currencyAddressRepository = $currencyAddressRepository;
        $this->blockchainFactory = $blockchainFactory;
        $this->currencyAddressFactory = $currencyAddressFactory;
        $this->jsonFactory = $jsonFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->blockchainResource = $blockchainResource;
        $this->currencyAddressResource = $currencyAddressResource;

        parent::__construct($context);
    }
}
