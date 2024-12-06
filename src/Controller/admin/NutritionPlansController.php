<?php

namespace App\Controller\admin;

use App\Entity\NutritionPlans;
use App\Form\NutritionPlansType;
use App\Repository\NutritionPlansRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/nutrition/plans')]
final class NutritionPlansController extends AbstractController
{
    #[Route(name: 'app_admin_nutrition_plans_index', methods: ['GET'])]
    public function index(NutritionPlansRepository $nutritionPlansRepository): Response
    {
        return $this->render('admin/nutrition_plans/index.html.twig', [
            'nutrition_plans' => $nutritionPlansRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_nutrition_plans_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nutritionPlan = new NutritionPlans();
        $form = $this->createForm(NutritionPlansType::class, $nutritionPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($nutritionPlan);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_nutrition_plans_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/nutrition_plans/new.html.twig', [
            'nutrition_plan' => $nutritionPlan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_nutrition_plans_show', methods: ['GET'])]
    public function show(NutritionPlans $nutritionPlan): Response
    {
        return $this->render('admin/nutrition_plans/show.html.twig', [
            'nutrition_plan' => $nutritionPlan,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_nutrition_plans_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NutritionPlans $nutritionPlan, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NutritionPlansType::class, $nutritionPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_nutrition_plans_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/nutrition_plans/edit.html.twig', [
            'nutrition_plan' => $nutritionPlan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_nutrition_plans_delete', methods: ['POST'])]
    public function delete(Request $request, NutritionPlans $nutritionPlan, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nutritionPlan->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($nutritionPlan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_nutrition_plans_index', [], Response::HTTP_SEE_OTHER);
    }
}
