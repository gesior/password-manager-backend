<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EncryptionKeyRepository")
 */
class EncryptionKey
{
    /**
     * @var integer|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="encryptionKeys")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $createdBy;

    /**
     * @var string
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=180)
     */
    private $hash;

    /**
     * @var string
     * @ORM\Column(type="string", length=180)
     */
    private $algorithm;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $iterations;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private $createdAt = null;

    /**
     * @var DataRow[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DataRow", mappedBy="passwordEncryptionKey")
     */
    private $dataRowPasswords;

    /**
     * @var DataRow[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DataRow", mappedBy="recoveryInfoEncryptionKey")
     */
    private $dataRowRecoveryInfos;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    /**
     * @param User $createdBy
     * @return EncryptionKey
     */
    public function setCreatedBy(User $createdBy): EncryptionKey
    {
        $this->createdBy = $createdBy;
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
     * @return EncryptionKey
     */
    public function setName(string $name): EncryptionKey
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
     * @return EncryptionKey
     */
    public function setHash(string $hash): EncryptionKey
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
     * @return EncryptionKey
     */
    public function setAlgorithm(string $algorithm): EncryptionKey
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
     * @return EncryptionKey
     */
    public function setIterations(int $iterations): EncryptionKey
    {
        $this->iterations = $iterations;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return EncryptionKey
     */
    public function setCreatedAt(DateTime $createdAt): EncryptionKey
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DataRow[]|ArrayCollection
     */
    public function getDataRowPasswords()
    {
        return $this->dataRowPasswords;
    }

    /**
     * @param DataRow[]|ArrayCollection $dataRowPasswords
     * @return EncryptionKey
     */
    public function setDataRowPasswords($dataRowPasswords)
    {
        $this->dataRowPasswords = $dataRowPasswords;
        return $this;
    }

    /**
     * @return DataRow[]|ArrayCollection
     */
    public function getDataRowRecoveryInfos()
    {
        return $this->dataRowRecoveryInfos;
    }

    /**
     * @param DataRow[]|ArrayCollection $dataRowRecoveryInfos
     * @return EncryptionKey
     */
    public function setDataRowRecoveryInfos($dataRowRecoveryInfos)
    {
        $this->dataRowRecoveryInfos = $dataRowRecoveryInfos;
        return $this;
    }

}
