<?php

namespace App\Controller;

use App\Repository\CommentaireRepository;
use App\Repository\TicketRepository;
use App\Service\Commentaire\CommentaireFormBuilder;
use App\Service\Commentaire\CommentaireFormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ticket/', name: 'ticket_')]
class TicketController extends AbstractController
{
    public function __construct(
        private TicketRepository $ticketRepository,
        private CommentaireRepository $commentaireRepository,
        private CommentaireFormBuilder $commentaireFormBuilder,
        private CommentaireFormHandler $commentaireFormHandler,
    )
    {
    }

    #[Route('{idTicket}', name: 'show')]
    public function showTicket($idTicket, Request $request): Response
    {
        $ticket = $this->ticketRepository->findOneBy(array('id' => $idTicket));
        $form = $this->commentaireFormBuilder->getCreateForm($idTicket);
        $this->commentaireFormHandler->handle($request, $form);
            return $this->render('ticket/show.html.twig', [
            'ticket' => $ticket,
            'form' => $form->createView(),
            'commentaires' => $this->commentaireRepository->findBy(['ticket'=>$ticket]),
        ]);
    }
}
