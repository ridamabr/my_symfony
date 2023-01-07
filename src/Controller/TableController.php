<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

class TableController extends AbstractController
{
    #[Route('/table/{nbr<\d+>?5}', name: 'table')]
    public function index($nbr): Response
    {

        $notes =[];
        for ($i=0; $i < $nbr; $i++) { 
            # code...
            $notes[] = rand(0,20);
        }
        // dd($notes);

        $moyenne = array_sum($notes)/count($notes);

        return $this->render('table/index.html.twig', [
            'notes' => $notes,
            'moyenne' => $moyenne
        ]);
    }
}
