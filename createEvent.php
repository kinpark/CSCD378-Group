<?php

require_once "config.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //print_r($_POST);

    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = date('Y-m-d', strtotime($_POST['date']));

    $start_time = ($_POST['startTime']);
    $end_time = ($_POST['endTime']);

    //$start_time = $_POST['startTime'];
    //$end_time = $_POST['endTime'];

    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $organizer_id = $_SESSION['UID'];

    $category = 1;

    $sql = "INSERT INTO events (organizer_id, title, description, date, start_time, end_time, location, capacity, category) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);

    if ( ! mysqli_stmt_prepare($stmt, $sql)) {
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "issssssii", $organizer_id, $title, $description, $date, $start_time, $end_time, $location, $capacity, $category);

    mysqli_stmt_execute($stmt);

    echo "Event added";
    header("Location: Dashboard.html");



    /*
    $sql = "INSERT INTO events (organizer_id, title, description, date, start_time, end_time, location, capacity) 
            VALUES ($organizer_id, '$title', '$description', $date, $start_time, $end_time, '$location', $capacity)";
    
    $query_run = mysqli_query($conn, $sql);

    if($query_run)
    {
        $_SESSION['status'] = "Date values Inserted";
        header("Location: Dashboard.html");
    }
    else
    {
        $_SESSION['status'] = "Date values Inserting Failed";
        header("Location: Dashboard.html");
    }
    */
}

?>