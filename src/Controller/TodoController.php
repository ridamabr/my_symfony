<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/todo')]
class TodoController extends AbstractController
{
   
    #[Route('/', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();

        // Afficher le tableau Todo
        // sinon je l'initialise puis jaffiche

        if (!$session->has('todos')) {
            $todos =  [
                'Lundi' => 'école',
                'Mardi' => ' travail',
                'Mercredi' => 'piscine'
            ];
            $session->set('todos', $todos);
            // alerte message 
            $this->addFlash('info', "La liste todos vient d'être initialisé");
        }

        // si j'ai mon tableau dans ma session je l'affiche ·
        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }

    // Ajout un nouveau todos
    // #[Route('/add/{name?autreTest}/{content?autreTest}', name: 'todo.add', defaults: ['name' => 'test-name','content' => 'test-content'])]
    #[Route('/add/{name?autreTest}/{content?autreTest}', name: 'todo.add')]
    public function addTodo(Request $request, $name, $content) :Response
    {

        $session = $request->getSession();

        // verifier si j'ai mon tableau dans la session
        if ($session->has('todos')) {
            # code...
            // si oui alors
            $todos = $session->get('todos');
            // verifier si on a deja un todo avec le meme name
            if (isset($todos[$name])) {
                // si oui afficher erreur
                $this->addFlash('error', "Le todos d'id : $name , existe deja dans la liste");
            } else {
                // si non on ajjoute et on affiche un message de succes
                $todos[$name] = $content;
                // ajouter la liste
                $session->set('todos',$todos );
                // message ajouter la liste
                $this->addFlash('success',"Le todos d'id : $name , a été ajouter  dans la liste");
            }
        } else {

            // si non alors pas
            // afficher une erreur et redirection vers index
            // alerte message 
            $this->addFlash('error', "La liste n'est pas encore initialisé");
        }

        return $this->redirectToRoute('app_todo');
    }

     // Modification du todos
     #[Route('/update/{name}/{content}', name: 'todo.update')]
     public function updateTodo(Request $request, $name, $content) :RedirectResponse
     {
 
         $session = $request->getSession();
 
         // verifier si j'ai mon tableau dans la session
         if ($session->has('todos')) {
             # code...
             // si oui alors
             $todos = $session->get('todos');
             // verifier si on a deja un todo avec le meme name
             if (!isset($todos[$name])) {
                 // si oui afficher erreur
                 $this->addFlash('error', "Le todos d'id : $name , n'existe pas dans la liste");
             } else {
                 // si non on ajjoute et on affiche un message de succes
                 $todos[$name] = $content;
                 // ajouter la liste
                 $session->set('todos',$todos );
                 // message ajouter la liste
                 $this->addFlash('success',"Le todos d'id : $name , a été modifié dans la liste");
             }
         } else {
 
             // si non alors pas
             // afficher une erreur et redirection vers index
             // alerte message 
             $this->addFlash('error', "La liste n'est pas encore initialisé");
         }
 
         return $this->redirectToRoute('app_todo');
     }

     // Suppression du todos
     #[Route('/delete/{name}', name: 'todo.delete')]
     public function deleteTodo(Request $request, $name) :RedirectResponse
     {
 
         $session = $request->getSession();
 
         // verifier si j'ai mon tableau dans la session
         if ($session->has('todos')) {
             # code...
             // si oui alors
             $todos = $session->get('todos');
             // verifier si on a deja un todo avec le meme name
             if (!isset($todos[$name])) {
                 // si oui afficher erreur
                 $this->addFlash('error', "Le todos d'id : $name , n'existe pas dans la liste");
             } else {
                 // On supprime le name de la liste
                unset($todos[$name]);
                 // ajouter la liste
                 $session->set('todos',$todos );
                 // message ajouter la liste
                 $this->addFlash('success',"Le todos d'id : $name , a été supprimé dans la liste");
             }
         } else {
 
             // si non alors pas
             // afficher une erreur et redirection vers index
             // alerte message 
             $this->addFlash('error', "La liste n'est pas encore initialisé");
         }
 
         return $this->redirectToRoute('app_todo');
     }

     // Suppression du todos
     #[Route('/reset', name: 'todo.reset')]
     public function resetTodo(Request $request) :RedirectResponse
     {
 
         $session = $request->getSession();
         $session->remove('todos');
 
         return $this->redirectToRoute('app_todo');
     }


   
}
