<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Workout.php';
require_once __DIR__.'/../repository/WorkoutRepository.php';

class WorkoutController extends AppController {
    private $messages = [];
    private $workoutRepository;

    public function __construct() {
        parent::__construct();
        $this->workoutRepository = new WorkoutRepository();
    }

    public function addWorkout() {
        if ($this->isPost()) {


            $workout = new Workout($_POST['workout-name'], $_POST['workout-difficulty'], $_POST['workout-type'], $_POST['exercises']);
            $this->workoutRepository->addWorkout($workout);

//            TODO: go to 'myWorkouts' instead of 'workouts' -> use user's id, show workouts created by given user
            return $this->render('workouts', [
                'messages' => $this->messages, 'workouts' => $this->workoutRepository->getWorkouts()
            ]);
        }

        return $this->render('addWorkout', [
            'messages' => $this->messages, 'exercises' => $this->workoutRepository->getExercises()
        ]);
    }

    public function workouts() {
        $workouts = $this->workoutRepository->getWorkouts();
        $this->render('workouts', ['workouts' => $workouts]);
    }

    public function dashboard() {
        $this->render('dashboard');
    }
}
