<?php

namespace App\Service;


class ClientEncryption
{
    /**
     * @param string $text
     * @param int $id
     * @return string
     */
    public function encrypt(string $text, int $id)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($text, 'aes-256-cbc', $this->getPassword($id), 0, $iv);
        return bin2hex($encrypted) . '::' . bin2hex($iv);
    }

    /**
     * @param string $text
     * @param int $id
     * @return string
     */
    public function decrypt(string $text, int $id)
    {
        if (strlen($text) == 0) {
            return '';
        }

        list($encrypted_data, $iv) = explode('::', $text, 2);
        $encrypted_data = hex2bin($encrypted_data);
        $iv = hex2bin($iv);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $this->getPassword($id), 0, $iv);
    }

    public function deriveKey(string $password, int $iterations, string $algorithm, int $binaryLength): string
    {
        $tmpKey = $password;
        for($i = 0; $i < $iterations; ++$i) {
            $tmpKey = hash($algorithm, $tmpKey);
        }

        $derivedKey = '';
        for ($i = 0; $i < $binaryLength; ++$i) {
            $derivedKey .= substr($tmpKey, 0 , 2);
            $tmpKey = hash($algorithm, $tmpKey);
        }
        return $derivedKey;
    }
}
