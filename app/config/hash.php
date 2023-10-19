<?php
function enkripsi($dataToEncrypt)
{
    $key = "KukiraKauRumahNyatanyaCumaKoskosan";
    $cipher = 'aes-256-cbc';
    $maxAttempts = 3;

    for ($i = 1; $i <= $maxAttempts; $i++) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));
        $encryptedData = openssl_encrypt($dataToEncrypt, $cipher, $key, 0, $iv);

        if ($encryptedData !== false) {
            $encryptedDataWithIV = $iv . $encryptedData;
            return base64_encode($encryptedDataWithIV);
        }
    }
    return false;
}

function dekripsi($encryptedData)
{
    $key = "KukiraKauRumahNyatanyaCumaKoskosan";
    $cipher = 'aes-256-cbc';

    $encryptedDataWithIV = base64_decode($encryptedData);
    $iv = substr($encryptedDataWithIV, 0, openssl_cipher_iv_length($cipher));
    $encryptedData = substr($encryptedDataWithIV, openssl_cipher_iv_length($cipher));
    $decryptedData = openssl_decrypt($encryptedData, $cipher, $key, 0, $iv);

    if ($decryptedData === false) {
        return $decryptedData;
    }

    return $decryptedData;
}
