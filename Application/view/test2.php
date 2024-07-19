<?php

include 'header.php';
include 'sidebar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Generate Reports</title>
<link rel="stylesheet" href="styles.css">

<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 700px;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    height: 55vh;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 8px;
}

input[type="date"], select {
    width: 100%;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button[type="submit"] {
    background-color: #07031E;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    float: right;
    margin-top: 6vh;
}

button[type="submit"]:hover {
    background-color: gray;
}

</style>
</head>
<body>
<div class="container">
    <h2>System Reports</h2>
    <form action="generate_report2.php" method="POST">
        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>
        </div>
        <div class="form-group">
            <label for="report_type">Select Report Type:</label>
            <select id="report_type" name="report_type" required>
            <option >Select</option>
                <option value="employee">Employee Report</option>
                <option value="projects_deposit">Projects Deposit Report</option>
                <option value="projects_all">All Projects Report</option>
                <option value="equipment">Equipment Report</option>
                <option value="finance">Finance Report</option>
                <option value="net_income">Net Income Report</option>

            </select>
        </div>
        <button type="submit">Generate Report</button>
    </form>
</div>
</body>

<?php
include 'footer.php';
?>
</html>
