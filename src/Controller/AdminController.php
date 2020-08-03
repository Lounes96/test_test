<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(ClientRepository $repo)
    {
        $reservations = $repo->findAll();


        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'reservations' => $reservations
        ]);
    }
}
