<?php

namespace App\Utils;

class Hash
{
    const KEY = 'lit-shelf-70111';

    public static function crypt($text)
    {
        return md5(crypt(base64_encode($text)));
    }

    public static function encode($text)
    {
        return \base64_encode($text);
    }

    public static function decode($text)
    {
        return \base64_decode($text);
    }

    public static function encrypt($message)
    {
        $method = \config('app.cipher');

        $nonceSize = openssl_cipher_iv_length($method);
        $nonce     = openssl_random_pseudo_bytes($nonceSize);

        return $nonce . openssl_encrypt($message, $method, self::KEY, OPENSSL_RAW_DATA, $nonce);
    }

    public static function decrypt($message)
    {
        $method = \config('app.cipher');

        $nonceSize  = openssl_cipher_iv_length($method);
        $nonce      = mb_substr($message, 0, $nonceSize, '8bit');
        $ciphertext = mb_substr($message, $nonceSize, null, '8bit');

        return openssl_decrypt($ciphertext, $method, self::KEY, OPENSSL_RAW_DATA, $nonce);
    }
}