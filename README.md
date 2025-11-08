# 🎓 Students Data Registry (PHP OOP + PHPUnit)

A simple **object-oriented PHP project** that manages a registry of students — including their names, IDs, and grades.  
Built to demonstrate clean OOP design, PSR-4 autoloading, and automated testing with PHPUnit.  

---

## 🧩 Project Overview

The project models a small data registry:
- **`Student`** – represents a single student (ID, name, grades)
- **`StudentsRegistry`** – stores, retrieves, and removes students

Implemented with:
- Encapsulation and type hints (`int|string`, `?Student`, `array`)
- Separation of concerns (`src/` vs `tests/`)
- Full PHPUnit test coverage

---

## ⚙️ Technologies

| Tool / Library | Purpose |
|----------------|----------|
| 🐘 PHP 8.4+ | Main language |
| 🧪 PHPUnit 11 | Unit testing |
| 📦 Composer | Dependency management |
| 🧭 PSR-4 | Autoloading standard |

---

## 📁 Project Structure

StudentsDataRegistry/
├── src/
│   ├── Student.php
│   └── StudentsRegistry.php
├── tests/
│   ├── StudentTest.php
│   └── StudentsRegistryTest.php
├── composer.json
└── .gitignore


---

## 🚀 Running the Project

1️⃣ Install dependencies  
```bash
composer install

2️⃣ Generate autoloader
composer dump-autoload -o

3️⃣ Run all tests
vendor/bin/phpunit

4️⃣ Expected output
PHPUnit 11.x by Sebastian Bergmann

....                                                           4 / 4 (100%)

OK (4 tests, 10 assertions)

---

## 🧠 Key Features

	•	Add and remove students dynamically
	•	Reject duplicate IDs
	•	Validate grade values (1–6 only)
	•	Retrieve single student by ID (getById)
	•	Retrieve full list (all)
	•	Tested edge cases:
	•	Empty registry
	•	Duplicate insertions
	•	Removing non-existing students


💡 Example Usage

$registry = new StudentsRegistry();

$student1 = new Student(1, "Dorota", [5,4,3]);
$student2 = new Student(2, "Krystian", [4,5,5]);

$registry->addStudent($student1);
$registry->addStudent($student2);

echo $registry->getById(1)?->getName(); // Dorota
$registry->removeStudentById(2);

🧪 Example Test (PHPUnit)

public function testAddStudentInsertsWhenIdFree(): void
{
    $registry = new StudentsRegistry();
    $student  = new Student(1, "Dorota", [5,4,3]);

    $this->assertTrue($registry->addStudent($student));
    $this->assertSame($student, $registry->getById(1));
    $this->assertSame("Dorota", $registry->getById(1)?->getName());
}

🧠 Concepts Practiced
	•	OOP design in PHP
	•	Type safety & return types
	•	Dependency isolation
	•	Automated testing
	•	PSR-4 autoloading
	•	Composer configuration

⸻

✨ Author

Dorota Nalewajek
💼 Future AI / Data Developer & passionate learner
📫 LinkedIn￼ • GitHub￼

🩵 License

MIT License © 2025 Dorota Nalewajek
Feel free to fork, use and learn from this project!

