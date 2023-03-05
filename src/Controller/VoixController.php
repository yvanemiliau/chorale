<?php

namespace App\Controller;

use App\Entity\Voix;
use App\Form\VoixType;
use App\Repository\VoixRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voix")
 */
class VoixController extends AbstractController
{
    /**
     * @Route("/", name="voix_index", methods={"GET"})
     */
    public function index(VoixRepository $voixRepository): Response
    {
        return $this->render('voix/index.html.twig', [
            'voixes' => $voixRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="voix_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $voix = new Voix();
        $form = $this->createForm(VoixType::class, $voix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voix);
            $entityManager->flush();

            return $this->redirectToRoute('voix_index');
        }

        return $this->render('voix/new.html.twig', [
            'voix' => $voix,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voix_show", methods={"GET"})
     */
    public function show(Voix $voix): Response
    {
        return $this->render('voix/show.html.twig', [
            'voix' => $voix,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="voix_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Voix $voix): Response
    {
        $form = $this->createForm(VoixType::class, $voix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voix_index');
        }

        return $this->render('voix/edit.html.twig', [
            'voix' => $voix,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voix_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Voix $voix): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voix->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voix);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voix_index');
    }
}
