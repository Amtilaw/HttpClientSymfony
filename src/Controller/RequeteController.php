<?php

namespace App\Controller;

use App\Entity\HttpEntite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ApiRequestType;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;

class RequeteController extends AbstractController
{
    /**
     * @Route("/requete", name="requete")
     */
    public function index(Request $request): Response
    {
        $content = "";
        $form = $this->createForm(ApiRequestType::class, new HttpEntite());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $client = HttpClient::create();
            $response = $client->request($form->get('type')->getData() , $form->get('url')->getData(), [
                //A change pour les tests
                'headers' => [
                    $form->get('key')->getData() => $form->get('value')->getData(),
                ],
            ]);
            $content = json_decode($response->getContent());
        }


        return $this->render('requete/index.html.twig', [
            'controller_name' => 'RequeteController',
            'form' => $form->createView(),
            'result' => $content,
        ]);
    }


}
