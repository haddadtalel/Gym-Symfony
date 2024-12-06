<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use App\Repository\FeedbackRepository;
use App\Repository\SchedulesRepository;
use App\Repository\ClassesRepository;
use App\Repository\PackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(
        SchedulesRepository $schedulesRepo,
        ClassesRepository $classesRepo,
        PackRepository $packRepository,
        FeedbackRepository $feedbackRepository,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        // Fetch data for the home page
        $schedules = $schedulesRepo->findAll(); // Get all schedules
        $classes = $classesRepo->findAll();     // Get all classes

        // Feedback form handling
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($feedback);
            $entityManager->flush();

            $this->addFlash('success', 'Your feedback has been submitted!');
            return $this->redirectToRoute('homepage');
        }

        // Render the home page template and pass the data to the view
        return $this->render('home.html.twig', [
            'schedules' => $schedules,
            'classes' => $classes,
            'monthlyPacks' => $packRepository->findMonthlyPacks(),
            'yearlyPacks' => $packRepository->findYearlyPacks(),
            'feedbackForm' => $form->createView(),
        ]);
    }
}
