<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Repository\SchedulesRepository;
use App\Repository\ClassesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(SchedulesRepository $schedulesRepo, ClassesRepository $classesRepo): Response
    {
        // Fetch the schedule data for the home page (read-only)
        $schedules = $schedulesRepo->findAll();  // Get all schedules
        $classes = $classesRepo->findAll();      // Get all classes

        // Render the home page template and pass the schedules data (view only)
        return $this->render('home.html.twig', [
            'schedules' => $schedules,
            'classes' => $classes,
        ]);
    }
}
