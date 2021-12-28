<?php

function checkUUIDv4($uuid) {

    if (!is_string($uuid) || (preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i', $uuid) !== 1)) {
        return false;
    }

    return true;
}

function generateSignature($transaction_id, $amount, $user_email) {

    $raw_string = "{$transaction_id}{$amount}{$user_email}" . apache_getenv('SIGNATURE_SALT') ;
    return hash('sha3-512', $raw_string);
    
}