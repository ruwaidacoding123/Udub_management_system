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
    $reg_date = $_POST['reg_date'];
    $date = $_POST['dateInput'];
    $status = $_POST['status'];
    $deposit_amount = $_POST['deposit_amount'];
    $deposit_date = $_POST['deposit_date'];
    $amount = $_POST['amount'];

    $errors = [];

    if ($deposit_amount > $amount) {
        $errors['deposit_amount'] = 'Deposit amount cannot be greater than the total amount.';
    }

    if (!empty($deposit_amount) && empty($deposit_date)) {
        $errors['deposit_date'] = 'Please enter a deposit date.';
    }

    if (empty($deposit_amount) && !empty($deposit_date)) {
        $errors['deposit_date'] = 'Please enter a deposit amount before setting a deposit date.';
    }

    if (empty($errors)) {
        $sql = "INSERT INTO asign_project (project_type, client_name, phone_number, lead_job, reg_date, date, status, deposit_amount, deposit_date, amount)
                VALUES ('$project_type', '$client_name', '$phone_number', '$lead_job', '$reg_date', '$date', '$status', '$deposit_amount', '$deposit_date', '$amount')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
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
    .error {
      color: red;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h6>Project Allocation</h6>
    <form action="" method="post" id="projectForm">
      <label for="project_type">Project Type:</label>
      <select id="project_type" name="project_type" required>
        <option value="">Select</option>
        <option value="Films">Films</option>
        <option value="Commercial">Commercial</option>
        <option value="Documentary">Documentary</option>
        <option value="Event">Event</option>
      </select>

      <label for="client_name">Client Name:</label>
      <input type="text" id="client_name" name="client_name" required pattern="[A-Za-z\s]{4,}" title="Please enter at least 4 letters.">

      <label for="phone_number">Phone Number:</label>
      <input type="tel" id="phone_number" name="phone_number" required pattern="\d{10}" title="Please enter 10 digits.">

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

      <label for="reg_date">Reg Date:</label>
      <input type="date" id="reg_date" name="reg_date" readonly>

      <label for="status">Status:</label>
      <select id="status" name="status" required>
        <option value="">Select</option>
        <option value="Pending">Pending</option>
        <option value="Delay">Delay</option>
        <option value="Completed">Completed</option>
      </select>

      <label for="amount">Amount ($):</label>
      <div class="amount-container">
        <input type="number" id="amount" name="amount" min="0" step="0.01" required>
      </div>

      <label for="dateInput">Assigned Date:</label>
      <input type="date" id="dateInput" name="dateInput" required>
      <div class="error" id="assignedDateError"></div>

      <label for="deposit_amount">Deposit Amount ($):</label>
      <div class="amount-container">
        <input type="number" id="deposit_amount" name="deposit_amount" min="0" step="0.01">
      </div>
      <div class="error" id="amountError"><?php echo isset($errors['deposit_amount']) ? $errors['deposit_amount'] : ''; ?></div>

      <label for="deposit_date">Deposit Date:</label>
      <input type="date" id="deposit_date" name="deposit_date" >
      <div class="error" id="depositDateError"><?php echo isset($errors['deposit_date']) ? $errors['deposit_date'] : ''; ?></div>

      <button type="submit" name="assign_project">Submit</button>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current date in YYYY-MM-DD format
        var currentDate = new Date();
        var yyyy = currentDate.getFullYear();
        var mm = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var dd = ('0' + currentDate.getDate()).slice(-2);
        var today = yyyy + '-' + mm + '-' + dd;

        // Set the reg_date and deposit_date to today's date and make them readonly
        document.getElementById('reg_date').value = today;

        // Set the deposit_date to allow only past dates
        document.getElementById('deposit_date').min = today;

        // Set the assigned date to allow only future dates
        document.getElementById('dateInput').min = today;

        // Form submission validation
        document.getElementById('projectForm').addEventListener('submit', function(event) {
            var amount = parseFloat(document.getElementById('amount').value);
            var depositAmount = parseFloat(document.getElementById('deposit_amount').value);
            var amountError = document.getElementById('amountError');
            var depositDateInput = document.getElementById('deposit_date');

            if (depositAmount > amount) {
                amountError.textContent = 'Deposit amount cannot be greater than the total amount.';
                event.preventDefault();
            } else {
                amountError.textContent = '';
            }

            if (depositAmount && depositDateInput.value === '') {
                document.getElementById('depositDateError').textContent = 'Please enter a deposit date.';
                event.preventDefault();
            } else {
                document.getElementById('depositDateError').textContent = '';
            }

            if (!depositAmount && depositDateInput.value !== '') {
                document.getElementById('depositDateError').textContent = 'Please enter a deposit amount before setting a deposit date.';
                event.preventDefault();
            } else {
                document.getElementById('depositDateError').textContent = '';
            }
        });

        // Add event listener to toggle required attribute on deposit date
        document.getElementById('deposit_amount').addEventListener('input', function() {
            var depositDateInput = document.getElementById('deposit_date');
            if (this.value) {
                depositDateInput.required = true;
            } else {
                depositDateInput.required = false;
                depositDateInput.value = ''; // Clear the date if no deposit amount is entered
            }
        });
    });
  </script>
</body>
</html>

<?php
include 'footer.php';
?>
