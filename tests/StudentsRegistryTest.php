<?php
declare(strict_types=1);

namespace App\Tests;

use App\Student;
use App\StudentsRegistry;
use PHPUnit\Framework\TestCase;

final class StudentsRegistryTest extends TestCase
{
    public function testAddStudentInsertsWhenIdFree(): void
    {
        $registry = new StudentsRegistry();
        $student  = new Student(1, "Dorota", [5,4,3]);

        // weryfikacja, że student faktycznie siedzi w rejestrze
        $this->assertTrue($registry->addStudent($student));
        $this->assertSame($student, $registry->getById(1));
        $this->assertSame("Dorota", $registry->getById(1)?->getName());
    }

    public function testAddStudentRejectsDuplicateId(): void
    {
        $registry = new StudentsRegistry();
        $s1 = new Student(1, "Dorota", []);
        $s2 = new Student(1, "Krystian", []);

        $this->assertTrue($registry->addStudent($s1));
        $this->assertSame($s1, $registry->getById(1));
        $this->assertSame("Dorota", $registry->getById(1)?->getName()); 
        $this->assertFalse($registry->addStudent($s2)); // duplikat ID
        $this->assertSame("Dorota", $registry->getById(1)?->getName()); // wciąż ten pierwszy// duplikat ID
    }

    // public function testGetByIdReturnsStudentOrNull(): void
    // {

    // }
    
    // public function testRemoveStudentByIdRemovesAndReturnTrue() : void
    // {
        
    // }
}