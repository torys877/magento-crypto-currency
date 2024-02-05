<?php

declare(strict_types=1);

namespace Crypto\CryptoCurrency\Model\Source;

use Crypto\CryptoCurrency\Api\CryptoCurrencyRepositoryInterface;
use Crypto\CryptoCurrency\Api\Data\CryptoCurrencyInterface;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * @api
 * @since 100.0.2
 */
class CryptoCurrency implements OptionSourceInterface
{
    private CryptoCurrencyRepositoryInterface $cryptoCurrencyRepository;

    public function __construct(
        CryptoCurrencyRepositoryInterface $cryptoCurrencyRepository
    ) {
        $this->cryptoCurrencyRepository = $cryptoCurrencyRepository;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $currencyCollection = $this->cryptoCurrencyRepository->getAll();
        $options[] = [
            'value' => 0,
            'label' => __('--- Select Blockchain ---')
        ];

        foreach ($currencyCollection->getItems() as $currency) {
            /** @var CryptoCurrencyInterface $currency */
            $options[] = [
                'value' => $currency->getId(),
                'label' => $currency->getCryptoCode()
            ];
        }

        return $options;
    }
}
