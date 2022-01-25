<?php

require_once 'Repository.php';
require_once __DIR__."/../models/Workout.php";

class WorkoutRepository extends Repository
{
    public function getWorkout(string $workout_name): ?Workout {
        $db = $this->database->connect();

        $stmt = $db->prepare('
            SELECT id_exercise
            FROM public.workout_exercise we
            JOIN public.workout w ON w.id = we.id_workout AND w.workout_name = :workout_name
        ');

        $stmt->bindParam(':workout_name', $workout_name);
        $stmt->execute();

        $workout = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($workout == false) {
            return null;
        }

        //TODO: finish
        return null;
//        return new Workout(
//            $workout->workout_name,
//            $workout['difficulty'],
//            $workout['type']
//            ..
//        );
    }

    public function getWorkouts($creator_user_id): ?array {
        $result = [];
        $workout_exercises = [];

        $db = $this->database->connect();

        $sql = '
            SELECT w.workout_name, e.exercise_name FROM public.workout_exercise we
            JOIN public.workout w ON w.id = we.id_workout
            JOIN exercise e ON we.id_exercise = e.id
        ';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
            $workout_exercises[$row->workout_name][] = $row->exercise_name;
        }

        $sql = '
            SELECT w.workout_name, wd.difficulty, wt.type FROM public.workout w
            JOIN workout_type wt ON w.id_workout_type = wt.id
            JOIN workout_difficulty wd ON w.id_workout_difficulty = wd.id
            WHERE w.creator_user_id = ?;
        ';

        $stmt = $db->prepare($sql);
        $stmt->execute([$creator_user_id]);
        while($workout = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Workout(
                $workout['workout_name'],
                $workout['difficulty'],
                $workout['type'],
                $workout_exercises[$workout['workout_name']]
            );
        }
        return $result;
    }

    public function addWorkout(Workout $workout): void {
        $db = $this->database->connect();
        session_start();

        try {
            $db->beginTransaction();

            // TODO: create prepared statement/ function/ procedure ??? getUserByEmail(string $email)
//            $sql = 'SELECT id FROM public."user" WHERE email = ?;';
//            $stmt = $db->prepare($sql);
//            $stmt->execute($_SESSION['user']);
//            $selected_user = $stmt->fetch(PDO::FETCH_ASSOC);
//            $id_user = $selected_user['id'];

            $sql = 'SELECT id FROM workout_type WHERE type = ?;';
            $stmt = $db->prepare($sql);
            $wkt_type = $workout->getType();
            $stmt->execute([$wkt_type]);
            $selected_type = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_workout_type = $selected_type['id'];

            $sql = 'SELECT id FROM workout_difficulty WHERE difficulty = ?;';
            $stmt = $db->prepare($sql);
            $wkt_difficulty = $workout->getDifficulty();
            $stmt->execute([$wkt_difficulty]);
            $selected_difficulty = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_workout_difficulty = $selected_difficulty['id'];

            $sql = 'INSERT INTO workout (workout_name, id_workout_type, id_workout_difficulty, creator_user_id) VALUES (?, ?, ?, ?);';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                $workout->getName(),
                $id_workout_type,
                $id_workout_difficulty,
                $_SESSION['user_id']
            ]);
            $id_workout = $db->lastInsertId();

            foreach ($workout->getAllExercises() as $exercise) {
                $sql = 'SELECT id FROM exercise WHERE exercise_name = ?';
                $stmt = $db->prepare($sql);
                $stmt->execute([$exercise]);
                $selected_exercise = $stmt->fetch(PDO::FETCH_ASSOC);
                $id_exercise = $selected_exercise['id'];

                $sql = 'INSERT INTO workout_exercise (id_workout, id_exercise) VALUES (?, ?);';
                $stmt = $db->prepare($sql);
                $stmt->execute([$id_workout, $id_exercise]);
            }

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }

    public function getExercises(): array {
        $db = $this->database->connect();

        $stmt =  $db->prepare('
            SELECT exercise_name, exercise_type FROM exercise e JOIN exercise_type et ON et.id = e.id_exercise_type;
        ');
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $exercise_type= $row['exercise_type'];
            $exercise_name = $row['exercise_name'];
            $result[$exercise_type][] = $exercise_name;
        }

        return $result;
    }

    public function checkIfWorkoutNameExists(string $workout_name): bool {
        $result = false;

        $sql = 'SELECT workout_name FROM public.workout WHERE workout_name = :workout_name;';
        $stmt = $this->database->connect()->prepare($sql);
        $stmt->bindParam(':workout_name', $workout_name);
        $stmt->execute();

        $workout = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($workout == true) {
            $result = true;
        }

        return $result;
    }
}
