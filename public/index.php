<?php
// File: public/index.php
include 'include/header.php';
include 'include/sidebar.php';
?>

<!-- Main Panel -->
<div class="main-panel">
  <div class="content-wrapper">
    <!-- Welcome Message -->
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Document Management</h3>
            <h6 class="font-weight-normal mb-0">Welcome to your document archive directory</h6>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="row">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card card-tale">
          <div class="card-body">
            <p class="mb-4">My Documents</p>
            <p class="fs-30 mb-2">
              <?php
              // Placeholder for document count
              echo "24";
              ?>
            </p>
            <p>Last uploaded: 2 days ago</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card card-dark-blue">
          <div class="card-body">
            <p class="mb-4">PDF Documents</p>
            <p class="fs-30 mb-2">
              <?php
              // Placeholder for PDF count
              echo "15";
              ?>
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Image Files</p>
            <p class="fs-30 mb-2">
              <?php
              // Placeholder for image count (combined png and jpg since mao ray want ni sir for image)
              echo "9";
              ?>
            </p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Recent Documents -->
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title">Recent Documents</p>
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Document Name</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Uploaded</th>
                    <th>Actions</th>
                  </tr>  
                </thead>
                <tbody>
                  <?php
                  // Sample data - Would be replaced with actual data from database
                  $documents = [
                    ['Project Proposal', 'PDF', '4.2 MB', '2 days ago'],
                    ['Financial Analysis', 'PDF', '1.8 MB', '5 days ago'],
                    ['Meeting Notes', 'PDF', '0.3 MB', '1 week ago'],
                    ['Product Image', 'JPG', '1.2 MB', '2 weeks ago'],
                    ['Logo Design', 'PNG', '0.5 MB', '3 weeks ago']
                  ];
                  
                  foreach ($documents as $doc) {
                    echo '<tr>';
                    echo '<td>' . $doc[0] . '</td>';
                    echo '<td>' . $doc[1] . '</td>';
                    echo '<td>' . $doc[2] . '</td>';
                    echo '<td>' . $doc[3] . '</td>';
                    echo '<td>
                            <a href="view.php?doc=' . urlencode($doc[0]) . '" class="btn btn-dark btn-icon-text btn-sm">
                              View
                              <i class="ti-file btn-icon-append"></i>
                            </a>
                            <a href="download.php?doc=' . urlencode($doc[0]) . '" class="btn btn-primary btn-icon-text btn-sm">
                              <i class="ti-download btn-icon-prepend"></i>
                              Download
                            </a>
                          </td>';
                    echo '</tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="text-center mt-4">
              <a href="my-documents.php" class="btn btn-primary">View All Documents</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
include 'include/footer.php';
?>