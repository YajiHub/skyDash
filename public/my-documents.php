<?php
// File: public/my-documents.php
include 'include/header.php';
include 'include/sidebar.php';
?>

<!-- Main Panel -->
<div class="main-panel">
  <div class="content-wrapper">
    <!-- Page Title -->
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">My Documents</h3>
            <h6 class="font-weight-normal mb-0">View all your uploaded documents</h6>
          </div>
          <div class="col-12 col-xl-4">
            <div class="justify-content-end d-flex">
              <a href="upload.php" class="btn btn-primary">
                <i class="ti-upload mr-1"></i> Upload New Document
              </a>
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
                <select class="form-control" id="type-filter">
                  <option value="">All Types</option>
                  <option value="PDF">PDF</option>
                  <option value="JPG">JPG</option>
                  <option value="PNG">PNG</option>
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-control" id="date-filter">
                  <option value="">Any Date</option>
                  <option value="today">Today</option>
                  <option value="week">This Week</option>
                  <option value="month">This Month</option>
                  <option value="year">This Year</option>
                </select>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search documents...">
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
    
    <!-- Documents Table -->
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="documents-table">
                <thead>
                  <tr>
                    <th>Document Name</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Uploaded Date</th>
                    <th>Actions</th>
                  </tr>  
                </thead>
                <tbody>
                  <?php
                  // Sample data - Would be replaced with actual data from database
                  $documents = [
                    ['Project Proposal', 'PDF', '4.2 MB', '2023-06-01'],
                    ['Financial Analysis', 'PDF', '1.8 MB', '2023-05-28'],
                    ['Meeting Notes', 'PDF', '0.3 MB', '2023-05-20'],
                    ['Product Image', 'JPG', '1.2 MB', '2023-05-15'],
                    ['Logo Design', 'PNG', '0.5 MB', '2023-05-10'],
                    ['Marketing Plan', 'PDF', '3.2 MB', '2023-05-05'],
                    ['Client Portrait', 'JPG', '2.8 MB', '2023-04-30'],
                    ['Technical Diagram', 'PNG', '1.5 MB', '2023-04-25'],
                    ['Contract Document', 'PDF', '1.7 MB', '2023-04-20'],
                    ['Event Flyer', 'PNG', '2.1 MB', '2023-04-15']
                  ];
                  
                  foreach ($documents as $doc) {
                    echo '<tr>';
                    echo '<td>' . $doc[0] . '</td>';
                    echo '<td><span class="badge badge-info">' . $doc[1] . '</span></td>';
                    echo '<td>' . $doc[2] . '</td>';
                    echo '<td>' . $doc[3] . '</td>';
                    echo '<td>
                            <a href="view.php?doc=' . urlencode($doc[0]) . '" class="btn btn-dark btn-icon-text btn-sm">
                              <i class="ti-eye"></i> View
                            </a>
                            <a href="download.php?doc=' . urlencode($doc[0]) . '" class="btn btn-primary btn-icon-text btn-sm">
                              <i class="ti-download"></i> Download
                            </a>
                            <a href="delete.php?doc=' . urlencode($doc[0]) . '" class="btn btn-danger btn-icon-text btn-sm delete-doc">
                              <i class="ti-trash"></i> Delete
                            </a>
                          </td>';
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
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to move this document to trash?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <a href="#" id="confirm-delete" class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>

<script>
  // Script for delete confirmation
  $(document).ready(function() {
    $('.delete-doc').on('click', function(e) {
      e.preventDefault();
      var deleteUrl = $(this).attr('href');
      $('#confirm-delete').attr('href', deleteUrl);
      $('#deleteModal').modal('show');
    });
  });
</script>

<?php
include 'include/footer.php';
?>