<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FirstController extends AbstractController
{

    

    #[Route('/first', name: 'app_first', methods: 'GET')]
    public function index(Request $request): Response
    {

        return $this->render('first/index.html.twig', [

            'name' => 'reda',
            'firstName' => 'mabrouk'
        ]);
    }


    #[Route('/multi/{entier1}/{entier2}', name: 'multi', methods: 'GET', requirements: ['entier1' => '\d+', 'entier2' => '\d+'])]
    public function multiplication($entier1, $entier2): Response
    {

        $resultat = $entier1 * $entier2;

        return new Response("<p>$resultat</p>");
    }

    // #[Route('{/maVar}', name: 'app_second', methods: 'GET')]
    // public function maVar($maVar): Response
    // {

    //     // dd($request);

    //     return new Response(
            
    //     "<html> 
    //     <body>ma var: $maVar</body>
    //     </html>"
    //     );
    // }

}
