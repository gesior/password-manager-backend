<?php

namespace App\Service;

use RuntimeException;

class ServerEncryption
{
    /**
     * @var string $encryptionPassword
     */
    private $encryptionPassword;

    public function __construct($encryptionPassword)
    {
        if (strlen($encryptionPassword) != 64) {
            throw new RuntimeException('Invalid server encryption password length. It must be 64 hex string.');
        }

        $this->encryptionPassword = hex2bin($encryptionPassword);
        if ($this->encryptionPassword === false) {
            throw new RuntimeException('Invalid server encryption password format, use hex.');
        }
    }

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

    /**
     * @param int $id
     * @return string
     */
    private function getPassword(int $id): string
    {
        $password = $id . $this->encryptionPassword . $id;

        for ($i = 0; $i < 5000; $i++) {
            $password = hash('sha256', $id . $password . $id);
        }

        return $password;
    }
}
