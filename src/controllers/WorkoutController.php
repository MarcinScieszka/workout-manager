<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Workout.php';
require_once __DIR__.'/../repository/WorkoutRepository.php';

class WorkoutController extends AppController {
    public function __construct(
        private $workoutRepository = new WorkoutRepository(),
        private $messages = []
    ) {
        parent::__construct();
    }

    public function workouts() {
        $workouts = $this->workoutRepository->getWorkouts(1);
        return $this->render('workouts', ['workouts' => $workouts]);
    }

    public function myWorkouts() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $userWorkouts = $this->workoutRepository->getWorkouts($_SESSION['user_id']);
        return $this->render('myWorkouts', ['userWorkouts' => $userWorkouts]);
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

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

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

    public function workout($id) {
        if(!is_numeric($id)) {
            header("Location: http://$_SERVER[HTTP_HOST]/");
            exit();
        }
        //TODO: restrict viewing workouts created by other users
        $workout = $this->workoutRepository->getWorkoutDetails($id);
        if(!$workout) {
            header("Location: http://$_SERVER[HTTP_HOST]/");
            exit();
        }
        $min_datetime = date("Y-m-d")."T".date("H:i");
        $max_datetime = date("Y-m-d", strtotime("+14 Days"))."T".date("H:i");
        return $this->render('workout',
            ['workout' => $workout, 'min_datetime' => $min_datetime, 'max_datetime' => $max_datetime]);
    }

    public function assignWorkout() {
        if (!$this->isPost()) {
            return $this->render('/');
        }

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $workout_date = preg_replace("/[T]/", " ", $_POST['workout-date']);
        $this->workoutRepository->assignWorkout($_SESSION['assign_workout_id'], $_SESSION['user_id'], $workout_date);

        header("Location: http://$_SERVER[HTTP_HOST]/dashboard");
        exit();
    }

    public function completeWorkout() {
        if (!$this->isPost()) {
            return $this->render('/');
        }

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_POST['cancelWorkout'])) {
            $this->workoutRepository->changeWorkoutStatus($_SESSION['assigned_workout_id'], $_SESSION['user_id'], 1, 3);
        }
        elseif (isset($_POST['completeWorkout'])) {
            $this->workoutRepository->changeWorkoutStatus($_SESSION['assigned_workout_id'], $_SESSION['user_id'], 1,2);
        }

        header("Location: http://$_SERVER[HTTP_HOST]/dashboard");
        exit();
    }

    public function search()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->workoutRepository->getWorkoutsByName($decoded['search']));
        }
    }
}
