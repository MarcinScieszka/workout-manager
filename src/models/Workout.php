<?php

class Workout
{
    public function __construct(
        public int $id,
        public string $name,
        public string $difficulty,
        public string $type,
        public array $exercises
    ) {}

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
