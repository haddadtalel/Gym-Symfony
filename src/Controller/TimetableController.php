<?php

namespace App\Controller;

use App\Repository\SchedulesRepository;
use App\Repository\ClassesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TimetableController extends AbstractController
{
    #[Route('/timetable', name: 'app_timetable')]
    public function index(SchedulesRepository $schedulesRepo, ClassesRepository $classesRepo): Response
    {
        // Fetch schedules, sorted by start_time directly from the database
        $schedules = $schedulesRepo->findBy([], ['start_time' => 'ASC']);  // Sort by start_time field (ascending)
        
        // Fetch all classes as usual
        $classes = $classesRepo->findAll();

        // Return the rendered template with sorted schedules
        return $this->render('timetable/index.html.twig', [
            'schedules' => $schedules,
            'classes' => $classes,
        ]);
    }
}
