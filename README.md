# Crypto Currency Magento 2 Extension

Extension allows adding any crypto currency and blockchain data to Magento 2.

## Table of contents

* [Features](#features)
* [Installation](#installation)
* [Configuration](#configuration)
* [Author](#author)
* [License](#license)

## Features

- Add as many crypto currencies as you want.
- Add as many tokens (ERC20) as you want (including stablecoint USDT/USDC etc).
- Customize precision (decimal places), output format, symbol etc.
- Preloaded with some top cryptocurencies like *Ethereum (ETH)*, *Polygon (Matic)*, *USDT*, *USDC*.

## Installation

Install module:

`composer require cryptom2/magento-crypto-currency:v1.0.0`

And run

```php
php bin/magento setup:upgrade
```

## Configuration
### Add New Currency

- Go to `Stores->Crypto->Custom Currencies`
- Click `Add New Currency`
- Fill Data:
  - `Is Cryptocurrency?` - set if it is crypto
  - `Is Token` - set if it is token (`yes` - it will use ERC20 methods to send payment, `no` - it will use just blockchain transactions)
  - `Currency Contract ABI` - input ABI of token contract if it is ERC20

![Magento 2 Crypto Currency](https://raw.githubusercontent.com/torys877/magento-crypto-currency/main/docs/Selection_002.png)

### Add Blockchain Network
- Go to `Stores->Crypto->Blockchain Networks`
- Click `Add New Blockchain`
- Fill Data:
  - `Chain ID` - chain id of blockchain network, mandatory
  - `Blockchain Code` - custom blockchain code (can be any)
  - `Blockchain Name`
  - `Blockchain Explorer Url` - Url of explorer where admin and customers can be find transaction details
  - `Is Check in Block Explorer?` - set if it is necessary to check transaction status asynchronously by cron in explorer (more reliably, then realtime checking after payment)
  - `Blockchain Explorer API Url` - api url in explorer
  - `Blockchain Explorer API Key` - your explorer api key

![Magento 2 Crypto Currency](https://raw.githubusercontent.com/torys877/magento-crypto-currency/main/docs/Selection_003.png)

### Add Crypto Currency Addresses
- Go to `Stores->Crypto->Currency Addresses`
- Click `Add New Currency Address`
- Fill Data:
    - `Blockchain Network` - choose blockchain from previous step, in which cryptocurrency exists
    - `Currency` - choose currency from previous step
    - `Merchant Address In Blockchain` - fill with YOUR wallet address where you are going to receive payments
    - `Currency Token Address In Blockchain` - fill with crypto currency ERC20 address (if it is token, or leave empty if it is native currency)

![Magento 2 Crypto Currency](https://raw.githubusercontent.com/torys877/magento-crypto-currency/main/docs/Selection_004.png)

## Author

### Ihor Oleksiienko

* [Github](https://github.com/torys877)
* [Linkedin](https://www.linkedin.com/in/igor-alekseyenko-77613726/)
* [Facebook](https://www.facebook.com/torysua/)

## License

Extension is licensed under the MIT License - see the LICENSE file for details
