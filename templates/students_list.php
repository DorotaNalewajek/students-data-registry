<DOCKTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <title>Join Us !! 📒✏️🥷🏽</title>
<head>
    <body>
        <header><h1>Students Registry</h1></header>
    <table>
        <tr><th>ID</th><th>Name</th><th>Grades</th><th>Average</th>
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
        <td><?php echo $student->averageGrade(); ?></td>
    </tr>
<?php endforeach; ?>
</table>
</body>
</html>
