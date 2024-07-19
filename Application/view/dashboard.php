<?php
include 'header.php';
include 'sidebar.php';
include '../config/connect.php';



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$totalProjectsQuery = "SELECT COUNT(*) as total_projects FROM asign_project";
$totalProjectsResult = $conn->query($totalProjectsQuery);
$totalProjectsRow = $totalProjectsResult->fetch_assoc();
$totalProjects = $totalProjectsRow['total_projects'];

// Fetch completed projects
$completedProjectsQuery = "SELECT COUNT(*) as completed_projects FROM asign_project WHERE status='Completed'";
$completedProjectsResult = $conn->query($completedProjectsQuery);
$completedProjectsRow = $completedProjectsResult->fetch_assoc();
$completedProjects = $completedProjectsRow['completed_projects'];

// Fetch pending projects
$pendingProjectsQuery = "SELECT COUNT(*) as pending_projects FROM asign_project WHERE status='Pending'";
$pendingProjectsResult = $conn->query($pendingProjectsQuery);
$pendingProjectsRow = $pendingProjectsResult->fetch_assoc();
$pendingProjects = $pendingProjectsRow['pending_projects'];

// Calculate completion rate
$completionRate = ($totalProjects > 0) ? ($completedProjects / $totalProjects) * 100 : 0;

// Determine arrow direction and color
$arrowClass = ($completedProjects >= ($totalProjects / 2)) ? 'fa-arrow-up text-c-green' : 'fa-arrow-down text-c-red';
$progressBarColor = ($completedProjects >= ($totalProjects / 2)) ? 'progress-c-theme' : 'progress-c-theme2';

// Define the project types you want to include in the chart
$allowedProjectTypes = ['Films', 'Event', 'Commercial', 'Documentary'];

// Query to count completed projects by project type
$query = $conn->query("
    SELECT project_type, COUNT(*) as total
    FROM asign_project
    WHERE status = 'Completed' AND project_type IN ('" . implode("','", $allowedProjectTypes) . "')
    GROUP BY project_type
");

if (!$query) {
    die("Query failed: " . $conn->error);
}

$projectTypes = [];
$projectCounts = [];

// Initialize counts for allowed project types
foreach ($allowedProjectTypes as $type) {
    $projectTypes[] = $type;
    $projectCounts[] = 0;
}

// Fetch data
while ($data = $query->fetch_assoc()) {
    $index = array_search($data['project_type'], $allowedProjectTypes);
    if ($index !== false) {
        $projectCounts[$index] = $data['total'];
    }
}

// Fetch top budget completed projects
$topBudgetProjectsQuery = "
    SELECT project_type, amount
    FROM asign_project 
    WHERE status = 'Completed' 
    ORDER BY amount DESC 
    LIMIT 5"; // Adjust the limit as per your requirement

$topBudgetProjectsResult = $conn->query($topBudgetProjectsQuery);

if (!$topBudgetProjectsResult) {
    die("Query failed: " . $conn->error);
}

$topBudgetProjects = [];
while ($row = $topBudgetProjectsResult->fetch_assoc()) {
    $topBudgetProjects[] = $row;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    body {
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 80%;
        padding-top: 10px;
        font-family: Arial, sans-serif;
        color: #000;
    }

    h3, h6, p, .card, .table-responsive, .chart-container, .card-block, .table-container {
        color: #000;
        
    }
    p{
        font-weight: bold;
    }

    /* You can include more elements if necessary */
    h3 {
        font-size: 200%;
        margin-top: 0;
    }

    .pcoded-inner-content {
        margin-top: 20px;
    }

    .card {
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(40px);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        margin-bottom: 20px;
    }

    .progress {
        height: 7px;
        background: #e0e0e0;
        border-radius: 5px;
    }

    .progress-bar {
        height: 7px;
        border-radius: 5px;
    }

    .progress-c-theme {
        background-color: #4caf50;
    }

    .progress-c-theme2 {
        background-color: #f44336;
    }

    .text-c-green {
        color: #4caf50;
    }

    .text-c-red {
        color: #f44336;
    }

    .chart-container {
        width: 90%;
        max-width: 450px;
        margin: 20px auto;
        marging-left: 2vh;
    }

    .pending-projects {
        margin-top: 15px;
        font-family: Arial, sans-serif;
    }

    .table-container {
        max-width: calc(90% - 50px); /* Adjust based on chart width + margin */
        float: right;
        padding-right: 60px; /* Adjust as needed for spacing */
        padding-left: 20px;
        margin-top: 25px;
    }

    .table-responsive {
        margin-top: 20px; /* Adjust for spacing */
    }
</style>

</head>
<body>
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <h3>Using Creativity to Create Stories</h3>
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="row">
                            <!-- Total Projects -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card Monthly-sales">
                                    <div class="card-block">
                                        <h6 class="mb-4">Total Projects</h6>
                                        <div class="row d-flex align-items-center ">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0">
                                                <i class="fas fa-clipboard" style="color: #07031E; font-size: 30px; margin-right: 10px;"></i>
                                                    <?php echo $totalProjects; ?>
                                                </h3>
                                            </div>
                                            <div class="col-3 text-right">
                                                <p class="m-b-0"><?php echo $totalProjects; ?></p>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme2" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Completed Projects -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card daily-sales">
                                    <div class="card-block">
                                        <h6 class="mb-4">Completed Projects</h6>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0">
                                                    <i class="fa <?php echo $arrowClass; ?> f-30 m-r-10"></i>
                                                    <?php echo $completedProjects; ?>
                                                </h3>
                                            </div>
                                            <div class="col-3 text-right">
                                                <p class="m-b-0"><?php echo $pendingProjects; ; ?></p>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar <?php echo $progressBarColor; ?>" role="progressbar" style="width: <?php echo $completionRate; ?>%;" aria-valuenow="<?php echo $completionRate; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pending Projects -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card yearly-sales">
                                    <div class="card-block">
                                        <h6 class="mb-4">Pending Projects</h6>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0">
                                                    <i class="fa fa-spinner fa-spin text-c-blue f-30 m-r-10"></i>
                                                    <?php echo $pendingProjects; ?>
                                                </h3>
                                            </div>
                                            <div class="col-3 text-right">
                                                <p class="m-b-0"><?php echo $pendingProjects; ?></p>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: <?php echo ($pendingProjects / $totalProjects) * 100; ?>%;" aria-valuenow="<?php echo ($pendingProjects / $totalProjects) * 100; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of row for main stats -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table Section -->
<div class="table-container">
    <div class="card">
        <div class="card-block">
        <h6 class="mb-6 ">Top Highly Budgeted Completed Projects <br></h6>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Budget</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($topBudgetProjects as $index => $project): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $project['project_type']; ?></td>
                            <td><?php echo $project['amount']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <!-- Chart Section -->
<div class="chart-container m-5">
    <h2>Project Completion Insights</h2>
    <canvas id="myChart"></canvas>
</div>
</div>





<!-- JavaScript for Chart -->
<script>
const labels = <?php echo json_encode($projectTypes); ?>;
const data = {
    labels: labels,
    datasets: [{
        label: 'Completed Projects',
        data: <?php echo json_encode($projectCounts); ?>,
        backgroundColor: ['rgba(7, 3, 30, 0.6)', 'rgba(135, 206, 235, 0.6)', 'rgba(50, 205, 50, 0.6)', 'rgba(127, 255, 212, 0.6)'],
        
    }]
};
const config = {
    type: 'doughnut',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        onClick: (event, elements) => {
            if (elements.length) {
                const element = elements[0];
                if (element.datasetIndex === 0) {
                    fetchPendingProjects();
                }
            }
        }
    }
};

const myChart = new Chart(
    document.getElementById('myChart'),
    config
);

function fetchPendingProjects() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_pending_projects.php', true);
    xhr.onload = function() {
        if (this.status === 200) {
            const response = JSON.parse(this.responseText);
            displayPendingProjects(response);
        }
    };
    xhr.send();
}

function displayPendingProjects(projects) {
    const pendingProjectsDiv = document.getElementById('pendingProjects');
    pendingProjectsDiv.innerHTML = '<h2>Pending Projects:</h2><ul>' +
        projects.map(project => `<li>${project.project_name} (${project.project_type})</li>`).join('') +
        '</ul>';
}
</script>

<?php
include 'footer.php';
?>
</body>
</html>
