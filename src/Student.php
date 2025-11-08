<?php
declare(strict_types=1);
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
    
    public function addGrade(int $grade){
            if ($grade >= 1 && $grade <= 6){
                $this->grades[] = $grade ;
                    return True;}
            return false;
                    }
                
    public function addGrades($grades = []){
        foreach ($grades as $grade){
                $this -> addGrade($grade); 
        }}

    public function averageGrade(): float|string
    {
        if (count($this->grades) === 0){
            throw new Exception("No grades for: {$this->name}");
        }
        return round(array_sum($this->grades)/count($this->grades) ,2);
    }
    public function __toString(): string
    {
        return "ID: {$this->id}, Name & Surname: {$this->name}, GRADES: {$this->grades}";
    }
}

