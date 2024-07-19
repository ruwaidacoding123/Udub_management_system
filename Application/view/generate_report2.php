<?php
// Include the TCPDF library and database connection
require_once 'TCPDF-main/tcpdf.php';
include '../config/connect.php'; // Ensure this file contains the $conn variable for database connection

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Function to fetch data from the database based on report type and date range
function fetchDataFromDatabase($conn, $reportType, $startDate, $endDate) {
    $data = array();

    switch ($reportType) {
        case 'employee':
            $sql = "SELECT * FROM register_empl WHERE Date BETWEEN '$startDate' AND '$endDate'";
            break;

        case 'projects_deposit':
            $sql = "SELECT 
                        id, 
                        project_type, 
                        client_name,
                        phone_number,
                        amount AS budget_amount, 
                        deposit_amount, 
                        (amount - deposit_amount) AS remaining_balance,
                        deposit_date
                    FROM 
                        asign_project 
                    WHERE 
                        deposit_amount IS NOT NULL AND deposit_amount > 0
                        AND deposit_date BETWEEN '$startDate' AND '$endDate'";
            break;

        case 'projects_all':
            $sql = "SELECT * FROM asign_project WHERE date BETWEEN '$startDate' AND '$endDate'";
            break;

        case 'equipment':
            $sql = "SELECT name, model, manufacturer, price, status, date_acquired FROM register_equip WHERE date_acquired BETWEEN '$startDate' AND '$endDate'";
            break;

        case 'finance':
            $sql = "SELECT entry_type, amount,   description , date FROM finance WHERE date BETWEEN '$startDate' AND '$endDate'";
            break;

        case 'net_income':
            // Fetch total revenue from ongoing projects (deposit amounts where status is 'pending')
            $ongoingProjectsQuery = "SELECT SUM(deposit_amount) AS total_ongoing_projects FROM asign_project WHERE status = 'pending' AND deposit_date BETWEEN '$startDate' AND '$endDate'";
            $ongoingProjectsResult = $conn->query($ongoingProjectsQuery);
            $totalOngoingProjects = $ongoingProjectsResult->fetch_assoc()['total_ongoing_projects'] ?? 0;

            // Fetch total revenue from completed projects (where status is 'completed')
            $completedProjectsQuery = "SELECT SUM(deposit_amount) AS total_completed_projects FROM asign_project WHERE status = 'completed' AND deposit_date BETWEEN '$startDate' AND '$endDate'";
            $completedProjectsResult = $conn->query($completedProjectsQuery);
            $totalCompletedProjects = $completedProjectsResult->fetch_assoc()['total_completed_projects'] ?? 0;

            // Calculate total revenue (total income)
            $totalRevenue = $totalOngoingProjects + $totalCompletedProjects;

            // Fetch total equipment costs
            $equipmentQuery = "SELECT SUM(price) AS total_equipment FROM register_equip WHERE date_acquired BETWEEN '$startDate' AND '$endDate'";
            $equipmentResult = $conn->query($equipmentQuery);
            $totalEquipment = $equipmentResult->fetch_assoc()['total_equipment'] ?? 0;

            // Fetch total operational expenses
            $expensesQuery = "SELECT SUM(amount) AS total_expenses FROM finance WHERE date BETWEEN '$startDate' AND '$endDate'";
            $expensesResult = $conn->query($expensesQuery);
            $totalExpenses = $expensesResult->fetch_assoc()['total_expenses'] ?? 0;

            // Calculate total expenses (sum of equipment costs and operational expenses)
            $totalExpenses += $totalEquipment;

            // Calculate net income
            $netIncome = $totalRevenue - $totalExpenses;

            $data[] = array(
                'total_ongoing_projects' => $totalOngoingProjects,
                'total_completed_projects' => $totalCompletedProjects,
                'total_revenue' => $totalRevenue,
                'total_expenses' => $totalExpenses,
                'total_equipment' => $totalEquipment,
                'net_income' => $netIncome
            );
            break;

        default:
            $sql = "";
            break;
    }

    if (!empty($sql) && $reportType != 'net_income') {
        $result = $conn->query($sql);

        if ($result === false) {
            // Capture SQL error for debugging
            $data['error'] = "SQL error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        } else {
            $data['error'] = "No data found";
        }
    }

    return $data;
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $reportType = $_POST['report_type'];

    // Fetch data based on selected report type and date range
    $reportData = fetchDataFromDatabase($conn, $reportType, $startDate, $endDate);

    // Generate PDF using TCPDF
    // Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetHeaderData('', 0, '', '', array(0,64,255), array(0,64,128));
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '1', PDF_FONT_SIZE_DATA));

    // Add a page
    $pdf->AddPage();

    $pdf->SetFont('times', '', 12);

    // Header content
    $header = '<table width="100%">
        <tr>
            <td width="50%">' . '<img src="udub-log.jpg" alt="Company Logo" style="height: 30px; width: auto; margin-top: 10vh;" />' . '</td>
            <td width="50%" align="right">Udub Films</td>
        </tr>
    </table>';
    $pdf->writeHTML($header, true, false, true, false, '');

    // Content
    $startDateFormatted = (new DateTime($startDate))->format('d/m/Y');
    $endDateFormatted = (new DateTime($endDate))->format('d/m/Y');

    $content = '<h1>Report</h1>';
    $content .= '<p>Report Type: ' . ucfirst($reportType) . '</p>';
    $content .= '<p>Start Date: ' . $startDateFormatted . '</p>';
    $content .= '<p>End Date: ' . $endDateFormatted . '</p>';

    // Display fetched data in the PDF
    if (!empty($reportData)) {
        $content .= '<h2>Data:</h2>';
        $content .= '<table border="1" cellpadding="4" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">';

        // Display data based on report type
        switch ($reportType) {
            case 'employee':
                $content .= '<tr style="background-color: #000; color: white;"><th>First Name</th><th>Last Name</th><th>Phone Num</th><th>Address</th><th>Role</th><th>Date</th><th>Salary</th></tr>';
                foreach ($reportData as $row) {
                    $content .= '<tr>';
                    $content .= '<td>' . (isset($row['First_Name']) ? $row['First_Name'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['Last_Name']) ? $row['Last_Name'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['phonenumber']) ? $row['phonenumber'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['Address']) ? $row['Address'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['Role']) ? $row['Role'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['Date']) ? $row['Date'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['Salary']) ? $row['Salary'] : '') . '</td>';
                    $content .= '</tr>';
                }
                break;

            case 'projects_deposit':
                $content .= '<tr style="background-color: #000; color: white;"><th>Project Type</th><th>Client Name</th><th>Phone Num</th><th>Amount</th><th>Deposit Amount</th><th>Remaining Balance</th><th>Deposit Date</th></tr>';
                foreach ($reportData as $row) {
                    $content .= '<tr>';
                    $content .= '<td>' . (isset($row['project_type']) ? $row['project_type'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['client_name']) ? $row['client_name'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['phone_number']) ? $row['phone_number'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['budget_amount']) ? $row['budget_amount'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['deposit_amount']) ? $row['deposit_amount'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['remaining_balance']) ? $row['remaining_balance'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['deposit_date']) ? $row['deposit_date'] : '') . '</td>';
                    $content .= '</tr>';
                }
                break;

            case 'projects_all':
                $content .= '<tr style="background-color: #000; color: white;"><th>Project Type</th><th>Client Name</th><th>Phone Num</th><th>Date</th><th>Status</th><th>Amount</th><th>Deposit Amount</th><th>Deposit date</th></tr>';
                foreach ($reportData as $row) {
                    $content .= '<tr>';
                    $content .= '<td>' . (isset($row['project_type']) ? $row['project_type'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['client_name']) ? $row['client_name'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['phone_number']) ? $row['phone_number'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['date']) ? $row['date'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['status']) ? $row['status'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['amount']) ? $row['amount'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['deposit_amount']) ? $row['deposit_amount'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['deposit_date']) ? $row['deposit_date'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['end_date']) ? $row['end_date'] : '') . '</td>';
                    $content .= '</tr>';
                }
                break;

            case 'equipment':
                $content .= '<tr style="background-color: #000; color: white;"><th>Equipment Name</th><th>Model</th><th>Manufacturer</th><th>date acquired</th><th>Status</th><th>Price</th></tr>';
                foreach ($reportData as $row) {
                    $content .= '<tr>';
                    $content .= '<td>' . (isset($row['name']) ? $row['name'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['model']) ? $row['model'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['manufacturer']) ? $row['manufacturer'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['date_acquired']) ? $row['date_acquired'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['status']) ? $row['status'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['price']) ? $row['price'] : '') . '</td>';

                    $content .= '</tr>';
                }
                break;

            case 'finance':
                $content .= '<tr style="background-color: #000; color: white;"><th>Entry Type</th><th>Description</th><th>Amount</th><th>Date</th></tr>';
                foreach ($reportData as $row) {
                    $content .= '<tr>';
                    $content .= '<td>' . (isset($row['entry_type']) ? $row['entry_type'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['description']) ? $row['description'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['amount']) ? $row['amount'] : '') . '</td>';
                    $content .= '<td>' . (isset($row['date']) ? $row['date'] : '') . '</td>';
                    
                    $content .= '</tr>';
                }
                break;

            case 'net_income':
                $content .= '<tr style="background-color: #000; color: white;"><th>Category</th><th>Amount</th></tr>';
                foreach ($reportData as $row) {
                    // Calculate net income
                    $netIncome = $row['net_income'];
                    
                    // Determine color based on net income (profit or loss)
                    $color = ($netIncome >= 0) ? 'green' : 'red';
                    
                    $content .= '<tr><td>Ongoing Projects</td><td>' . number_format($row['total_ongoing_projects'], 2) . '</td></tr>';
                    $content .= '<tr><td>Completed Projects</td><td>' . number_format($row['total_completed_projects'], 2) . '</td></tr>';
                    $content .= '<tr><td><strong>Total Income</strong></td><td><strong>' . number_format($row['total_revenue'], 2) . '</strong></td></tr>';
                    $content .= '<tr><td>Equipment Purchases</td><td>' . number_format($row['total_equipment'], 2) . '</td></tr>';
                    $content .= '<tr><td>Expenses</td><td>' . number_format($row['total_expenses'] - $row['total_equipment'], 2) . '</td></tr>';
                    $content .= '<tr><td><strong>Total Expenses</strong></td><td><strong>' . number_format($row['total_expenses'], 2) . '</strong></td></tr>';
                    $content .= '<tr><td><strong>Net</strong></td><td><strong><span style="color: ' . $color . '">$' . number_format($netIncome, 2) . '</span></strong></td></tr>';
                }
                break;

            default:
                $content .= '<tr><td colspan="2">No data available for the selected criteria.</td></tr>';
                break;
        }

        $content .= '</table>';
    } else {
        $content .= '<p>No data available for the selected criteria.</p>';
    }

    // Output content
    $pdf->writeHTML($content, true, false, true, false, '');

    // Close and output PDF document
    $pdf->Output('generated_report.pdf', 'I');

    // Close connection
    $conn->close();
}
?>
