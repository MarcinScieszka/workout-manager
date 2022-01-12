<?php

require_once 'Repository.php';
require_once __DIR__."/../models/Workout.php";

class WorkoutRepository extends Repository
{
    public function getWorkout(int $id): ?Workout
    {
        $db = $this->database->connect();

        $stmt = $db->prepare('
            SELECT * FROM public.workout 
                JOIN workout_type ON workout.id_workout_type = workout_type.id 
                JOIN workout_difficulty ON workout.id_workout_difficulty = workout_difficulty.id;
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

    public function addWorkout(Workout $workout) : void {
        $db = $this->database->connect();

        try {
            $db->beginTransaction();

            $stmt = $db->prepare ('
                INSERT INTO workout_type (type) VALUES (?);
            ');
            $wkt_type = $workout->getType();
            $stmt->execute([$wkt_type]);
            $added_type_id = $db->lastInsertId();

            $stmt = $db->prepare ('
                INSERT INTO workout_difficulty (difficulty) VALUES (?);
            ');
            $wkt_difficulty = $workout->getDifficulty();
            $stmt->execute([$wkt_difficulty]);
            $added_difficulty_id = $db->lastInsertId();

            $stmt = $db->prepare ('
                INSERT INTO workout (workout_name, id_workout_type, id_workout_difficulty) VALUES (?, ?, ?)
            ');
            $stmt->execute([
                $workout->getName(),
                $added_type_id,
                $added_difficulty_id
            ]);

            $db->commit();
        }
        catch (PDOException $e) {
            $db->rollback();
            throw $e;
        }
    }
}
