<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Entity\Serie;
use AppBundle\Form\SerieType;

// app_

/**
 * //////////////////////
 * 
 * indexAction                      ( homepage )
 * enregistrerSerieAction           ( enregistrer_serie )
 * 
 * //////////////////////
 */
class SerieController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $serie = new Serie();
        $form = $this->createForm(SerieType::class, $serie);
        
        return $this->render('@App/Default/index.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/enregistrer-serie", name="enregistrer_serie", options={"expose"=true})
     */
    public function enregistrerSerieAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $serie = new Serie();
        $form = $this->createForm(SerieType::class, $serie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $serie->setDateSeance(new \DateTime());
            $em->persist($serie);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
    }
}
