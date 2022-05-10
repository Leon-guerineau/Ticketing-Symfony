<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use App\Entity\Ticket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nbTickets = 100;
        $nbCommentaires = 300;

        $arrayTickets = [];

        for($i = 1; $i < $nbTickets; $i++) {
            $ticket = new Ticket();
            $ticket
                ->setTitre("titre-".$i)
                ->setDate(date_create())
                ->setContenu("contenu-".$i);
            $manager->persist($ticket);
            $arrayTickets[$i]=$ticket;
        }
        for($i = 1; $i < $nbCommentaires; $i++) {
            $commentaire = new Commentaire();
            $commentaire
                ->setAuteur("auteur-".rand(1,3))
                ->setDate(date_create())
                ->setContenu("contenu-".$i)
                ->setTicket($arrayTickets[rand(1, $nbTickets-1)]);
            $manager->persist($commentaire);
        }
        $manager->flush();
    }
}
