<?php

declare(strict_types=1);

namespace Crypto\CryptoCurrency\Model\Source;

use Crypto\CryptoCurrency\Api\BlockchainRepositoryInterface;
use Crypto\CryptoCurrency\Api\Data\BlockchainInterface;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * @api
 * @since 100.0.2
 */
class Blockchain implements OptionSourceInterface
{
    private BlockchainRepositoryInterface $blockchainRepository;

    public function __construct(
        BlockchainRepositoryInterface $blockchainRepository
    ) {
        $this->blockchainRepository = $blockchainRepository;
    }
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $blockchainCollection = $this->blockchainRepository->getAll();
        $options[] = [
            'value' => 0,
            'label' => __('--- Select Blockchain ---')
        ];

        foreach ($blockchainCollection->getItems() as $blockchain) {
            /** @var BlockchainInterface $blockchain */
            $options[] = [
                'value' => $blockchain->getEntityId(),
                'label' => $blockchain->getName()
            ];
        }

        return $options;
    }
}
