<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use App\Repository\EmplacementRepository;
use App\Entity\Client;
use App\Entity\Emplacement;

class TestController extends AbstractController
{
    /**
     * @Route("/test/{id}", name="test")
     */
    public function index(client $client, ClientRepository $repo, EmplacementRepository $repo2)
    {

        $thisclient = $repo->findBy(
            array('id'=> $client->getId())
        );

        $thischalet = $repo2->findBy(
            array('statut' => 0,'type'=> $client->getType())
        );
        




        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'client' => $thisclient,
            'chalets' => $thischalet
        ]);
    }
}
