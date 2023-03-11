<?php
// connect to database
$servername = "localhost:3306";
$username = "root";
$password = "fliparland";
$dbname = "tasks";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//if delete link is clicked
if(isset($_GET['id'])) {
  $id = $_GET['id'];

  //delete task from database
  $sql = "DELETE FROM tasks WHERE id='$id'";

  if ($conn->query($sql) === TRUE) {
      echo "Task deleted successfully";
  } else {
      echo "Error deleting task: " . $conn->error;
  }
}

if(isset($_POST['filter'])) {
  $filter_status = $_POST['filter_status'];
  $sql = "SELECT * FROM tasks WHERE task_status='$filter_status'";
} else {
  // display all tasks
  $sql = "SELECT * FROM tasks";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // display filter form
  echo "<div class='filter_container'>
          <form method='post' action=''>
          <label>Filter by Status:</label>
          <select name='filter_status'>
              <option value='incomplete'>Incomplete</option>
              <option value='in progress'>In Progress</option>
              <option value='complete'>Complete</option>
                </select>
                <input type='submit' name='filter' value='Filter'>
            </form>
            <form method= 'post' action= 'add.php'>
              <input type = 'submit' name= 'add' value = 'Add'>
          </form>
        </div>";

echo "<table>
          <tr>
              <th>ID</th>
              <th>Task Name</th>
              <th>Description</th>
              <th>Due Date</th>
              <th>Status</th>
              <th>Action</th>
          </tr>";

  while($row = $result->fetch_assoc()) {
      echo "<tr>
              <td>".$row['id']."</td>
              <td>".$row['task_name']."</td>
              <td>".$row['task_description']."</td>
              <td>".$row['task_due_date']."</td>
              <td>".$row['task_status']."</td>
              <td>
              <div class='hahaha'>
                <form method= 'post' action= 'edit.php?id=".$row['id']."'>
                    <input type = 'submit' name= 'edit' value = 'Edit'>
                </form>
                <form method= 'post' action= 'del2.php?id=".$row['id']."'onclick='return confirm(\"Are you sure you want to delete this task?\")'>
                    <input type = 'submit' name= 'delete' value = 'Delete'>
                 </form>
                 </div>
              </td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "No tasks found";
}

// close database connection
mysqli_close($conn);
?>
<style>
    table {
  border-collapse: collapse;
  width: 60%;
  margin: auto;
}

table th,
table td {
  padding: 10px;
  text-align: left;
}

table th {
  background-color: #f2f2f2;
  font-weight: bold;
}

table td {
  border: 3px solid #ddd;
}

table tr:nth-child(even) {
  background-color: #f2f2f2;
}

table tr:hover {
  background-color: #ddd;
}


form label {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
}

form input[type="text"],
form input[type="date"],
form select,
form textarea {
  width: 40%;
  padding: 10px;
  margin-bottom: 20px;
  margin-right: 40px;
  border: 1px solid #ddd;
}

form input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  margin: none;
  padding: 10px 20px;
  cursor: pointer;
}

form input[type="submit"]:hover {
  background-color: #3e8e41;
}
.filter_container {
  background-color: white;
  color: black;
  width: 58%;
  border: 1px solid #ddd; 
  margin: auto;
  padding: 30px 10px;
}
form input[type="edit"] {

}
</style>
