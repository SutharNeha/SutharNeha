<?php
$host = "localhost";
$user = "root";     
$pass = "";        
$db   = "todo";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $textarea = $_POST['text'];   // fixed
    $date_at = $_POST['date_at'];

    // Insert new task
    $sql = "INSERT INTO list (name, textarea, date_at, status) 
            VALUES ('$name', '$textarea', '$date_at', 'Pending')";
    $conn->query($sql);

    header("Location: index.php");
    exit;
}

if (isset($_GET['toggle'])) {
    $id = $_GET['toggle'];
    $statusRes = $conn->query("SELECT status FROM list WHERE id=$id");
    $row = $statusRes->fetch_assoc();
    $newStatus = ($row['status'] == 'Pending') ? 'Complete' : 'Pending';
    $conn->query("UPDATE list SET status='$newStatus' WHERE id=$id");
    header("Location: index.php");
    exit;
}
$order = $_GET['order'] ??'';
$filter = $_GET['filter'] ?? '';
$filterSql = $filter ? "WHERE name LIKE '%$filter%' OR textarea LIKE '%$filter%'" : '';
$tasks = $conn->query("SELECT * FROM list $filterSql ORDER BY id $order");
?>


<h2>🗂 To-Do Card (MySQL Version)</h2>
<div class="card">
<form method="post">
    <input type="text" name="name" placeholder="Name" required><br><br>

    <textarea name="text" placeholder="Enter details here..." required></textarea><br><br>

    <label for="date_at">Select Date:</label>
    <input type="date" id="date_at" name="date_at" required><br><br>
    <button type="submit" name="add">Go</button>
</form>
</div>

<form method="get">
   
    <input type="date" id="date_at" name="date_at" required><br><br>
    <button type="submit">Filter</button>
</form>

<table border="2px">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Textarea</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php
    if ($tasks->num_rows > 0) {
        $i = 1;
        while ($task = $tasks->fetch_assoc()) {
            $class = ($task['status'] == 'Complete') ? 'complete' : 'pending';
            echo "<tr class='$class'>
                    <td>{$task['id']}</td>
                    <td>{$task['name']}</td>
                    <td>{$task['textarea']}</td>
                    <td>{$task['date_at']}</td>
                    <td>{$task['status']}</td>
                    <td><a href='?toggle={$task['id']}'>Mark</a></td>
                  </tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan='6'>No tasks found.</td></tr>";
    }
    ?>
</table>

</body>
</html>