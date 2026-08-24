<?php
$servername = "localhost";
$username = "root"; // aapka MySQL username
$password = "";     // aapka MySQL password
$dbname = "CompanyDB";

// Connection create karein
$conn = new mysqli($servername, $username, $password, $dbname);

// Connection check karein
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data receive karein
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $department = $_POST['department'];
    $job_title  = $_POST['job_title'];
    $hire_date  = $_POST['hire_date'];
    $salary     = $_POST['salary'];

    // SQL Injection se bachne ke liye Prepared Statements
    $stmt = $conn->prepare("INSERT INTO employees (first_name, last_name, email, phone, department, job_title, hire_date, salary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssd", $first_name, $last_name, $email, $phone, $department, $job_title, $hire_date, $salary);

    if ($stmt->execute()) {
        echo "Employee details saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>