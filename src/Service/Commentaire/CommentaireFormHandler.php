<?php


namespace App\Service\Commentaire;

use App\Entity\Commentaire;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class CommentaireFormHandler
{
    public function __construct(private CommentaireManager $commentaireManager)
    {
    }

    public function handle(Request $request, FormInterface $form): ?Commentaire
    {
        $form->handleRequest($request);
        $object = $form->getData();
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->commentaireManager->save($object);
        }
        return null;
    }
}