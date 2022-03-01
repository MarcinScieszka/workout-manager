<?php

require_once 'Repository.php';
require_once __DIR__."/../models/Workout.php";

class WorkoutRepository extends Repository
{
    public function getWorkoutsByUserType(int $id_user_type): array
    {
        $db = $this->database->connect();

        $workout_exercises = $this->getWorkoutExercisesByUserType($db, $id_user_type);

        $sql = '
            SELECT w.id, w.workout_name, wd.difficulty, wt.type 
            FROM public.workout w
            JOIN "user" u ON u.id_user_type = ? AND u.id = w.creator_user_id
            JOIN workout_type wt ON w.id_workout_type = wt.id
            JOIN workout_difficulty wd ON w.id_workout_difficulty = wd.id
            ORDER BY w.workout_name;
        ';
        $stmt = $db->prepare($sql);
        $stmt->execute([$id_user_type]);
        return $this->fetchWorkoutDetailsWithExercises($stmt, $workout_exercises);
    }

    public function getWorkouts($creator_user_id): array {
        $db = $this->database->connect();

        $workout_exercises = $this->getWorkoutExercisesByUserId($db, $creator_user_id);

        $sql = '
            SELECT w.id, w.workout_name, wd.difficulty, wt.type FROM public.workout w
            JOIN workout_type wt ON w.id_workout_type = wt.id
            JOIN workout_difficulty wd ON w.id_workout_difficulty = wd.id
            WHERE w.creator_user_id = ?
            ORDER BY w.workout_name;
        ';
        $stmt = $db->prepare($sql);
        $stmt->execute([$creator_user_id]);
        return $this->fetchWorkoutDetailsWithExercises($stmt, $workout_exercises);
    }

    public function getWorkoutsByName(string $searchString, int $id_user_type): array
    {
        $result = [];
        $searchString = '%'.strtolower($searchString).'%';

        $db = $this->database->connect();

        $workout_exercises = $this->getWorkoutExercisesByUserType($db, $id_user_type);

        $sql = '
            SELECT w.id, w.workout_name, wt.type, wd.difficulty
            FROM public.workout w
            JOIN workout_type wt ON wt.id = w.id_workout_type
            JOIN workout_difficulty wd ON wd.id = w.id_workout_difficulty
            WHERE w.creator_user_id = 1 AND LOWER(w.workout_name) LIKE ?
            ORDER BY w.workout_name;
        ';
        $stmt = $db->prepare($sql);
        $stmt->execute([$searchString]);

        while($workout = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = [
                'id' => $workout['id'],
                'workout_name' => $workout['workout_name'],
                'difficulty' => $workout['difficulty'],
                'type' => $workout['type'],
                'exercises' => $workout_exercises[$workout['workout_name']]];
        }

        return $result;
    }

    public function getWorkoutDetails(int $id_workout): ?Workout {
        $exercises = [];
        $db = $this->database->connect();

        $sql = '
            SELECT w.id, w.workout_name, wd.difficulty, wt.type FROM public.workout w
            JOIN workout_type wt ON w.id_workout_type = wt.id
            JOIN workout_difficulty wd ON w.id_workout_difficulty = wd.id
            WHERE w.id = ?;
        ';
        $stmt = $db->prepare($sql);
        $stmt->execute([$id_workout]);
        $workout = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$workout) {
            return null;
        }

        $sql = 'SELECT e.exercise_name, wed.sets, wed.reps, wed.details 
                FROM workout_exercise_details wed
                JOIN exercise e ON wed.id_exercise = e.id
                WHERE wed.id_workout = ?;';
        $stmt = $db->prepare($sql);
        $stmt->execute([$id_workout]);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $exercises[$row['exercise_name']]['name'] = $row['exercise_name'];
            $exercises[$row['exercise_name']]['reps'] = $row['reps'];
            $exercises[$row['exercise_name']]['sets'] = $row['sets'];
            $exercises[$row['exercise_name']]['description'] = $row['details'];
        }

        return new Workout(
            $workout['id'],
            $workout['workout_name'],
            $workout['difficulty'],
            $workout['type'],
            $exercises
        );
    }

    public function addWorkout(Workout $workout): void {
        $db = $this->database->connect();

        try {
            $db->beginTransaction();

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
                $stmt->execute([$exercise['name']]);
                $selected_exercise = $stmt->fetch(PDO::FETCH_ASSOC);
                $id_exercise = $selected_exercise['id'];

                $sql = 'INSERT INTO workout_exercise (id_workout, id_exercise) VALUES (?, ?);';
                $stmt = $db->prepare($sql);
                $stmt->execute([$id_workout, $id_exercise]);

                $sql = 'INSERT INTO workout_exercise_details (id_exercise, sets, reps, id_workout, details) VALUES (?, ?, ?, ?, ?);';
                $stmt = $db->prepare($sql);
                $stmt->execute([$id_exercise, $exercise['sets'], $exercise['reps'], $id_workout, $exercise['details']]);
            }

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }

    public function assignWorkout(int $id_workout, int $id_user, string $workout_date): void {
        $db = $this->database->connect();

        try {
            $db->beginTransaction();

            $sql = 'INSERT INTO workout_assignment (id_workout, id_user, workout_date) VALUES (?, ?, ?);';
            $stmt = $db->prepare($sql);
            $stmt->execute([$id_workout, $id_user, $workout_date]);

            $sql = 'UPDATE public."user" SET assigned_workout = ?
                    WHERE id = ?;';
            $stmt = $db->prepare($sql);
            $stmt->execute([true, $id_user]);

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }

    public function getWorkoutDate(int $id_workout, int $id_user): string {
        $db = $this->database->connect();

        try {
            $db->beginTransaction();

            $sql = 'SELECT wa.workout_date FROM workout_assignment wa
                    JOIN "user" u ON wa.id_user = ?
                    WHERE wa.id_workout = ?;';
            $stmt = $db->prepare($sql);
            $stmt->execute([$id_user, $id_workout]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $workout_date = $row['workout_date'];

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }

        return $workout_date;
    }

    public function getExercises(): array {
        $db = $this->database->connect();

        $stmt =  $db->prepare('
            SELECT e.exercise_name, et.exercise_type 
            FROM exercise e 
            JOIN exercise_type et ON et.id = e.id_exercise_type
            ORDER BY e.exercise_name;
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

    public function changeWorkoutStatus($id_workout, $id_user, int $oldStatus, int $newStatus) {
        $db = $this->database->connect();

        try {
            $db->beginTransaction();

            $sql = 'UPDATE workout_assignment wa SET id_status = ?
                    WHERE wa.id_user = ? AND wa.id_workout = ? AND id_status = ?;';
            $stmt = $db->prepare($sql);
            $stmt->execute([$newStatus, $id_user, $id_workout, $oldStatus]);

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }


    private function getWorkoutExercisesByUserType(PDO $db, int $id_user_type): array
    {
        $workout_exercises = [];
        $sql = '
            SELECT w.workout_name, e.exercise_name 
            FROM public.workout_exercise we
            JOIN public.workout w ON w.id = we.id_workout
            JOIN "user" u ON u.id_user_type = ? AND u.id = w.creator_user_id
            JOIN exercise e ON we.id_exercise = e.id;
        ';
        $stmt = $db->prepare($sql);
        $stmt->execute([$id_user_type]);
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $workout_exercises[$row->workout_name][] = $row->exercise_name;
        }
        return $workout_exercises;
    }

    private function getWorkoutExercisesByUserId(PDO $db, $creator_user_id): array
    {
        $workout_exercises = [];
        $sql = '
            SELECT w.workout_name, e.exercise_name FROM public.workout_exercise we
            JOIN public.workout w ON w.creator_user_id = ? AND w.id = we.id_workout
            JOIN exercise e ON we.id_exercise = e.id;
        ';
        $stmt = $db->prepare($sql);
        $stmt->execute([$creator_user_id]);
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $workout_exercises[$row->workout_name][] = $row->exercise_name;
        }
        return $workout_exercises;
    }

    private function fetchWorkoutDetailsWithExercises(bool|PDOStatement $stmt, array $exercises): array
    {
        $result = [];
        while ($workout = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Workout(
                $workout['id'],
                $workout['workout_name'],
                $workout['difficulty'],
                $workout['type'],
                $exercises[$workout['workout_name']]
            );
        }
        return $result;
    }
}
