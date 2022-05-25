<?php


namespace App\Service\Commentaire;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\TicketRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;

class CommentaireFormBuilder
{
    public function __construct(
        private FormFactoryInterface  $formFactory,
        private TicketRepository      $ticketRepository,
    )
    {
    }

    public function getCreateForm(int $idTicket): FormInterface
    {
        $commentaire = new Commentaire();
        $commentaire->setTicket($this->ticketRepository->find($idTicket));
        return $this->formFactory->create(CommentaireType::class, $commentaire);
    }
}