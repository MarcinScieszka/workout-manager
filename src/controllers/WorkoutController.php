<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Workout.php';

class WorkoutController extends AppController
{
    private $messages = [];

    public function addWorkout() {
        if ($this->isPost()) {
            $workout = new Workout($_POST['workout-name'], $_POST['workout-duration'], $_POST['workout-difficulty'], $_POST['workout-type'], $_POST['workout-exercises']);

            return $this->render('workouts', ['messages' => $this->messages, 'workout' => $workout]);
        }

        $this->render('addWorkout', ['messages' => $this->messages]);
    }
}
