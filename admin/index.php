<?php
// // File: admin/index.php
// session_start();

// // Check if user is logged in and is admin
// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header("Location: ../public/login.php");
//     exit;
// }

include '../public/include/header.php';
include '../public/include/sidebar.php';
?>

<!-- Main Panel -->
<div class="main-panel">
  <div class="content-wrapper">
    <!-- Welcome Message -->
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Admin Dashboard</h3>
            <h6 class="font-weight-normal mb-0">Welcome to the administration panel</h6>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="row">
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card card-tale">
          <div class="card-body">
            <p class="mb-4">Total Documents</p>
            <p class="fs-30 mb-2">
              <?php
              // Placeholder for total documents count
              echo "145";
              ?>
            </p>
            <p>Across all users</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card card-dark-blue">
          <div class="card-body">
            <p class="mb-4">Registered Users</p>
            <p class="fs-30 mb-2">
              <?php
              // Placeholder for user count
              echo "32";
              ?>
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Flagged Documents</p>
            <p class="fs-30 mb-2">
              <?php
              // Placeholder for flagged documents count
              echo "5";
              ?>
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card card-light-danger">
          <div class="card-body">
            <p class="mb-4">Storage Used</p>
            <p class="fs-30 mb-2">
              <?php
              // Placeholder for storage usage
              echo "1.2 GB";
              ?>
            </p>
            <p>Of 10 GB total</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Recent Activity</p>
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Document</th>
                    <th>Timestamp</th>
                    <th>IP Address</th>
                  </tr>  
                </thead>
                <tbody>
                  <?php
                  // Sample data - Would be replaced with actual data from database
                  $activities = [
                    ['John Doe', 'Upload', 'Financial Report Q2.pdf', '2 hours ago', '192.168.1.45'],
                    ['Maria Garcia', 'Download', 'Marketing Plan.docx', '4 hours ago', '192.168.1.87'],
                    ['Ahmed Khan', 'View', 'Product Mockups.jpg', '6 hours ago', '192.168.1.22'],
                    ['Lisa Wong', 'Delete', 'Old Contract.pdf', '1 day ago', '192.168.1.67'],
                    ['Robert Smith', 'Flag', 'Sensitive Data.xlsx', '1 day ago', '192.168.1.91']
                  ];
                  
                  foreach ($activities as $activity) {
                    echo '<tr>';
                    echo '<td>' . $activity[0] . '</td>';
                    echo '<td>' . $activity[1] . '</td>';
                    echo '<td>' . $activity[2] . '</td>';
                    echo '<td>' . $activity[3] . '</td>';
                    echo '<td>' . $activity[4] . '</td>';
                    echo '</tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="text-center mt-4">
              <a href="activity-log.php" class="btn btn-primary">View Full Activity Log</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- System Stats -->
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Storage Distribution</p>
            <canvas id="storage-chart" height="250"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Document Types</p>
            <canvas id="document-types-chart" height="250"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
  // Storage distribution chart
  var storageCtx = document.getElementById('storage-chart').getContext('2d');
  var storageChart = new Chart(storageCtx, {
    type: 'doughnut',
    data: {
      labels: ['PDF Files', 'Images', 'Word Documents', 'Excel Files', 'Other'],
      datasets: [{
        data: [45, 25, 15, 10, 5],
        backgroundColor: ['#4B49AC', '#248AFD', '#57B657', '#FFC100', '#FF4747']
      }]
    },
    options: {
      responsive: true,
      legend: {
        position: 'bottom'
      }
    }
  });

  // Document types chart
  var typesCtx = document.getElementById('document-types-chart').getContext('2d');
  var typesChart = new Chart(typesCtx, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Documents Uploaded',
        data: [12, 19, 15, 22, 30, 25],
        backgroundColor: '#4B49AC'
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
</script>

<?php
include '../public/include/footer.php';
?>