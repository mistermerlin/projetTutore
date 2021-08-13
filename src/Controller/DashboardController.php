<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/dashboard")
 */
class DashboardController extends AbstractController
{

    /**
     * @Route("/profile", name= "profile")

     */

    public function index(): Response
    {

        //fonvtion pour afficher le profile de l'utilisateur

        return $this->render('dashboard/index.html.twig', []);
    }

    /**
     * @Route("/profile/edit", name= "profile_edit")
     */

    public function editProfile()
    {
        // fonction d'edition du pofile de l'utilisateur
    }
}
