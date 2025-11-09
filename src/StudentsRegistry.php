<?php
declare(strict_types=1);
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


}
