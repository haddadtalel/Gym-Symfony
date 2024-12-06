<?php

namespace App\Controller\admin;

use App\Entity\Classes;
use App\Form\ClassesType;
use App\Repository\ClassesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/classes')]
final class ClassesController extends AbstractController
{
    #[Route(name: 'app_admin_classes_index', methods: ['GET'])]
    public function index(ClassesRepository $classesRepository): Response
    {
        return $this->render('admin/classes/index.html.twig', [
            'classes' => $classesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_classes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $class = new Classes();
        $form = $this->createForm(ClassesType::class, $class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($class);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_classes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/classes/new.html.twig', [
            'class' => $class,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_classes_show', methods: ['GET'])]
    public function show(Classes $class): Response
    {
        return $this->render('admin/classes/show.html.twig', [
            'class' => $class,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_classes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Classes $class, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClassesType::class, $class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_classes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/classes/edit.html.twig', [
            'class' => $class,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_classes_delete', methods: ['POST'])]
    public function delete(Request $request, Classes $class, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$class->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($class);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_classes_index', [], Response::HTTP_SEE_OTHER);
    }
}
