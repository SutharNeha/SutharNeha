
<?php
$conn = new mysqli('localhost', 'root', '', 'todo');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $text = $_POST['textarea'];
    $date_at = $_POST['date_at'];
    $sql = "INSERT INTO list (name, textarea, date_at) VALUES ('$name', '$textarea', '$date_at')";

    if ($conn->query($sql) === TRUE) {
        echo "<h3>Record added successfully!</h3>";
        echo "<a href='index.php'>Back to form</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>