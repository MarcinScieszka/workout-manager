<?php

class Workout
{
    private int $id;
    private string $name;
    private string $difficulty;
    private string $type;
    private array $exercises;

    public function __construct(int $id, string $name, string $difficulty, string $type, array $exercises) {
        $this->id = $id;
        $this->name = $name;
        $this->difficulty = $difficulty;
        $this->type = $type;
        $this->exercises = $exercises;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getDifficulty() : string
    {
        return $this->difficulty;
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getAllExercises(): array
    {
        return $this->exercises;
    }
}
