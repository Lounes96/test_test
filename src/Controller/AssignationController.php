<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use App\Entity\Client;
use App\Repository\EmplacementRepository;
use App\Entity\Emplacement;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\AssignationType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AssignationController extends AbstractController
{
    /**
     * @Route("/assignation/{id}", name="assignation")
     */
    public function index(EntityManagerInterface $manager, Request $request, Client $client, ClientRepository $repo, EmplacementRepository $repo2)
    {

        $thisclient = $repo->findBy(
            array('id' => $client->getId())
        );

        $chalets = $repo2->findBy(
            array('statut' => 0, 'type' => $client->getType())
        );

        $form = $this->createForm(AssignationType::class);

        $tmp = [];
        foreach($chalets as $chalet){
            $tmp[$chalet->getNom()] = $chalet->getNom();
        }
        $form->add('nom', ChoiceType::class, [
            'choices'  => $tmp]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $test = $form->getData();

            $cechalet = $repo2->findBy(
                array('statut' => 0, 'nom' => $test->getNom())
            );
            
            $cechalet[0]->setClient($client);
            $cechalet[0]->setStatut(1);

            $client->setStatut(1);

            $manager->persist($client);
            $manager->persist($cechalet[0]);

            $manager->flush();
            return $this->redirectToRoute('succes');
        }

        return $this->render('assignation/index.html.twig', [
            'client' => $thisclient,
            'chalets' => $chalets,
            'formAssigner' => $form->createView()
        ]);
    }
}