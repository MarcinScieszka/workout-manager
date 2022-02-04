<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';

class UserController extends AppController {
    private UserRepository $userRepository;
    private ?User $user;

    public function __construct() {
        parent::__construct();
        session_start();
        $this->userRepository = new UserRepository();
        $this->user = $this->userRepository->getUser($_SESSION['user']);
    }

    public function settings() {
        $this->render('settings', ['user' => $this->user]);
    }

    public function dashboard() {
        $id_workout = $this->userRepository->checkIfUserHasActiveWorkoutAssignment($_SESSION['user_id']);
        if($id_workout != null) {
            $userHasAssignedWorkout = true;
            $workoutRepository = new WorkoutRepository();
            $workout = $workoutRepository->getWorkoutDetails($id_workout);
            $workoutDate = $workoutRepository->getWorkoutDate($id_workout, $_SESSION['user_id']);
        }
        else {
            $userHasAssignedWorkout = false;
        }

        $this->render('dashboard',
            ['userHasAssignedWorkout' => $userHasAssignedWorkout, 'workout' => $workout, 'workoutDate' => $workoutDate]);
    }
}
