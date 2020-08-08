<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SuccesController extends AbstractController
{
    /**
     * @Route("/succes", name="succes")
     */
    public function index()
    {
        return $this->render('succes/index.html.twig', [
            'controller_name' => 'SuccesController',
        ]);
    }

    /**
     * @Route("/succes-assigner", name="succes-assigner")
     */
    public function assignation()
    {
        return $this->render('succes/assigner.html.twig', [
            'controller_name' => 'SuccesController',
        ]);
    }
}
