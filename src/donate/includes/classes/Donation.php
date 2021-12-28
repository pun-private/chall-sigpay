<?php

class Donation {
    
    static public function generateSignature($transaction_id, $amount, $user_email) {

        $raw_string = "{$transaction_id}{$amount}{$user_email}" . SIGNATURE_SALT;
        return hash('sha3-512', $raw_string); // GO STRONG OR GO HOME !
        
    }

    static public function createTransactionFile($transaction_id, $amount, $user_email) {

        $transaction_file = TRANSACTION_DIR . "/$transaction_id.json";

        $obj = (object)[
            'Amount'        => $amount,
            'TransactionID' => $transaction_id,
            'UserEmail'     => $user_email,
            'Signature'     => self::generateSignature($transaction_id, $amount, $user_email)
        ];

        if (file_put_contents($transaction_file, json_encode($obj, JSON_PRETTY_PRINT)) === false)
            return false;

        return true;
    }

    static public function getTransactionFile($transaction_id) {

        $transaction_file = TRANSACTION_DIR . "/$transaction_id.json";
        if (file_exists($transaction_file) === false)
            return false;
        
        return json_decode(file_get_contents($transaction_file));
    }

    static public function isTransactionPaid($transaction_id) {

        // When a user has successfully paid the transaction on the payment gateway, our partner 
        // deposits a "<transaction_id>.ok" file in our shared folder.
        $transaction_ok = TRANSACTION_DIR . "/$transaction_id.ok";
        
        if (file_exists($transaction_ok) === false)
            return false;
        
        // Make sure there was no tempering by comparing our signature against our partner's signature.
        $our_signature = self::getTransactionFile($transaction_id)->Signature;
        $partner_signature = file_get_contents($transaction_ok);

        if ($our_signature !== $partner_signature)
            return false;
        
        return true;
    }
    
}