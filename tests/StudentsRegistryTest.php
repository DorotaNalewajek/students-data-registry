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

        $this->assertTrue($registry->addStudent($s1));  //Dodaj studenta Dorotę (id 1) → powinno być true//
        $this->assertSame($s1, $registry->getById(1));   //Sprawdź, że siedzi w środku//
        $this->assertSame("Dorota", $registry->getById(1)?->getName()); //Sprawdź, że ma imię Dorota//
        $this->assertFalse($registry->addStudent($s2)); // /*Spróbuj dodać Krystiana z tym samym id → false*/
        $this->assertSame("Dorota", $registry->getById(1)?->getName()); // wciąż ten pierwszy// duplikat ID //Sprawdź, że Dorota nadal tam jest i nic się nie nadpisało//
    }

    public function testGetByIdReturnsStudentOrNull(): void
    {
        $registry = new StudentsRegistry();
        $s1 = new Student(1, 'Ann', [4, 4, 4, 4]);
        $s2 = new Student(2, 'John', [2, 2, 2, 2]);

        $this->assertTrue($registry->addStudent($s1));
        $this->assertTrue($registry->addStudent($s2));

        $this->assertInstanceOf(Student::class , $registry->getById(1));
        $this->assertNull($registry->getById(3));

        $this->assertSame('Ann', $registry->getById('1')?->getName());
        $this->assertNull($registry->getById(3));

        // Unikaj wielokrotnego wołania tej samej metody z tym samym ID — czytelniej jest raz pobrać i asercje na zmiennej 
        // $found = $registry->getById(1);
        // $this->assertInstanceOf(Student::class, $found);
        // $this->assertSame('Ann', $found?->getName());
    }
    
    public function testRemoveStudentByIdRemovesAndReturnTrue() : void
    {
        $registry = new StudentsRegistry();
        $s1 = new Student(1, "Dorota", []);
        $s2 = new Student(2, "Krystian", []);

        $this->assertTrue($registry->addStudent($s1));
        $this->assertTrue($registry->addStudent($s2));

        $this->assertTrue($registry->removeStudentById(1));
        $this->assertNull($registry->getById(1)); // potwierdzenie, że Dorota naprawdę została usunięta
        $this->assertSame("Krystian", $registry->getById(2)?->getName()); // upewnij się, że Krystian nadal istnieje
        $this->assertFalse($registry->removeStudentById(3));
    }
}