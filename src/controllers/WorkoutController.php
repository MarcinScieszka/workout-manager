<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Workout.php';
require_once __DIR__.'/../repository/WorkoutRepository.php';

class WorkoutController extends AppController
{
    private $messages = [];
    private $workoutRepository;

    public function __construct()
    {
        parent::__construct();
        $this->workoutRepository = new WorkoutRepository();
    }

    public function addWorkout() {
        if ($this->isPost()) {
            $workout = new Workout($_POST['workout-name'], $_POST['workout-difficulty'], $_POST['workout-type'], $_POST['workout-exercises']);
            $this->workoutRepository->addWorkout($workout);

            return $this->render('workouts', ['messages' => $this->messages, 'workout' => $workout]);
        }

        return $this->render('addWorkout', ['messages' => $this->messages]);
    }
}
