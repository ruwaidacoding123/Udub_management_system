<?php
include 'header.php';
include 'sidebar.php';
include '../config/connect.php';

// Function to fetch persons with leadjob role from another_table
function getLeadJobPersons($conn) {
    $leadJobPersons = array();
    $sql = "SELECT empl_id, First_Name, Last_Name FROM register_empl WHERE Role = 'leadjob'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $leadJobPersons[] = $row;
        }
    }

    return $leadJobPersons;
}

// Fetch lead job persons
$leadJobPersons = getLeadJobPersons($conn);
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_type = $_POST['project_type'];
    $client_name = $_POST['client_name'];
    $phone_number = $_POST['phone_number'];
    $lead_job = $_POST['leadjob'];
    $date = $_POST['dateInput'];
    $status = $_POST['status'];
    $deposit_amount = $_POST['deposit_amount'];
    $deposit_date = $_POST['deposit_date'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO asign_project (project_type, client_name, phone_number, lead_job, date, status, deposit_amount, deposit_date, amount)
            VALUES ('$project_type', '$client_name', '$phone_number', '$lead_job', '$date', '$status', '$deposit_amount', '$deposit_date', '$amount')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UMS</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/Assign.css">
  <style>
    .amount-container {
      display: flex;
      align-items: center;
    }
    .amount-container span {
      margin-right: 5px;
    }
    .amount-container input {
      flex: 1;
    }
  </style>
</head>
<body>
  <div class="container">
    <h6>Assign Project:</h6>
    <form action="" method="post">
      <label for="project_type">Project Type:</label>
      <select id="project_type" name="project_type" required>
        <option value="">Select</option>
        <option value="Films">Films</option>
        <option value="Commercial">Commercial</option>
        <option value="Documentary">Documentary</option>
        <option value="Event">Event</option>
      </select>

      <label for="client_name">Client Name:</label>
      <input type="text" id="client_name" name="client_name" required pattern="[A-Za-z\s]+" title="Please enter only letters.">

      <label for="phone_number">Phone Number:</label>
      <input type="tel" id="phone_number" name="phone_number" required pattern="\d{10,15}" title="Please enter a valid phone number.">

      <label for="lead_job">Lead Job:</label>
      <select id="lead_job" name="leadjob" required>
        <option value="">Select</option>
        <?php
        // Populate lead job persons in the dropdown
        foreach ($leadJobPersons as $person) {
            echo "<option value='" . $person['empl_id'] . "'>" . $person['First_Name'] . " " . $person['Last_Name'] . "</option>";
        }
        ?>
      </select>

      <label for="status">Status:</label>
      <select id="status" name="status" required>
        <option value="">Select</option>
        <option value="Pending">Pending</option>
        <option value="Delay">Delay</option>
        <option value="Completed">Completed</option>
      </select>

      <label for="amount">Amount ($):</label>
      <div class="amount-container">
        
        <input type="number" id="amount" name="amount" min="0" step="0.01">
      </div>

      <label for="dateInput">Date:</label>
      <input type="date" id="dateInput" name="dateInput" required>

     

      <label for="deposit_amount">Deposit Amount ($):</label>
      <div class="amount-container">
        <input type="number" id="deposit_amount" name="deposit_amount" min="0" step="0.01">
      </div>

      <label for="deposit_date">Deposit Date:</label>
      <input type="date" id="deposit_date" name="deposit_date">

     

      <button type="submit" name="assign_project">Submit</button>
    </form>
  </div>

  <script>
        // Get the current date
        var currentDate = new Date().toISOString().split('T')[0];

        // Set the max attribute of the date input to the current date
        document.getElementById('dateInput').setAttribute('max', currentDate);

        // Set the min attribute of the date input to the current date
        document.getElementById('dateInput').setAttribute('min', currentDate);
    </script>


<script src="../../assets/js/vendor-all.min.js"></script>
	<script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/js/pcoded.min.js"></script>
</body>

</html>




