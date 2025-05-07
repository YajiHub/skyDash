<?php
// // File: admin/dashboard.php
// session_start();

// // Check if user is logged in and is admin
// if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
//     header("Location: ../public/login.php");
//     exit;
// }

include '../public/include/header.php';
include '../public/include/admin-sidebar.php';
?>

<!-- Main Panel -->
<div class="main-panel">
  <div class="content-wrapper">
    <!-- Welcome Message -->
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Administrator Dashboard</h3>
            <h6 class="font-weight-normal mb-0">Manage your document archive directory</h6>
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
            <p class="mb-4">Total Users</p>
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
            <p class="mb-4">Document Types</p>
            <div class="d-flex justify-content-between">
              <p>PDF: <span class="font-weight-bold">78</span></p>
              <p>PNG: <span class="font-weight-bold">35</span></p>
              <p>JPG: <span class="font-weight-bold">32</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Document Categories -->
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Document Categories</p>
            <canvas id="documentCategoriesChart" height="300"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Access Level Distribution</p>
            <canvas id="accessLevelChart" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
    
    <!-- File Upload Trends -->
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">File Upload Trends</p>
            <canvas id="fileUploadTrendsChart" height="250"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
// Document Categories chart
var categoryCtx = document.getElementById('documentCategoriesChart').getContext('2d');
var categoryChart = new Chart(categoryCtx, {
  type: 'doughnut',
  data: {
    labels: ['Reports', 'Contracts', 'Presentations', 'Invoices', 'Other'],
    datasets: [{
      data: [35, 25, 20, 15, 5],
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

// Access Level Distribution chart
var accessLevelCtx = document.getElementById('accessLevelChart').getContext('2d');
var accessLevelChart = new Chart(accessLevelCtx, {
  type: 'bar',
  data: {
    labels: ['Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5'],
    datasets: [{
      label: 'Documents',
      data: [50, 40, 30, 15, 10],
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

// File Upload Trends chart
var trendsCtx = document.getElementById('fileUploadTrendsChart').getContext('2d');
var trendsChart = new Chart(trendsCtx, {
  type: 'line',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    datasets: [{
      label: 'PDF',
      data: [12, 19, 15, 22, 30, 25],
      borderColor: '#4B49AC',
      backgroundColor: 'rgba(75, 73, 172, 0.1)',
      borderWidth: 2,
      fill: true
    },
    {
      label: 'Images (PNG & JPG)',
      data: [8, 14, 12, 18, 22, 20],
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
</script>

<?php
include '../public/include/footer.php';
?>