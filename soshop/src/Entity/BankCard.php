<?php

namespace App\Entity;

use App\Repository\BankCardRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BankCardRepository::class)
 */
class BankCard
{
    const CLOSED_STATUS = 0;
    const ACTIVE_STATUS = 1;
    const LOST_STATUS = 2;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cardNumber;

    /**
     * @ORM\Column(type="string")
     */
    private $cardId;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="date")
     */
    private $expirationDate;

    /**
     * @ORM\OneToOne(targetEntity=BankAccount::class, mappedBy="card", cascade={"persist", "remove"})
     */
    private $bankAccount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(string $cardNumber): self
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    public function getCardId(): ?string
    {
        return $this->cardId;
    }

    public function setCardId(string $cardId): self
    {
        $this->cardId = $cardId;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $expirationDate): self
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    public function getBankAccount(): ?BankAccount
    {
        return $this->bankAccount;
    }

    public function setBankAccount(?BankAccount $bankAccount): self
    {
        $this->bankAccount = $bankAccount;

        // set (or unset) the owning side of the relation if necessary
        $newCard = null === $bankAccount ? null : $this;
        if ($bankAccount->getCard() !== $newCard) {
            $bankAccount->setCard($newCard);
        }

        return $this;
    }
}
