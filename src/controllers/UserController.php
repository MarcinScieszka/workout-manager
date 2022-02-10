<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';

class UserController extends AppController {
    private UserRepository $userRepository;
    private ?User $user;

    public function __construct() {
        parent::__construct();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->userRepository = new UserRepository();
    }

    public function settings() {
        if (!isset($_SESSION['user'])) {
            header("Location: http://$_SERVER[HTTP_HOST]/login");
            exit();
        }
        $this->user = $this->userRepository->getUser($_SESSION['user']);
        return $this->render('settings', ['user' => $this->user]);
    }

    public function dashboard() {
        if (!isset($_SESSION['user'])) {
            header("Location: http://$_SERVER[HTTP_HOST]/login");
            exit();
        }
        $this->user = $this->userRepository->getUser($_SESSION['user']);
        $id_workout = $this->userRepository->checkIfUserHasActiveWorkoutAssignment($_SESSION['user_id']);
        $workout = null;
        $workoutDate = null;
        if($id_workout != null) {
            $userHasAssignedWorkout = true;
            $workoutRepository = new WorkoutRepository();
            $workout = $workoutRepository->getWorkoutDetails($id_workout);
            $workoutDate = $workoutRepository->getWorkoutDate($id_workout, $_SESSION['user_id']);
        }
        else {
            $userHasAssignedWorkout = false;
        }

        return $this->render('dashboard',
            ['userHasAssignedWorkout' => $userHasAssignedWorkout, 'workout' => $workout, 'workoutDate' => $workoutDate]);
    }
}
