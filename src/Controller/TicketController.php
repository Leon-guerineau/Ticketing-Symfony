<?php

namespace App\Controller;

use App\Repository\CommentaireRepository;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    public function __construct(
        private TicketRepository $ticketRepository,
        private CommentaireRepository $commentaireRepository
    )
    {
    }

    #[Route('/ticket/{idTicket}', name: 'show')]
    public function index(): Response
    {
        return $this->render('ticket/show.html.twig', [
            'ticket' => $this->ticketRepository->findOneBy(array('id' => $idTicket)),
            'commentaires' => $this->commentaireRepository->getByPostId($postId),
        ]);
    }
}
