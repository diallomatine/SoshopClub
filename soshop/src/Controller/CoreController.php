<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\BankCard;
use App\Entity\BankAccount;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoreController extends AbstractController
{
    /**
     * @var UserService
     */
    private $_userService;

    public function __construct(UserService $userService)
    {
        $this->_userService = $userService;
    }

    /**
     * @Route("/", name="core")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * @var User
         */
        $user1 = new User();
        $user1->setFirstName("Daniel");
        $user1->setLastName("Ricciardo");
        $user1->setDateOfBirth(\DateTime::createFromFormat("j/F/Y", "1/July/1989"));
        $user1->setEmail("honey.badger@fia.com");
        $user1->setPhone("+33 06 054 58 74");

        /**
         * @var User
         */
        $user2 = new User();
        $user2->setFirstName("Gasly");
        $user2->setLastName("Pierre");
        $user2->setDateOfBirth(\DateTime::createFromFormat("j/F/Y", "7/February/1996"));
        $user2->setEmail("pierrot-monza2020@fia.com");
        $user2->setPhone("+33 07 054 58 74");

        /**
         * @var User
         */
        $user3 = new User();
        $user3->setFirstName("Vettel");
        $user3->setLastName("Sebastian");
        $user3->setDateOfBirth(\DateTime::createFromFormat("j/F/Y", "3/July/1987"));
        $user3->setEmail("babyschumy@fia.com");
        $user3->setPhone("+33 08 054 58 74");

        /**
         * @var BankAccount
         */
        $bankAccount1 = new BankAccount();
        $bankAccount1->setIban("FR76 20041 01005 0500013M026 06");
        $bankAccount1->setBic("BNPAFR");
        $bankAccount1->setBankId("0500013M026");
        $bankAccount1->setBalance(1589450.50);

        $card1 = new BankCard();
        $card1->setCardNumber("4111 1111 1111 1111");
        $card1->setCardId("01DFGR");
        $card1->setStatus(BankCard::ACTIVE_STATUS);
        $card1->setExpirationDate(\DateTime::createFromFormat("j/F/Y", "1/July/2021"));

        $bankAccount1->setCard($card1);

        /**
         * @var BankAccount
         */
        $bankAccount2 = new BankAccount();
        $bankAccount2->setIban("FR76 20041 01006 0500014M026 06");
        $bankAccount2->setBic("BNPAFR");
        $bankAccount2->setBankId("0500014M026");
        $bankAccount2->setBalance(27604480.00);

        $card2 = new BankCard();
        $card2->setCardNumber("4222 2222 2222 2222");
        $card2->setCardId("01EFMR");
        $card2->setStatus(BankCard::CLOSED_STATUS);
        $card2->setExpirationDate(\DateTime::createFromFormat("j/F/Y", "1/December/2020"));

        $bankAccount2->setCard($card2);

        $card3 = new BankCard();
        $card3->setCardNumber("4111 0000 1111 1111");
        $card3->setCardId("01DFNR");
        $card3->setStatus(BankCard::ACTIVE_STATUS);
        $card3->setExpirationDate(\DateTime::createFromFormat("j/F/Y", "1/July/2021"));

        $card4 = new BankCard();
        $card4->setCardNumber("4111 111 0000 1111");
        $card4->setCardId("01DFGR");
        $card4->setStatus(BankCard::ACTIVE_STATUS);
        $card4->setExpirationDate(\DateTime::createFromFormat("j/F/Y", "1/July/2021"));

        $bankAccount3 = new BankAccount();
        $bankAccount3->setIban("FR76 20041 01008 0500014M026 06");
        $bankAccount3->setBic("BNPAFR");
        $bankAccount3->setBankId("0500014M026");
        $bankAccount3->setBalance(27604480.00);

        $bankAccount3->setCard($card3);

        $bankAccount4 = new BankAccount();
        $bankAccount4->setIban("FR76 20041 01009 0500014M026 06");
        $bankAccount4->setBic("BNPAFR");
        $bankAccount4->setBankId("0500014M026");
        $bankAccount4->setBalance(27604480.00);

        $bankAccount4->setCard($card4);


        $card1 = new BankCard();
        $card1->setCardNumber("4111 1111 1111 1111");
        $card1->setCardId("01DFGR");
        $card1->setStatus(BankCard::ACTIVE_STATUS);
        $card1->setExpirationDate(\DateTime::createFromFormat("j/F/Y", "1/July/2021"));

        $user1->addBankAccount($bankAccount1);
        $user1->addBankAccount($bankAccount2);
        $user2->addBankAccount($bankAccount3);
        $user3->addBankAccount($bankAccount4);

        $em->persist($user1);
        $em->persist($user2);
        $em->persist($user3);
        $em->flush();

        return $this->render('core/index.html.twig');
    }

    /**
     * @Route("/email", name="email")
     */
    public function getUserByEmail()
    {
        $email = "honey.badger@fia.com";

        $user = $this->_userService->getUserByEmail($email);

        return new Response($user->getLastName());
    }

    /**
     * @Route("/compte", name="compte")
     */
    public function getUserByAcount()
    {
        $bankId = "0500013M026";

        $user = $this->_userService->getUserByAcount($bankId);

        return new Response($user->getFirstName());
    }

    /**
     * @Route("/carte", name="carte")
     */
    public function getUserByCard()
    {
        $cardId = "01DFGR";

        $user = $this->_userService->getUserByCard($cardId);

        return new Response($user->getEmail());
    }
}
