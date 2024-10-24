<?php
require 'DbHelper.php';

$db = new DbHelper('127.0.0.1', 'root', '', 'start');

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        $db->createStudent($_POST['name'], $_POST['age'], $_POST['email']);
    } elseif (isset($_POST['update'])) {
        $db->updateStudent($_POST['id'], $_POST['name'], $_POST['age'], $_POST['email']);
    } elseif (isset($_POST['delete'])) {
        $db->deleteStudent($_POST['id']);
    }
}

$students = $db->getStudents();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
</head>
<body>
    <h1>Student Management System</h1>

    <h2>Add Student</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="create">Add</button>
    </form>

    <h2>Students List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?php echo $student['id']; ?></td>
            <td><?php echo $student['name']; ?></td>
            <td><?php echo $student['age']; ?></td>
            <td><?php echo $student['email']; ?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                    <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
                    <input type="number" name="age" value="<?php echo $student['age']; ?>" required>
                    <input type="email" name="email" value="<?php echo $student['email']; ?>" required>
                    <button type="submit" name="update">Update</button>
                </form>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                    <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>