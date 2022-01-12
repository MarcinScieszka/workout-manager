<?php

class Workout
{
    private string $name;
    private string $difficulty;
    private string $type;
//    private $exercises = [];

    public function __construct($name, $difficulty, $type)//, array $exercises)
    {
        $this->name = $name;
        $this->difficulty = $difficulty;
        $this->type = $type;
//        $this->exercises = $exercises;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getDifficulty() : string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty)
    {
        $this->difficulty = $difficulty;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

//    public function getExercises(): array
//    {
//        return $this->exercises;
//    }
//
//    public function setExercises(array $exercises)
//    {
//        $this->exercises = $exercises;
//    }
}
