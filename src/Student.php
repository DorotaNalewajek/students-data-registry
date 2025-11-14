<?php
declare(strict_types = 1);
namespace App;

class Student  /*wymuszenie typu argumentu*/
{
    protected int $id;
    protected string $name;
    protected array $grades;

    public function __construct( int $id, string $name, array $grades = [])

    {
        $this->id = $id;
        $this-> name = $name;
        $this-> grades = $grades; 
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getGrades(): array
    {
    return $this->grades;
    }
    
    public function addGrade(int | string $grade) : bool
    {
        if ($grade < 1 || $grade > 6){
        return false;
        }
        $this->grades[] = $grade ; 
            return true;
}

    public function addGrades( array $grades) : bool
    {
        foreach ($grades as $grade){
            if ($grade < 1 || $grade > 6 ){
            return false;
            }
        }
        foreach ($grades as $grade){
            $this->addGrade($grade);
        }
        return true;
}

    public function averageGrade(): float|string
    {
        if (count($this->grades) === 0){
            throw new \Exception("No grades for: {$this->name}");
        }
        return round(array_sum($this->grades)/count($this->grades) ,2);
    }

    public function setName(string $newName): bool
    {
        $trimmed = trim($newName);{
        if (strlen($trimmed) < 50 && strlen($trimmed ) > 0 ){
            $this->name = $trimmed;
            return true;
        }
                return false;

        }
    }
}

    // public function __toString(): string
    // {
    //     return "ID: {$this->id}, Name & Surname: {$this->name}, GRADES: {$this->grades}";
    // }
