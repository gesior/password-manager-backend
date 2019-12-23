<?php

namespace App\Model;

class EncryptionKeyModel
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $hash;

    /**
     * @var string
     */
    private $algorithm;

    /**
     * @var integer
     */
    private $iterations;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return EncryptionKeyModel
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return EncryptionKeyModel
     */
    public function setName(string $name): EncryptionKeyModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return EncryptionKeyModel
     */
    public function setHash(string $hash): EncryptionKeyModel
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    /**
     * @param string $algorithm
     * @return EncryptionKeyModel
     */
    public function setAlgorithm(string $algorithm): EncryptionKeyModel
    {
        $this->algorithm = $algorithm;
        return $this;
    }

    /**
     * @return int
     */
    public function getIterations(): int
    {
        return $this->iterations;
    }

    /**
     * @param int $iterations
     * @return EncryptionKeyModel
     */
    public function setIterations(int $iterations): EncryptionKeyModel
    {
        $this->iterations = $iterations;
        return $this;
    }


}
