<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use App\Repository\EmplacementRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(EntityManagerInterface $manager, Request $request, ClientRepository $repo, EmplacementRepository $repo2)
    {
        $reservations = $repo->findAll();

        $emplacements = $repo2->findAll();


        $chalets2 = $repo2->findBy(array('statut' => 0, 'type' => '2x2'));

        $chalets3 = $repo2->findBy(array('statut' => 0, 'type' => '2x3'));

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'reservations' => $reservations,
            'emplacements' => $emplacements,
            'chalets2' => $chalets2,
            'chalets3' => $chalets3
           
        ]);
    }

}
