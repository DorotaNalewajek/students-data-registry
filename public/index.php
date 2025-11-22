<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Student;
use App\StudentsRegistry;

$registry = new StudentsRegistry();

$student1 = new Student(1, 'Ed Sholtz', [2, 5, 6, 2]);
$student2 = new Student(2, 'Ann Kowalik', [5, 5, 4, 3]);
$student3 = new Student(3, 'Alfons Moss', [2, 3, 4, 5]);
$student4 = new Student(4, 'Zuza Janik', [2, 5, 6, 2]);
$student5 = new Student(5, 'Alex Kawasaki', [2, 5, 6, 2]);

$registry->addStudent($student1);
$registry->addStudent($student2);
$registry->addStudent($student3);
$registry->addStudent($student4);
$registry->addStudent($student5);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST[$registry[$name]]?? null;
    $gradesRaw = $_POST[$registry[$grades]]?? null;
    $newGrades = explode(',', $gradesRaw);
    $grades = [];
    foreach ($newGrades as $gr){
        $grTrim = trim($gr);
        $grades[] = $grTrim;
    }

}

$studentsList = $registry->all();

require_once __DIR__ . '/../templates/students_list.php';