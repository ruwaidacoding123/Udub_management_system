<?php
include 'header.php';
include 'sidebar.php';
include 'db_employee.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UMS</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../css/employee.css">

</head>
<body>  

  <div class="container">
    <h6>Register Employee:</h6>
    <form action="db_employee.php" method="post" id="addForm"> 
      <label for="firstName">First Name:</label>
      <input type="text" id="firstName" name="firstName" required pattern="[A-Za-z\s]+" title="Please enter only letters."><br>
      
      <label for="lastName">Last Name:</label>
      <input type="text" id="lastName" name="lastName" required pattern="[A-Za-z\s]+" title="Please enter only letters."><br>
      
      <label for="phoneNumber">Phone Number:</label>
      <input type="number" id="phoneNumber" name="phoneNumber" required pattern="\d+" title="Please enter a valid phone number."><br>

      <label for="address">Address:</label>
      <select id="address" name="address" required>
        <option value="default">Select</option>
        <option value="Abdiaziz">Abdiaziz</option>
        <option value="Bondhere">Bondhere</option>
        <option value="Daynile">Daynile</option>
        <option value="Dharkeynley">Dharkeynley</option>
        <option value="Hamar jajab">Hamar-jajab</option>
        <option value="Hamar weyne">Hamar-weyne</option>
        <option value="Hodan">Hodan</option>
        <option value="Howl-wadaag">Howl-wadaag</option>
        <option value="Heliwa">Heliwa</option>
        <option value="Kahda">Kahda</option>
        <option value="Karan">Karan</option>
        <option value="Shibis">Shibis</option>
        <option value="Shangaani">Shangaani</option>
        <option value="Waberi">Waberi</option>
        <option value="Wadajir">Wadajir</option>
        <option value="warta-nabada">Warta Nabada</option>
        <option value="Yaqshiid">Yaqshiid</option>
         <!-- Add more options as needed -->
      </select><br>

      <label for="role">Role:</label>
      <select id="role" name="role" required>
        <option value="Manager">Select</option>
        <option value="Admin">Admin</option>
        <option value="leadjob">Leadjob</option>
        <option value="Staff">Staff</option>
      </select><br>
      
      <label for="dateInput">Date:</label>
      <input type="date" id="dateInput" name="dates" value="<?php echo date('Y-m-d'); ?>" required><br><br>
      
      <label for="salary">Salary <i>$</i>:</label>
      <input type="number" id="amount" name="salary" min="0" step="0.01" required pattern="\d+(\.\d{1,2})?" title="Please enter a valid salary amount."><br><br>
        
      <button type="submit" name="empl_register" values="Register">Register</button>
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
</body>
</html>

<?php
include 'footer.php';
?>
