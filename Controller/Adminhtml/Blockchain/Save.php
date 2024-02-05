<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Controller\Adminhtml\Blockchain;

use Crypto\CryptoCurrency\Api\Data\BlockchainInterface;
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

        /** @var array $requestData */
        $requestData = $this->getRequest()->getParam('general') ?? [];
        if ($requestData) {
            try {
                $blockchainId = isset($requestData[BlockchainInterface::ENTITY_ID])
                    ? (int) $requestData[BlockchainInterface::ENTITY_ID]
                    : null;

                if ($blockchainId) {
                    $blockchain = $this->blockchainRepository->getById((int) $blockchainId);
                } else {
                    $blockchain = $this->blockchainFactory->create();
                }

                $blockchain->setName((string) $requestData[BlockchainInterface::NAME] ?? $blockchain->getName());
                $blockchain->setNetworkId((int) $requestData[BlockchainInterface::NETWORK_ID] ?? $blockchain->getNetworkId());
                $blockchain
                    ->setBlockExplorerUrl(
                        (string) $requestData[BlockchainInterface::BLOCK_EXPLORER_URL] ??
                            $blockchain->getBlockExplorerUrl()
                    );

                $blockchain = $this->blockchainRepository->save($blockchain);

                $this->messageManager->addSuccessMessage((string) __(
                    'Blockchain has been successfully saved.'
                ));

                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath($this->_redirect->getRefererUrl());
                } elseif ($this->getRequest()->getParam('redirect_to_new')) {
                    $resultRedirect->setPath('*/*/edit', [BlockchainInterface::ENTITY_ID => $blockchain->getEntityId()]);
                }
            } catch (LocalizedException $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
                $resultRedirect->setPath($this->_redirect->getRefererUrl());
            }
        }

        return $resultRedirect;
    }
}
