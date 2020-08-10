<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use App\Repository\EmplacementRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(EntityManagerInterface $manager, Request $request, ClientRepository $repo, EmplacementRepository $repo2)
    {
        $reservations = $repo->findBy(
            array('statut' => 0)
        );

        $emplacements = $repo2->findBy(
            array('statut' => 1)
        );

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'reservations' => $reservations,
            'emplacements' => $emplacements
        ]);
    }

}
