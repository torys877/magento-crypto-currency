<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Controller\Adminhtml\Currencyaddress;

use Crypto\CryptoCurrency\Api\Data\CurrencyAddressInterface;
use Crypto\CryptoCurrency\Controller\Adminhtml\Entity;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Entity implements HttpPostActionInterface
{
    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create($this->resultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*');
        //@TODO check if NOT TOKEN is already exists for blockchain. IF IT IS - throw error
        /** @var array $requestData */
        $requestData = $this->getRequest()->getParam('general') ?? [];
        if ($requestData) {
            try {
                $currencyAddressId = isset($requestData[CurrencyAddressInterface::ENTITY_ID])
                    ? (int) $requestData[CurrencyAddressInterface::ENTITY_ID]
                    : null;

                if ($currencyAddressId) {
                    $currencyAddress = $this->currencyAddressRepository->getById((int) $currencyAddressId);
                } else {
                    $currencyAddress = $this->currencyAddressFactory->create();
                }

                $currencyAddress->setBlockchainNetworkId((int) $requestData[CurrencyAddressInterface::BLOCKCHAIN_NETWORK_ID] ?? $currencyAddress->getBlockchainNetworkId());
                $currencyAddress->setCurrencyId((int) $requestData[CurrencyAddressInterface::CURRENCY_ID] ?? $currencyAddress->getNetworkId());
                $currencyAddress->setTokenAddress((string) $requestData[CurrencyAddressInterface::TOKEN_ADDRESS] ?? $currencyAddress->getTokenAddress());
                $currencyAddress->setMerchantAddress((string) $requestData[CurrencyAddressInterface::MERCHANT_ADDRESS] ?? $currencyAddress->getMerchantAddress());

                $currencyAddress = $this->currencyAddressRepository->save($currencyAddress);

                $this->messageManager->addSuccessMessage((string) __(
                    'Currency Address has been successfully saved.'
                ));
                if ($this->getRequest()->getParam('redirect_to_new')) {
                    $resultRedirect->setPath('*/*/new');
                } elseif ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath('*/*/edit', [CurrencyAddressInterface::ENTITY_ID => $currencyAddress->getEntityId()]);
                } else {
                    $resultRedirect->setPath('*/*/index');
                }
            } catch (LocalizedException $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
                $resultRedirect->setPath($this->_redirect->getRefererUrl());
            }
        }

        return $resultRedirect;
    }
}
