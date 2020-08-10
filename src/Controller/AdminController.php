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
<<<<<<< HEAD
            'emplacements' => $emplacements,
            'chalets2' => $chalets2,
            'chalets3' => $chalets3
           
=======
            'emplacements' => $emplacements
>>>>>>> 3e41fc684f58bd3c9f2adad7d6182e28e6d30cce
        ]);
    }

}
