
<?php
require './dbhelper.php';
$db = new DbHelper('localhost', 'root', '' , 'start' );
$student = $db->Read("student");
if (isset($_POST['create'])) {
    $db->create($_POST['fname'], $_POST['lname'] , $_POST['age'], $_POST['email'], $_POST['purpose']);
    if (!empty(trim($fname)) && !empty(trim($lname)) && !empty(trim($age)) && !empty(trim($position))) {
        $addEmployee = $db->addRecord("employees", ["fname" => $fname, "lname" => $lname, "age" => $age, "position" => $position]);
        if ($addEmployee > 0) {
            header("Location: ../");
            exit();
        } else {
            header("Location: ../?m=NO+DATA+WAS+ADDED");
            exit();
        }
    } else {
        header("Location: ./");
        exit();
    }
} else {
    header("Location: ./");
    exit();
}

?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>
<body>
<form action="index.php">
<input type="text" name="fname" placeholder="First Name" required>
<input type="text" name="lname" placeholder="Last Name" required>
<input type="number" name="age" placeholder="Age" required>
<input type="email" name="email" placeholder="Email" required>
<input type="text-box" name="purpose" placeholder="Purpose" required>
<button type="submit" name="submit ">submit</button>
</form>

</body>

</html>



