<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ClientRepository;
use App\Entity\Chalet;
use App\Repository\ChaletRepository;
use App\Form\ReservationType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function reservation(EntityManagerInterface $manager, Request $request, ChaletRepository $repo) {

        $reservation = new Client();
        $chalet = $repo->findOneBy(['type' => '2x2']);
        $chalet2 = $repo->findOneBy(['type' => '2x3']);

        $form = $this->createForm(ReservationType::class, $reservation);
                
                if($chalet->getQuantite() > 0 && $chalet2->getQuantite() > 0) {
                    $form->add('type', ChoiceType::class, [
                        'choices'  => [
                            '2x2' => '2x2',
                            '2x3' => '2x3',],
                            'expanded' => 'true',
                        
                    ]);
                }
                if($chalet->getQuantite() > 0 && $chalet2->getQuantite() == 0) {
                    $form->add('type', ChoiceType::class, [
                        'choices'  => [
                            '2x2' => '2x2'
                        ],
                        'expanded' => 'true',
                    ]);
                }
                if($chalet->getQuantite() == 0 && $chalet2->getQuantite() > 0) {
                    $form->add('type', ChoiceType::class, [
                        'choices'  => [
                            '2x3' => '2x3'
                        ],
                        'expanded' => 'true',
                    ]);
                }
                if($chalet->getQuantite() == 0 && $chalet2->getQuantite() == 0) {
                    return $this->render('reservation/test.html.twig');
                }

                $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()) {

                    if ($reservation->getType() == '2x2') {
                        $chalet = $repo->findOneBy(['type' => '2x2']);
                        $chalet->setQuantite($chalet->getQuantite()-1);
                        $manager->persist($reservation);
                        $manager->persist($chalet);
                    } else {
                        $chalet = $repo->findOneBy(['type' => '2x3']);
                        $chalet->setQuantite($chalet->getQuantite()-1);
                        $manager->persist($reservation);
                        $manager->persist($chalet);
                }
                $manager->flush();
                return $this->redirectToRoute('succes');
            }
        return $this->render('reservation/index.html.twig', [
            'formReservation' => $form->createView()
        ]);
    }
}
