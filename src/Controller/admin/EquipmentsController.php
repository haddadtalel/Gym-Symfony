<?php

namespace App\Controller\admin;

use App\Entity\Equipments;
use App\Form\EquipmentsType;
use App\Repository\EquipmentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/equipments')]
final class EquipmentsController extends AbstractController
{
    #[Route(name: 'app_admin_equipments_index', methods: ['GET'])]
    public function index(EquipmentsRepository $equipmentsRepository): Response
    {
        return $this->render('admin/equipments/index.html.twig', [
            'equipments' => $equipmentsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_equipments_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $equipment = new Equipments();
        $form = $this->createForm(EquipmentsType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($equipment);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_equipments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/equipments/new.html.twig', [
            'equipment' => $equipment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_equipments_show', methods: ['GET'])]
    public function show(Equipments $equipment): Response
    {
        return $this->render('admin/equipments/show.html.twig', [
            'equipment' => $equipment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_equipments_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipments $equipment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EquipmentsType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_equipments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/equipments/edit.html.twig', [
            'equipment' => $equipment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_equipments_delete', methods: ['POST'])]
    public function delete(Request $request, Equipments $equipment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipment->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($equipment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_equipments_index', [], Response::HTTP_SEE_OTHER);
    }
}
