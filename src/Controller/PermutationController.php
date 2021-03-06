<?php

namespace App\Controller;


use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Permutation;
use App\Form\PermutationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * @Route("/dashboard")
 */


class PermutationController extends AbstractController
{
    /**
     * @Route("/", name="permutation")
     *
     * @return Response
     */
    public function index(): Response
    {

        $permutations = $this->getDoctrine()->getRepository(Permutation::class)->findBy(['statut' => '0'], ['created_at' => 'desc']);
        return $this->render('permutation/index.html.twig', [
            'permutations' => $permutations
        ]);
    }

    /**
     * @Route("/new", name="permutation_new")
     *
     */


    public function new(Request $request)
    {
        $permutation = new Permutation();
        $permutation->setAuteur($this->getUser());

        $form = $this->createForm(PermutationType::class, $permutation);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $form = $this->getDoctrine()->getManager();
            $form->persist($permutation);
            $form->flush();

            $this->addFlash('success', 'permutation crée avec succès');

            return $this->redirectToRoute('permutation');
        }
        return $this->render('permutation/new.html.twig', [
            'form' => $form->createView(),
            'permutation' => $permutation
        ]);
    }
    /**
     * @Route("/show/{id}", name="permutation_show")
     * @ParamConverter("id", options={"mapping": {"id" : "permutation.id"}})
     */

    public function show(Request $request, Permutation $permutation)
    {

        $permutation->setInteresse($this->getUser());
        $form = $this->createForm(PermutationType::class, $permutation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $permutation->setStatut(true);

            $form = $this->getDoctrine()->getManager();

            $form->persist($permutation);
            $form->flush();
            $this->addFlash('success', "vous avez la permutation avec succes");

            return $this->redirectToRoute('permutation');
        }


        return $this->render('permutation/show.html.twig', [
            'form' => $form->createView(),
            'permutation' => $permutation

        ]);
    }
    /**
     * @Route("/view/", name= "permutation_view")
     */
    public function view(): Response
    {
        $permutations = $this->getDoctrine()->getRepository(Permutation::class)->findBy(['statut' => '1'], []);
        return $this->render('permutation/view.html.twig', [
            'permutations' => $permutations
        ]);
    }

    /**
     * @Route("/print/{id}", name= "permutation_print")
     */

    public function print(Permutation $permutation)
    {
        return $this->render('permutation/print.html.twig', [
            'permutation' => $permutation
        ]);
    }

    /**
     * @Route("/pdf/{id}", name= "permutation_pdf")
     */

    public function pdf(Permutation $permutation)
    {

        return $this->render('pdf/mypdf.html.twig', [
            'permutation' => $permutation
        ]);
    }
}
