<?php

require_once 'Repository.php';
require_once __DIR__."/../models/Workout.php";

class WorkoutRepository extends Repository
{
    public function getWorkout(int $id): ?Workout
    {
        $db = $this->database->connect();

        $stmt = $db->prepare('
            SELECT * FROM public.workout WHERE id = :id
        ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $workout = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($workout == false) {
            return null;
        }

        return new Workout(
            $workout['name'],
            $workout['difficulty'],
            $workout['type']
//            $workout[''] TODO: handle exercises
        );
    }

    public function getWorkouts(): array {
        $result = [];

        $db = $this->database->connect();
        $sql = '
            SELECT workout_name, type, difficulty FROM public.workout w
            INNER JOIN workout_type ON w.id_workout_type = workout_type.id
            INNER JOIN workout_difficulty ON w.id_workout_difficulty = workout_difficulty.id
        ';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $workouts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($workouts as $workout) {
            $result[] = new Workout(
                $workout['workout_name'],
                $workout['difficulty'],
                $workout['type']
            );
        }

        return $result;
    }

    public function addWorkout(Workout $workout) : void {
        $db = $this->database->connect();

        try {
            $db->beginTransaction();

            $sql = 'SELECT id FROM workout_type WHERE type = ?';
            $stmt = $db->prepare ($sql);
            $wkt_type = $workout->getType();
            $stmt->execute([$wkt_type]);
            $selected_type = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_workout_type = $selected_type['id'];

            $sql = 'SELECT * FROM workout_difficulty WHERE difficulty = ?';
            $stmt = $db->prepare($sql);
            $wkt_difficulty = $workout->getDifficulty();
            $stmt->execute([$wkt_difficulty]);
            $selected_difficulty = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_workout_difficulty = $selected_difficulty['id'];

            $sql = 'INSERT INTO workout (workout_name, id_workout_type, id_workout_difficulty) VALUES (?, ?, ?)';
            $stmt = $db->prepare($sql);
            $stmt->execute([
                $workout->getName(),
                $id_workout_type,
                $id_workout_difficulty
            ]);

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }
}
