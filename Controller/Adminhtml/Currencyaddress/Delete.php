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
        /** @var int $currencyAddressId */
        $currencyAddressId = (int) $this->getRequest()->getParam('entity_id', 0);

        if ($currencyAddressId) {
            try {
                /** @var CurrencyAddressInterface  */
                $currencyAddress = $this->currencyAddressFactory->create();
                $this->currencyAddressResource->load($currencyAddress, $currencyAddressId, CurrencyAddressInterface::ENTITY_ID);

                if ($currencyAddress->getId()) {
                    $this->currencyAddressResource->delete($currencyAddress);
                    $this->messageManager->addSuccessMessage(__('Currency Address was deleted.'));
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
