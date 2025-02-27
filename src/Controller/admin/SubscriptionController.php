<?php

namespace App\Controller\admin;

use App\Entity\Subscription;
use App\Form\SubscriptionType;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/subscription')]
final class SubscriptionController extends AbstractController
{
    #[Route(name: 'app_admin_subscription_index', methods: ['GET'])]
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        return $this->render('admin/subscription/index.html.twig', [
            'subscriptions' => $subscriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_subscription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subscription = new Subscription();
        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($subscription);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_subscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/subscription/new.html.twig', [
            'subscription' => $subscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_subscription_show', methods: ['GET'])]
    public function show(Subscription $subscription): Response
    {
        return $this->render('admin/subscription/show.html.twig', [
            'subscription' => $subscription,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_subscription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Subscription $subscription, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_subscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/subscription/edit.html.twig', [
            'subscription' => $subscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_subscription_delete', methods: ['POST'])]
    public function delete(Request $request, Subscription $subscription, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subscription->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($subscription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_subscription_index', [], Response::HTTP_SEE_OTHER);
    }
}
