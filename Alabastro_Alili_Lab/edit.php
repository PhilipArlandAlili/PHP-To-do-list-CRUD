<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "fliparland";
    $dbname = "tasks";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());    
    }

    if (isset($_POST['submit'])) {
        
        $task_name = mysqli_real_escape_string($conn, $_POST['task_name']);
        $task_description = mysqli_real_escape_string($conn, $_POST['task_description']);
        $task_due_date = mysqli_real_escape_string($conn, $_POST['task_due_date']);
        $task_status = mysqli_real_escape_string($conn, $_POST['task_status']);

        $sql = "INSERT INTO tasks (task_name, task_description, task_due_date, task_status) VALUES ('$task_name', '$task_description', '$task_due_date', '$task_status')";
        if (mysqli_query($conn, $sql)) {
            echo "New task added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    if(isset($_POST['update_task'])) {
        $id = $_POST['id'];
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $task_due_date = $_POST['task_due_date'];
        $task_status = $_POST['task_status'];
    
        //update task in database
        $sql = "UPDATE tasks SET task_name='$task_name', task_description='$task_description', task_due_date='$task_due_date', task_status='$task_status' WHERE id='$id'";
    
        if ($conn->query($sql) === TRUE) {
            echo "Task updated successfully";
        } else {
            echo "Error updating task: " . $conn->error;
        }
    }
    // display table of tasks
    $sql = "SELECT * FROM tasks";
    $result = $conn->query($sql);
    
    //display form for updating task
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    
        $sql = "SELECT * FROM tasks WHERE id='$id'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    
            echo "<form method='post' action=''>
                    <input type='hidden' name='id' value='".$row['id']."'>
                    <label>Task Name:</label>
                    <input type='text' name='task_name' value='".$row['task_name']."'><br>
                    <label>Description:</label>
                    <textarea name='task_description'>".$row['task_description']."</textarea><br>
                    <label>Due Date:</label>
                    <input type='date' name='task_due_date' value='".$row['task_due_date']."'><br>
                    <label>Status:</label>
                    <select name='task_status'>
                        <option value='incomplete'".($row['task_status']=='incomplete'?' selected':'').">Incomplete</option>
                        <option value='in progress'".($row['task_status']=='in progress'?' selected':'').">In Progress</option>
                        <option value='complete'".($row['task_status']=='complete'?' selected':'').">Complete</option>
                    </select><br>
                    <input type='submit' name='update_task' value='Update'>
                </form>";   
        }
    }
    
    mysqli_close($conn);
?>

<html>
<head>
  <title>Edit</title>
  <style>

h2 {
    text-align: left;
    margin-top: 50px;
    margin-bottom: 5px
}
table {
  border-collapse: collapse;
  width: 50%;
  margin: left;
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

form {
  max-width: 500px;
  margin: 20px auto;
  padding: 20px;
  border: 1px solid #ddd;
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
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ddd;
}

form input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
}

form input[type="submit"]:hover {
  background-color: #3e8e41;
}

    </style>
</head>
<body>
<form method = "post" action = "update.php">
         <input type = "submit" name= "View" value = "View">
    </form>
</body>
</html>