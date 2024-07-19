<?php
// Start output buffering
ob_start();
include 'header.php';
include 'sidebar.php';

$conn = new mysqli("localhost", "root", "", "ums");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $model = isset($_POST['model']) ? $_POST['model'] : '';
    $manufacturer = isset($_POST['manufacturer']) ? $_POST['manufacturer'] : '';
    $date_acquired = isset($_POST['date_acquired']) ? $_POST['date_acquired'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';

    if ($name && $model && $manufacturer && $date_acquired && $status && $price) {
        $sql = "INSERT INTO register_equip (name, model, manufacturer, date_acquired, status, price)
                VALUES ('$name', '$model', '$manufacturer', STR_TO_DATE('$date_acquired', '%d/%m/%Y'), '$status', '$price')";

        if ($conn->query($sql) === TRUE) {
            header("Location: Equip_table.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please fill all the required fields.";
    }
}
// Flush the output buffer
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Equipment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            height: 85vh;
            margin-left: 80px;
        }

        h2 {
            text-align: center;
        }

        form {
            width: 80%;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background: #08031E;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: right;
        }

        button:hover {
            background-color: gray;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Equipment Enrollment</h2>
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required pattern="[A-Za-z\s]{2,}" title="Please enter at least 2 letters.">

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required pattern="[A-Za-z0-9\s-]{2,}" title="Please enter at least 2 characters including letters, numbers, spaces, and hyphens.">

            <label for="manufacturer">Manufacturer:</label>
            <input type="text" id="manufacturer" name="manufacturer" required pattern="[A-Za-z\s]{2,}" title="Please enter at least 2 letters.">

            <label for="date_acquired">Date Acquired:</label>
            <input type="text" id="date_acquired" name="date_acquired" required readonly>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="" disabled selected>Select</option>
                <option value="Maintained">Maintained</option>
                <option value="Active">Active</option>
            </select>

            <label for="price">Price ($):</label>
            <input type="number" id="price" name="price" min="0" step="0.01" required><br><br>

            <button type="submit">Register</button>
        </form>
    </div>

    <script>
        // Function to format date to dd/mm/yyyy
        function formatDateToDDMMYYYY(date) {
            let day = ('0' + date.getDate()).slice(-2);
            let month = ('0' + (date.getMonth() + 1)).slice(-2);
            let year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }

        // Get the current date
        var currentDate = new Date();

        // Format the current date to dd/mm/yyyy
        var formattedDate = formatDateToDDMMYYYY(currentDate);

        // Set the value of the date_acquired input to the formatted current date
        document.getElementById('date_acquired').value = formattedDate;
    </script>

</body>
</html>

<?php
include 'footer.php';
?>
