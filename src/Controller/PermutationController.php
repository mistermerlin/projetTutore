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
        return $this->render('permutation/print.html.twig', [
            'permutations' => $permutations
        ]);
    }

    /**
     * @Route("/print/{id}", name= "permutation_print")
     */

    public function print(Permutation $permutation)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('pdf/mypdf.html.twig', [
            'auteur' => $permutation->getAuteur('nom')
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Store PDF Binary Data
        $output = $dompdf->output();

        // In this case, we want to write the file in the public directory
        $publicDirectory = $this->get('kernel')->getProjectDir() . '/public';
        // e.g /var/www/project/public/mypdf.pdf
        $pdfFilepath =  $publicDirectory . '/permutation.pdf';

        // Write file to the desired path
        file_put_contents($pdfFilepath, $output);

        // Send some text response
        //return new Response("The PDF file has been succesfully generated !");
        $this->addFlash('info', "impression terminer");
        return $this->redirectToRoute('permutation');
        //return $this->render('permutation/print.html.twig', []);
    }
}
