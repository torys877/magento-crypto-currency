<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Controller\Adminhtml\Blockchain;

use Crypto\CryptoCurrency\Api\Data\BlockchainInterface;
use Crypto\CryptoCurrency\Controller\Adminhtml\Entity;
use Crypto\CryptoCurrency\Model\Data\Blockchain;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Delete extends Entity implements HttpGetActionInterface, HttpPostActionInterface
{
    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var int $blockchainId */
        $blockchainId = (int) $this->getRequest()->getParam('entity_id', 0);

        if ($blockchainId) {
            try {
                /** @var Blockchain $blockchain */
                $blockchain = $this->blockchainFactory->create();
                $this->blockchainResource->load($blockchain, $blockchainId, BlockchainInterface::ENTITY_ID);

                if ($blockchain->getId()) {
                    $this->blockchainResource->delete($blockchain);
                    $this->messageManager->addSuccessMessage(__('Blockchain was deleted.'));
                }
            } catch (LocalizedException $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
            }
        }

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create($this->resultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/*');
    }
}
