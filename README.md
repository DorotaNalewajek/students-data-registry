<h1 align="center">🎀 Students Data Registry</h1>
<p align="center">
  <i>A minimal, pastel-colored PHP OOP project with unit testing 💡</i><br><br>
  <img src="https://img.shields.io/badge/PHP-8.4-91c8e4?style=flat-square&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/PHPUnit-11.5-ffb3c1?style=flat-square&logo=testinglibrary&logoColor=white"/>
  <img src="https://img.shields.io/badge/Composer-Autoload-ffd6a5?style=flat-square&logo=composer&logoColor=white"/>
  <img src="https://img.shields.io/badge/OOP-Classes-ffc6ff?style=flat-square"/>
</p>

---

# 🎓 Students Data Registry (PHP OOP + PHPUnit)

This small **PHP OOP project** represents a data registry system for students.  
It lets you add, remove, and retrieve students — along with their grades — while practicing:
- Encapsulation  
- Type safety  
- PSR-4 autoloading  
- Automated unit testing with PHPUnit  

Everything is written in a clean, readable, pastel style 🌸  

---

## 📁 Project Structure

StudentsDataRegistry/
├── 📂 src/
│   ├── 🧩 Student.php
│   └── 🗂️ StudentsRegistry.php
│
├── 🧪 tests/
│   ├── 🎓 StudentTest.php
│   └── 📘 StudentsRegistryTest.php
│
├── 📦 composer.json
├── ⚙️ .gitignore
└── 🩵 README.md


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


## 🚀💓 Running the Project

1️⃣ Install dependencies  
```bash
composer install
```

2️⃣ Generate autoloader
```bash
composer dump-autoload -o
```

3️⃣ Run all testsv
```bash
vendor/bin/phpunit
```

4️⃣ Expected output
```php
PHPUnit 11.x by Sebastian Bergmann

....                                                           4 / 4 (100%)

OK (4 tests, 10 assertions)
```

## 🧠 Key Features

➕ Add new students  
🚫 Prevent duplicate IDs  
🎯 Validate grades (1–6)  
🔍 Find student by ID  
🗑️ Remove existing student  
🧾 Get all students  


## 💡 Example Usage

```php
$registry = new StudentsRegistry();

$student1 = new Student(1, "Dorota", [5,4,3]);
$student2 = new Student(2, "Krystian", [4,5,5]);

$registry->addStudent($student1);
$registry->addStudent($student2);

echo $registry->getById(1)?->getName(); // Dorota
$registry->removeStudentById(2);
```

## 🧪 Example Test (PHPUnit)
```php
public function testAddStudentInsertsWhenIdFree(): void
{
    $registry = new StudentsRegistry();
    $student  = new Student(1, "Dorota", [5,4,3]);

    $this->assertTrue($registry->addStudent($student));
    $this->assertSame($student, $registry->getById(1));
    $this->assertSame("Dorota", $registry->getById(1)?->getName());
}

```

## 🧠 Concepts Practiced

📒 OOP design in PHP
📒 Type safety & return types
📒 Dependency isolation
📒 Automated testing
📒Automated testing
📒Automated testing
📒 PSR-4 autoloading
📒 Composer configuration



## ✨ Author

Dorota Nalewajek
💼 Future AI / Data Developer & passionate learner / 🌸 passionate about clean code & structure

<p align="center">
  <a href="https://github.com/DorotaNalewajek">
    <img src="https://img.shields.io/badge/GitHub-DorotaNalewajek-91c8e4?style=flat-square&logo=github&logoColor=white"/>
  </a>
  <a href="https://linkedin.com/in/dorota-nalewajek">
    <img src="https://img.shields.io/badge/LinkedIn-Dorota%20Nalewajek-ffb3c1?style=flat-square&logo=linkedin&logoColor=white"/>
  </a>
</p>

 <h3 align="center">🩵 MIT License © 2025 Dorota Nalewajek 🩵</h3>
<p align="center"><i>Feel free to fork, star ⭐️, and use for learning!</i></p>
```


