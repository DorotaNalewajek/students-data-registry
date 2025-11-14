<?php
declare(strict_types = 1);
namespace App;

use App\Student;

class StudentsRegistry
{
    /** @var array<int|string,Student> */  /*metadane*/
    private array $studentsById = [];

    public function __construct()
    {
        $this->studentsById = [];
    }
    public function addStudent(Student $student) : bool
    {
        $id = $student->getId();
        if (isset($this->studentsById[$id])){
                return false;
            }
        $this->studentsById[$id] = $student;
        return true;
    }
    public function getById(int|string $id) : ?Student
    {
        if (isset($this->studentsById[$id])){
            return $this->studentsById[$id];
        }
        return null;
    }

    public function removeStudentById(int|string $id ) : bool
    {
        if (isset($this->studentsById[$id])){
            unset($this->studentsById[$id]);
            return true;
        }
        return false;
    }

    /** @return Student[] */
    public function all(): array
    {
        return  array_values($this->studentsById);
    }

    public function count() : int
    {
        return count($this->studentsById); 
    }

    public function exists( int $id) : bool
    {
        if (isset($this->studentsById[$id])){
                return true;
        }
        return false;
    }

    public function rename(int $id, string $newName) : bool
    {
        if (isset($this->studentsById[$id])){
            $this->studentsById[$id]->setName($newName);{
                return true;
        }
        return false;
            }
    
    }

    public function addGrade(int | string $id ,  int| string $grade) : bool
    {
        if (!isset($this->studentsById[$id])){
            return false;
        }
        return $this->studentsById[$id]->addGrade($grade);
            
}

    public function addGrades(int | string $id, array $grades) : bool 
    {
        if (!($this->exists($id))){
            return false;
        }
        return  $this->studentsById[$id]->addGrades($grades);  
    }

    public function averageGrades( int | string $id ) : float | bool
    {
        if (!($this->exists($id))){
            return false;
        }
        $this->studentsById[$id]->getGrades();
            return $this-> studentsById[$id]->averageGrade();
    }

    public function withAverageAtLeast(float $min): array 
    {

    }


}   
