<?php
// File: admin/access-logs.php
session_start();

// // Check if user is logged in and is admin
// if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
//     header("Location: ../public/login.php");
//     exit;
// }

include 'include/header.php';
include 'include/admin-sidebar.php';
?>

<!-- Main Panel -->
<div class="main-panel">
  <div class="content-wrapper">
    <!-- Page Title -->
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Access Logs</h3>
            <h6 class="font-weight-normal mb-0">View and monitor document access activities</h6>
          </div>
          <div class="col-12 col-xl-4">
            <div class="justify-content-end d-flex">
              <button class="btn btn-primary" id="exportLogs">
                <i class="ti-download mr-1"></i> Export Logs
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Filters -->
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body py-3">
            <div class="row">
              <div class="col-md-3">
                <select class="form-control" id="action-filter">
                  <option value="">All Actions</option>
                  <option value="view">View</option>
                  <option value="download">Download</option>
                  <option value="upload">Upload</option>
                  <option value="delete">Delete</option>
                  <option value="flag">Flag</option>
                  <option value="login">Login</option>
                  <option value="logout">Logout</option>
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-control" id="user-filter">
                  <option value="">All Users</option>
                  <!-- Would be populated with actual user data -->
                  <option value="1">John Doe</option>
                  <option value="2">Maria Garcia</option>
                  <option value="3">Ahmed Khan</option>
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-control" id="date-filter">
                  <option value="">Any Date</option>
                  <option value="today">Today</option>
                  <option value="yesterday">Yesterday</option>
                  <option value="week">This Week</option>
                  <option value="month">This Month</option>
                </select>
              </div>
              <div class="col-md-3">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search logs...">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button">Search</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Access Logs Table -->
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="access-logs-table">
                <thead>
                  <tr>
                    <th>Log ID</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Document / Resource</th>
                    <th>Timestamp</th>
                    <th>IP Address</th>
                    <th>Status</th>
                    <th>Details</th>
                  </tr>  
                </thead>
                <tbody>
                  <?php
                  // Sample data - Would be replaced with actual data from database
                  $logs = [
                    [1, 'John Doe', 'Upload', 'Financial Report Q2.pdf', '2023-06-01 14:32:45', '192.168.1.45', 'Success', ''],
                    [2, 'Maria Garcia', 'Download', 'Marketing Plan.docx', '2023-06-01 13:15:22', '192.168.1.87', 'Success', ''],
                    [3, 'Ahmed Khan', 'View', 'Product Mockups.jpg', '2023-06-01 11:45:07', '192.168.1.22', 'Success', ''],
                    [4, 'Lisa Wong', 'Login', '', '2023-06-01 09:30:15', '192.168.1.67', 'Success', ''],
                    [5, 'Robert Smith', 'Flag', 'Sensitive Data.xlsx', '2023-05-31 16:55:33', '192.168.1.91', 'Success', 'Confidential Information'],
                    [6, 'John Doe', 'Delete', 'Old Contract.pdf', '2023-05-31 15:20:18', '192.168.1.45', 'Success', ''],
                    [7, 'Unknown', 'Login', '', '2023-05-31 12:10:42', '203.45.78.92', 'Failed', 'Invalid Credentials'],
                    [8, 'Emma Johnson', 'Upload', 'Team Photo.jpg', '2023-05-31 10:05:51', '192.168.1.33', 'Success', ''],
                    [9, 'Michael Brown', 'Download', 'Project Timeline.pdf', '2023-05-30 17:40:27', '192.168.1.15', 'Success', ''],
                    [10, 'Sophia Martinez', 'Logout', '', '2023-05-30 16:25:39', '192.168.1.72', 'Success', '']
                  ];
                  
                  foreach ($logs as $log) {
                    $statusClass = $log[6] == 'Success' ? 'badge-success' : 'badge-danger';
                    
                    // Set icon based on action
                    $actionIcon = '';
                    switch ($log[2]) {
                      case 'Upload':
                        $actionIcon = 'ti-upload';
                        break;
                      case 'Download':
                        $actionIcon = 'ti-download';
                        break;
                      case 'View':
                        $actionIcon = 'ti-eye';
                        break;
                      case 'Delete':
                        $actionIcon = 'ti-trash';
                        break;
                      case 'Flag':
                        $actionIcon = 'ti-flag-alt';
                        break;
                      case 'Login':
                        $actionIcon = 'ti-user';
                        break;
                      case 'Logout':
                        $actionIcon = 'ti-power-off';
                        break;
                      default:
                        $actionIcon = 'ti-file';
                    }
                    
                    echo '<tr>';
                    echo '<td>' . $log[0] . '</td>';
                    echo '<td>' . $log[1] . '</td>';
                    echo '<td><i class="' . $actionIcon . ' mr-1"></i> ' . $log[2] . '</td>';
                    echo '<td>' . $log[3] . '</td>';
                    echo '<td>' . $log[4] . '</td>';
                    echo '<td>' . $log[5] . '</td>';
                    echo '<td><span class="badge ' . $statusClass . '">' . $log[6] . '</span></td>';
                    echo '<td>' . $log[7] . '</td>';
                    echo '</tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- Pagination -->
            <div class="mt-4">
              <nav>
                <ul class="pagination justify-content-center">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                  </li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Activity Analytics -->
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Activity by Type</p>
            <canvas id="activityByTypeChart" height="300"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Activity Over Time</p>
            <canvas id="activityTimeChart" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
  $(document).ready(function() {
    // Initialize DataTable
    $('#access-logs-table').DataTable({
      "pageLength": 10,
      "lengthMenu": [10, 25, 50, 100],
      "order": [[ 4, "desc" ]],
      "language": {
        "search": "Search:",
        "lengthMenu": "Show _MENU_ entries per page",
        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
        "infoEmpty": "Showing 0 to 0 of 0 entries",
        "infoFiltered": "(filtered from _MAX_ total entries)"
      }
    });
    
    // Export logs
    $('#exportLogs').on('click', function() {
      // In a real application, you would trigger a download of the logs
      alert('Exporting logs as CSV...');
    });
    
    // Activity by Type Chart
    var activityTypeCtx = document.getElementById('activityByTypeChart').getContext('2d');
    var activityTypeChart = new Chart(activityTypeCtx, {
      type: 'doughnut',
      data: {
        labels: ['View', 'Download', 'Upload', 'Delete', 'Flag', 'Login/Logout'],
        datasets: [{
          data: [35, 25, 15, 10, 5, 10],
          backgroundColor: ['#4B49AC', '#248AFD', '#57B657', '#FF4747', '#FFC100', '#6E7E8F']
        }]
      },
      options: {
        responsive: true,
        legend: {
          position: 'bottom'
        }
      }
    });
    
    // Activity Over Time Chart
    var activityTimeCtx = document.getElementById('activityTimeChart').getContext('2d');
    var activityTimeChart = new Chart(activityTimeCtx, {
      type: 'line',
      data: {
        labels: ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00'],
        datasets: [{
          label: 'Today',
          data: [5, 3, 15, 25, 30, 20],
          borderColor: '#4B49AC',
          backgroundColor: 'rgba(75, 73, 172, 0.1)',
          borderWidth: 2,
          fill: true
        },
        {
          label: 'Yesterday',
          data: [8, 4, 12, 22, 28, 18],
          borderColor: '#FFC100',
          backgroundColor: 'rgba(255, 193, 0, 0.1)',
          borderWidth: 2,
          fill: true
        }]
      },
      options: {
        responsive: true,
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  });
</script>

<?php
include 'include/footer.php';
?>