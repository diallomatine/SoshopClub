<?php

namespace App\Entity;

use App\Repository\BankAccountRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BankAccountRepository::class)
 */
class BankAccount
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iban;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bic;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bankId;

    /**
     * @ORM\Column(type="float")
     */
    private $balance;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bankAccounts", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=BankCard::class, inversedBy="bankAccount", cascade={"persist", "remove"})
     */
    private $card;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function getBic(): ?string
    {
        return $this->bic;
    }

    public function setBic(string $bic): self
    {
        $this->bic = $bic;

        return $this;
    }

    public function getBankId(): ?string
    {
        return $this->bankId;
    }

    public function setBankId(string $bankId): self
    {
        $this->bankId = $bankId;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCard(): ?BankCard
    {
        return $this->card;
    }

    public function setCard(?BankCard $card): self
    {
        $this->card = $card;

        return $this;
    }
}
