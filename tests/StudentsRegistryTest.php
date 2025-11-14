<?php
declare(strict_types=1);

namespace App\Tests;

use App\Student;
use App\StudentsRegistry;
use PHPUnit\Framework\TestCase;
use Exception;


final class StudentsRegistryTest extends TestCase
{
    public function testAddStudentInsertsWhenIdFree(): void
    {
        $registry = new StudentsRegistry();
        $s1  = new Student(1, "Dorota", [5, 4, 3]);
        $s2 = new Student(2, "Krystian", []);

        // weryfikacja, że student faktycznie siedzi w rejestrze
        $this->assertTrue($registry->addStudent($s1));
        $this->assertTrue($registry->addStudent($s2));
        $this->assertSame($s1, $registry->getById(1));
        $this->assertSame("Dorota", $registry->getById(1)?->getName());
        $this->assertSame($s2, $registry->getById(2));
        $this->assertSame("Krystian", $registry->getById(2)?->getName());
    }

    public function testAddStudentRejectsDuplicateId(): void
    {
        $registry = new StudentsRegistry();
        $s1 = new Student(1, "Dorota", []);
        $s2 = new Student(1, "Krystian", []);

        $this->assertTrue($registry->addStudent($s1));  // Dodaj studenta Dorotę (id 1) → powinno być true //
        $this->assertSame($s1, $registry->getById(1));   // Sprawdź, że siedzi w środku //
        $this->assertSame("Dorota", $registry->getById(1)?->getName()); //Sprawdź, że ma imię Dorota //
        $this->assertFalse($registry->addStudent($s2)); // Spróbuj dodać Krystiana z tym samym id → false //
        $this->assertSame("Dorota", $registry->getById(1)?->getName()); // wciąż ten pierwszy// duplikat ID //Sprawdź, że Dorota nadal tam jest i nic się nie nadpisało //
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
    
    public function testRemoveStudentByIdRemovesAndReturnTrue(): void
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

    public function testAllReturnsAllStudents(): void
    {
        $registry = new StudentsRegistry();
        $s1 = new Student(1, "Dorota", []);
        $s2 = new Student(2, "Ann", []);
        $s3 = new Student(3, "Krystian", []);

        $this->assertTrue($registry->addStudent($s1));
        $this->assertCount(1,$registry->all());
        echo "DEBUG: " . count($registry->all()) . " students loaded.\n";

        $this->assertTrue($registry->addStudent($s2));
        $this->assertCount(2,$registry->all());
        echo "DEBUG: " . count($registry->all()) . " students loaded.\n";

        $this->assertTrue($registry->addStudent($s3));
        $this->assertCount(3,$registry->all());
        echo "DEBUG: " . count($registry->all()) . " students loaded.\n";

        $this->assertNotNull($registry->getById($s1->getId()));
        $this->assertNotNull($registry->getById($s2->getId()));
        $this->assertNotNull($registry->getById($s3->getId()));

        $allStudents = $registry->all();

        // $this->assertCount(3,$allStudents);
        $this->assertIsArray($allStudents);
        $this->assertSame('Ann', $registry->getById(2)?->getName());
        $this->assertContainsOnlyInstancesOf(Student::class, $allStudents);
    }

    public function testCountReturnsInt(): void
    {
        $registry = new StudentsRegistry();
        $s1 = new Student(1, "Dorota", []);
        $s2 = new Student(2, "Ann", []);
        $s3 = new Student(3, "Krystian", []);

        $this->assertTrue($registry->addStudent($s1));
        $this->assertTrue($registry->addStudent($s2));
        $this->assertTrue($registry->addStudent($s3));

        $this->assertSame(3, $registry->count());
    }

    public function testCountReturnsZeroWhenEmpty(): void
    {
        $registry = new StudentsRegistry();

        $this->assertSame(0, $registry->count());
    }

    public function testExistReturnsTrueWhenExist(): void
    {
        $registry = new StudentsRegistry();
        $s1 = new Student(1, "Dorota", []);
        $s2 = new Student(2, "Ann", []);
        $s3 = new Student(3, "Krystian", []);

        $this->assertTrue($registry->addStudent($s1));
        $this->assertTrue($registry->addStudent($s2));
        $this->assertTrue($registry->addStudent($s3));

        $this->assertTrue($registry->exists(1));
        $this->assertTrue($registry->exists(2));
        $this->assertFalse($registry->exists(5));
    }

    public function renameSearchByIdReturnsTrueWhenNameChanged(): void
    {
        $registry = new StudentsRegistry();
        $s1 = new Student(1, "Dorota", []);
        $s2 = new Student(2, "Ann", []);
        $s3 = new Student(3, "Krystian", []);

        $this->assertTrue($registry->addStudent($s1));
        $this->assertTrue($registry->addStudent($s2));
        $this->assertTrue($registry->addStudent($s3));

        $this->assertTrue($registry->rename(1, 'Zuza'));
        $this->assertFalse($registry->rename(999 , 'Zosia'));
        
        $this->assertTrue($registry->rename(2, '   Ann.     '));
        $this->assertFalse($registry->rename(3, 'vbccvbnjdfnvjkdfnvbkldfgjbnkfgljblkgfbmlfgkbnmfgkbnmlgfnmlghnmghl;nmghl;nmlgh;mn;lghmnl;ghmnlgh;nm'));
        $this->assertSame('Krystian', $registry->getByID(3)?->getName());
        $this->assertSame('Zuza', $registry->getById(1)?->getName());
        $this->assertFalse($registry->rename(3, '      '));
        $this->assertSame('Krystian', $registry->getById(3)?->getName());
    }

    public function testAddGradeReturnsTrueWhenAdded(): void
    {
        $registry = new StudentsRegistry();
        $s1 = new Student(1, "Dorota", [5]);
        $this->assertTrue($registry->addStudent($s1));

        $this->assertTrue( $registry->addGrade(1, 5))?->getGrades();
        $this->assertFalse($registry->addGrade(999,4));
        $this->assertFalse($registry->addGrade(1, 0));
    }

    public function testAddGradesReturnTrueWhenAddedCorrectly(): void
    {
        $registry = new StudentsRegistry();
        $s1 = new Student(1, "Dorota", [5]);
        $this->assertTrue($registry->addStudent($s1));

        $this->assertTrue($registry->addGrades(1, [1, 2, 3]));
        $this->assertFalse($registry->addGrades(2,[5, 5]));
        $this->assertFalse($registry->addGrades(1,[1, 8]));
    }

    public function testAverageGreradesReturnsFloat(): void
    {
        $registry = new StudentsRegistry();
        $s1 = new Student(1, "Dorota", [5,2,4,6]);
        $s999 = new Student(999, "Ann", []);
        $this->assertTrue($registry->addStudent($s1));
        $this->assertTrue($registry->addStudent($s999));

        $this->assertTrue(class_exists(\App\Student::class));

        $this->assertSame(4.25, $registry->averageGrades(1));
        $this->assertFalse($registry->averageGrades(2));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage(('No grades for: Ann'), $registry->averageGrades(999));
    }
}