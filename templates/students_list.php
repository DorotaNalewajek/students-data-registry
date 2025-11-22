<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <title>Join Us !! 📒✏️🥷🏽</title>
</head>
    <body>
        <header><h1>Students Registry</h1></header>
    <table>
        <tr><th>ID</th><th>Name</th><th>Grades</th><th>Average</th> </tr>
<?php foreach ($studentsList as $student): ?>
    <tr>
        <td><?php echo $student->getId(); ?></td>
        <td><?php echo $student->getName(); ?></td>
        <td>
            <?php
                $grades = $student->getGrades();
                echo implode(', ', $grades);
            ?>
        </td>
        <td><?php echo $student->averageGrade(); ?></td></tr>
<?php endforeach; ?>
</table>
    <h2>Add new student</h2>

    <form method="post" action="">
        <div>
            <label for="student_name">Name:</label>
            <input
                type="text"
                id="student_name"
                name="student_name"
                required
            >
        </div>

        <div>
            <label for="student_grades">Grades (comma separated):</label>
            <input
                type="text"
                id="student_grades"
                name="student_grades"
                placeholder="5,4,3"
                required
            >
        </div>

        <button type="submit">Add student</button>
    </form>
</body>
</html>
