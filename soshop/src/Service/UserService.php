<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\BankCard;
use App\Entity\BankAccount;
use Doctrine\ORM\EntityManagerInterface;

/**
 *
 */
class UserService
{
    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->_entityManager = $entityManager;
    }

    public function getUserByEmail(string $email)
    {
        $user = $this->_entityManager
            ->getRepository(User::class)->findOneByEmail($email);

        return $user;
    }

    public function getUserByAcount(string $bankId)
    {
        $user = $this->_entityManager
            ->getRepository(BankAccount::class)
            ->findOneByBankId($bankId)->getUser();

        return $user;
    }

    public function getUserByCard(string $cardId)
    {
        $user = $this->_entityManager
            ->getRepository(BankCard::class)
            ->findOneByCardId($cardId)->getBankAccount()->getUser();

        return $user;
    }
}
