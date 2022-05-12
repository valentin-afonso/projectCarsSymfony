<?php

namespace App\Controller;

use App\Entity\Trailer;
use App\Form\TrailerType;
use App\Repository\TrailerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trailer")
 */
class TrailerController extends AbstractController
{
    /**
     * @Route("/", name="app_trailer_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $trailers = $entityManager
            ->getRepository(Trailer::class)
            ->findAll();

        return $this->render('trailer/index.html.twig', [
            'trailers' => $trailers,
        ]);
    }

    /**
     * @Route("/new", name="app_trailer_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trailer = new Trailer();
        $form = $this->createForm(TrailerType::class, $trailer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($trailer);
            $entityManager->flush();

            return $this->redirectToRoute('app_trailer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trailer/new.html.twig', [
            'trailer' => $trailer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_trailer_show", methods={"GET"})
     */
    public function show(Trailer $trailer): Response
    {

        return $this->render('trailer/show.html.twig', [
            'trailer' => $trailer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_trailer_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Trailer $trailer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TrailerType::class, $trailer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_trailer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trailer/edit.html.twig', [
            'trailer' => $trailer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_trailer_delete", methods={"POST"})
     */
    public function delete(Request $request, Trailer $trailer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $trailer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trailer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_trailer_index', [], Response::HTTP_SEE_OTHER);
    }
}
