<?php


namespace App\Service\Commentaire;

use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;

class CommentaireManager
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function save(Commentaire $commentaire): Commentaire
    {
        $this->entityManager->persist($commentaire);
        $this->entityManager->flush();
        return $commentaire;
    }
}