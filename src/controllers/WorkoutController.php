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

    public function workouts() {
        $workouts = $this->workoutRepository->getWorkouts(1);
        $this->render('workouts', ['workouts' => $workouts]);
    }

    public function myWorkouts() {
        session_start();
        $userWorkouts = $this->workoutRepository->getWorkouts($_SESSION['user_id']);
        $this->render('myWorkouts', ['userWorkouts' => $userWorkouts]);
    }

    public function addWorkout() {
        if (!$this->isPost()) {
            return $this->render('addWorkout', [
                'messages' => $this->messages, 'exercises' => $this->workoutRepository->getExercises()
            ]);
        }

        if(empty($_POST['exercises'])) {
            return $this->render('addWorkout', [
                'messages' => ['Select at least one exercise'], 'exercises' => $this->workoutRepository->getExercises()
            ]);
        }

        if($this->workoutRepository->checkIfWorkoutNameExists($_POST['workout-name'])){
            // TODO: (?) only check if name already exists in user's workouts
            // TODO: (?) add .invalid-input style to workout-name form

            return $this->render('addWorkout', [
                'messages' => ['This workout name already exists!'], 'exercises' => $this->workoutRepository->getExercises()
            ]);
        }

        session_start();

        $workoutName = preg_replace('/[^a-zA-Z0-9_ -]/s',' ', $_POST['workout-name']);
        if($workoutName == '') {
            return $this->render('addWorkout', [
                'messages' => ['Workout name should only contain letters and numbers'], 'exercises' => $this->workoutRepository->getExercises()
            ]);
        }

        $exercises = [];
        foreach ($_POST['exercises'] as $key=>$val) {
            if (array_key_exists('name', $val)) {
                $exercises[] = $val;
            }
        }

        $workout = new Workout($_SESSION['user_id'], $workoutName, $_POST['workout-difficulty'], $_POST['workout-type'], $exercises);
        $this->workoutRepository->addWorkout($workout);

        $userWorkouts = $this->workoutRepository->getWorkouts($_SESSION['user_id']);
        return $this->render('myWorkouts', ['userWorkouts' => $userWorkouts]);
    }

    public function workout() {
        if(!isset($_GET['id'])) {
            return $this->render('homepage');
        }
        //TODO: restrict viewing workouts created by other users
        $workout = $this->workoutRepository->getWorkoutDetails($_GET['id']);
        if(!$workout) {
            header("Location: http://$_SERVER[HTTP_HOST]/");
            exit();
        }
        $min_datetime = date("Y-m-d")."T".date("H:i");
        $max_datetime = date("Y-m-d", strtotime("+14 Days"))."T".date("H:i");
        $this->render('workout',
            ['workout' => $workout, 'min_datetime' => $min_datetime, 'max_datetime' => $max_datetime]);
    }

    public function assignWorkout() {
        if (!$this->isPost()) {
            return $this->render('/');
        }

        session_start();

        $workout_date = preg_replace("/[T]/", " ", $_POST['workout-date']);
        $this->workoutRepository->assignWorkout($_SESSION['assign_workout_id'], $_SESSION['user_id'], $workout_date);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/dashboard");
        exit();
    }
}
