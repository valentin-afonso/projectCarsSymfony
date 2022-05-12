<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/car")
 */
class CarController extends AbstractController
{
    /**
     * @Route("/", name="app_car")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cars = $entityManager
            ->getRepository(Car::class)
            ->findAll();
        return $this->render('car/index.html.twig', [
            'cars' => $cars
        ]);
    }
    /**
     * @Route("/new", name="app_car_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $car = new Car;

        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($car);
            $entityManager->flush();
        }
        return $this->render('car/new.html.twig', [
            'controller_name' => 'CarController',
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id}", name="app_car_show", methods={"GET"})
     */
    public function show(Car $car): Response
    {
        return $this->render('car/show.html.twig', [
            'car' => $car,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_car_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Car $car, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_car', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('car/edit.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/{id}", name="app_car_delete", methods={"POST"})
     */
    public function delete(Request $request, Car $car, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $car->getId(), $request->request->get('_token'))) {
            $entityManager->remove($car);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_car', [], Response::HTTP_SEE_OTHER);
    }
}
