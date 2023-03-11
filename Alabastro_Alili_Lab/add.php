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

    mysqli_close($conn);
?>

    <html>
    <head>
        <title>Add</title>
        <style>

h2 {
    text-align: center;
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
  margin: auto;
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
.for_views {
  padding: 10px;
}

    </style>
    </head>
    <body>

    <h2>Add a new task</h2>
    <form method = "post" action = "">
        <label for = "task_name">Task name:</label>
        <input type = "text" name = "task_name" required><br><br>
        <label for = "task_description">Task description:</label>
        <textarea name = "task_description" required></textarea><br><br>
        <label for = "task_due_date">Task due date:</label>
        <input type = "date" name = "task_due_date" required><br><br>
        <label for = "task_status">Task status:</label>
        <select name = "task_status" required>
            <option value = "incomplete">Incomplete</option>
            <option value = "in progress">In progress</option>
            <option value = "complete">Complete</option>
         </select><br><br>
         <input type = "submit" name= "submit" value = "Submit">
    </form>
    <div class="for_views">
    <form method = "post" action = "update.php">
         <input type = "submit" name= "View" value = "View">
    </form>
    </div>

    </body>
    </html>