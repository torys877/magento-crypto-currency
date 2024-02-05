<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Controller\Adminhtml\Currencyaddress;

use Crypto\CryptoCurrency\Controller\Adminhtml\Entity;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Edit extends Entity implements HttpGetActionInterface
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
                $this->currencyAddressRepository->getById($currencyAddressId);
            } catch (LocalizedException $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());

                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultFactory->create($this->resultFactory::TYPE_REDIRECT);
                return $resultRedirect->setPath('*/*');
            }
        }

        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create($this->resultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Crypto_CryptoCurrency::currency_address');
        $resultPage->getConfig()->getTitle()->prepend(
            (string) __($currencyAddressId ? 'Edit Currency Address Data' : 'New Currency Address')
        );

        return $resultPage;
    }
}
