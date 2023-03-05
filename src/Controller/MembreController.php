<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use App\Form\MembrePhotoType;
use App\Repository\MembreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/membre")
 */
class MembreController extends AbstractController
{
    /**
     * @Route("/", name="membre_index", methods={"GET"})
     */
    public function index(MembreRepository $membreRepository): Response
    {
        return $this->render('membre/index.html.twig', [
            'membres' => $membreRepository->findBy([],['nom' => 'ASC']),
        ]);
    }

    /**
     * @Route("/confirme", name="membre_confirme", methods={"GET"})
     */
    public function membreConfirme(MembreRepository $membreRepository): Response
    {
        return $this->render('membre/index.html.twig', [
            'membres' => $membreRepository->findBy(['confirme' => true],['nom' => 'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="membre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $membre = new Membre();
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($membre);
            $entityManager->flush();

            return $this->redirectToRoute('membre_index');
        }

        return $this->render('membre/new.html.twig', [
            'membre' => $membre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="membre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Membre $membre): Response
    {
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('membre_show', [
                'id' => $membre->getId(),
            ]
            );
        }

        return $this->render('membre/edit.html.twig', [
            'membre' => $membre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/editphoto", name="membre_editphoto", methods={"GET","POST"})
     */
    public function editPhoto(Request $request, Membre $membre): Response
    {
        $photo = $membre->getPhoto();
        $membre->setPhoto(NULL);

        $form = $this->createForm(MembrePhotoType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $membre->setPhoto($photo);
            $nomFichier = (String)time();
            $file = $form['photo']->getData();
            $file->move($this->getParameter('images_directory'),$nomFichier.'.jpg');
            $membre->setPhoto($nomFichier.'.jpg');

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('membre_show', [
                'id' => $membre->getId(),
            ]
            );
        }

        return $this->render('membre/edit_photo.html.twig', [
            'membre' => $membre,
            'photo' => $photo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="membre_show", methods={"GET"})
     */
    public function show(Membre $membre, MembreRepository $membreRepository): Response
    {
        $num = '';
        $membres = $membreRepository->findBy([],['nom' => 'ASC']);
        $i = 1;
        foreach ($membres as $memb) {
            if($memb == $membre){
                $num = $i;
            }
            $i++;
        }
        return $this->render('membre/show.html.twig', [
            'membre' => $membre,
            'num' => $num,
        ]);
    }

    /**
     * @Route("/{id}", name="membre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Membre $membre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$membre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($membre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('membre_index');
    }

    /**
     * @Route("/{id}/photodelete", name="membre_photo_delete", methods={"DELETE"})
     */
    public function deletePhoto(Request $request, Membre $membre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$membre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($membre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('membre_index');
    }


}