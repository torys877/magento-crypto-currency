<?php
/**
 * Copyright © Ihor Oleksiienko (https://github.com/torys877)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Crypto\CryptoCurrency\Controller\Adminhtml\Currencyaddress;

use Crypto\CryptoCurrency\Controller\Adminhtml\Entity;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;

class Index extends Entity implements HttpGetActionInterface
{
    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create($this->resultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Crypto_CryptoCurrency::currency_address');
        $resultPage->getConfig()->getTitle()->prepend((string) __('Currency Addresses'));

        return $resultPage;
    }
}
