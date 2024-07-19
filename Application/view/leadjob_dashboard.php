<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/css/feathericon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
   <link rel="stylesheet" href="../css/style.css"> 
    <title>UMS</title>
    <link rel="stylesheet" href="../css/sidebar.css">
  
</head>
<body>
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                <a href="index.html" class="b-brand">
                  <!-- <img src="white-logo.ico" alt="udub">-->
                  <span class="b-title">UMS</span>
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
            </div>
            <div class="navbar-content ">
                <ul class="nav pcoded-inner-navbar">
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item active">
                        <a href="Dashboard.php" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="">Dashboard</span></a>
                    </li>
                    <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds" class="nav-item pcoded-hasmenu">
                  
                    </li>
                    <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds" class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link"><span class="pcoded-micon"><i class="fas fa-calendar-check"></i></span><span class="">Projects</span></a>
                        <ul class="pcoded-submenu">
                           
                            <li><a href="view_assign_table.php" class="">view</a></li>
                        </ul>
                    </li>
                    <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds" class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Equipment</span></a>
                        <ul class="pcoded-submenu">
                            
                            <li><a href="Equip_table.php" class="">view</a></li>
                        </ul>
                    </li>
             

                    

                    </li>
                    <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds" class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link"><span class="pcoded-micon"><i class="fas fa-line-chart"></i></span><span class="pcoded-mtext">Report</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="Report.php" class="">Report Chart</a></li>
                        <!-- <li><a href="generate_pdf.php" class="">Generate Report</a></li> -->
                     </ul>



                   
                    <br><br><br>
                    <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds" class="nav-item">
                        <a href="javascript:" class="nav-link" id="logout-link"><span class="pcoded-micon"><i class="fas fa-sign-out"></i></span><span class="pcoded-mtext">Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- Logout Modal -->
    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="logo">
            <img src="udub-log.jpg" alt="Udub Films Logo">
        </div>
            <h2>You're attempting to logout of <br> Udub Films</h2>
            <p>Are you sure?</p>
        
            <button id="confirm-logout-btn" ac>Logout</button>
        </div>
    </div>
    <script>
    // Get the modal
    var modal = document.getElementById("logoutModal");

    // Get the link that opens the modal
    var logoutLink = document.getElementById("logout-link");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // Get the logout button inside the modal
    var confirmLogoutBtn = document.getElementById("confirm-logout-btn");

    // When the user clicks the link, open the modal
    logoutLink.onclick = function(event) {
        event.preventDefault();
        modal.style.display = "block";
    }
 
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks the logout button, proceed to logout
    confirmLogoutBtn.onclick = function() {
        // Redirect to the login page
        window.location.href = "login.php"; // Replace "login.php" with the actual login page URL
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>