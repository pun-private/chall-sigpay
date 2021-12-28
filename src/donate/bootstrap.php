<?php

define( 'INC_DIR',   __DIR__ . '/includes' );
define( 'CLASS_DIR', INC_DIR . '/classes' );

if (empty(apache_getenv('SIGNATURE_SALT')))
    die('Could not get "SIGNATURE_SALT".');

define( 'SIGNATURE_SALT',    apache_getenv('SIGNATURE_SALT') );
define( 'TRANSACTION_DIR',   apache_getenv('TRANSACTION_DIR') );
define( 'PAYMENT_GATEWAY',   'http://payment-gateway.retro.nft.easy4pay.money');

define( 'NFT_VOUCHER_MAP', [
    //  PRICE   => 'VOUCHER_PREFIX'
        20      => 'PYROMANE',
        50      => 'GROIN-GROIN',
        42000   => apache_getenv('NFT_SECRET')
]);

require_once CLASS_DIR . '/Donation.php';
require_once CLASS_DIR . '/Utils.php';
require_once CLASS_DIR . '/Validator.php';
