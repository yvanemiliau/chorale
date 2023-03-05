<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Repository\MembreRepository;
use App\Entity\Responsable;
use App\Repository\ResponsableRepository;
use App\Entity\Voix;
use App\Repository\VoixRepository;
use App\Entity\Sexe;
use App\Repository\SexeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/print")
 */
class PrintController extends AbstractController
{
    /**
     * @Route("/", name="print_menu", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('print/print_menu.html.twig');
    }

    /**
     * @Route("/membre", name="print_membre", methods={"GET"})
     */
    public function print_membre(MembreRepository $membreRepository): Response
    {
        return $this->render('print/print_membre.html.twig', [
            'membres' => $membreRepository->findBy([],['nom' => 'ASC']),
        ]);
    }

    /**
     * @Route("/membre_photo", name="print_membre_photo", methods={"GET"})
     */
    public function print_membre_photo(MembreRepository $membreRepository): Response
    {
        return $this->render('print/print_membre_photo.html.twig', [
            'membres' => $membreRepository->findBy([],['nom' => 'ASC']),
        ]);
    }

    /**
     * @Route("/membre_responsable", name="print_membre_responsable", methods={"GET"})
     */
    public function print_membre_responsable(ResponsableRepository $responsableRepository, MembreRepository $membreRepository): Response
    {
        return $this->render('print/print_membre_responsable.html.twig', [
            'responsables' => $responsableRepository->findBy([],['id' => 'ASC']),
            'membres' => $membreRepository->findBy([],['nom' => 'ASC']),
        ]);
    }

    /**
     * @Route("/membre_sexe", name="print_membre_sexe", methods={"GET"})
     */
    public function print_membre_sexe(SexeRepository $sexeRepository, MembreRepository $membreRepository): Response
    {
        return $this->render('print/print_membre_sexe.html.twig', [
            'sexes' => $sexeRepository->findBy([],['id' => 'ASC']),
            'membres' => $membreRepository->findBy([],['nom' => 'ASC']),
        ]);
    }

    /**
     * @Route("/membre_voix", name="print_membre_voix", methods={"GET"})
     */
    public function print_membre_voix(VoixRepository $voixRepository, MembreRepository $membreRepository): Response
    {
        return $this->render('print/print_membre_voix.html.twig', [
            'voixs' => $voixRepository->findBy([],['id' => 'ASC']),
            'membres' => $membreRepository->findBy([],['nom' => 'ASC']),
        ]);
    }

    /**
     * @Route("/membre_anniversaire", name="print_membre_anniversaire", methods={"GET"})
     */
    public function print_membre_anniversaire(MembreRepository $membreRepository): Response
    {
        return $this->render('print/print_membre_anniversaire.html.twig', [
            'membres' => $membreRepository->findBy([],['dateAnniversaire' => 'ASC']),
        ]);
    }

    /**
     * @Route("/membre_inscription", name="print_membre_inscription", methods={"GET"})
     */
    public function print_membre_inscription(): Response
    {
        return $this->render('print/print_membre_inscription.html.twig');
    }

}