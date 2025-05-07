<?php
// File: admin/flagged-documents.php
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
            <h3 class="font-weight-bold">Flagged Documents</h3>
            <h6 class="font-weight-normal mb-0">Review and manage flagged documents</h6>
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
                <select class="form-control" id="flag-reason-filter">
                  <option value="">All Flag Reasons</option>
                  <option value="inappropriate">Inappropriate Content</option>
                  <option value="copyright">Copyright Violation</option>
                  <option value="confidential">Confidential Information</option>
                  <option value="irrelevant">Irrelevant Content</option>
                  <option value="other">Other</option>
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
                  <input type="text" class="form-control" placeholder="Search flagged documents...">
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
    
    <!-- Flagged Documents Table -->
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="flagged-documents-table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Document Name</th>
                    <th>Owner</th>
                    <th>Flagged By</th>
                    <th>Flagged Date</th>
                    <th>Flag Reason</th>
                    <th>Actions</th>
                  </tr>  
                </thead>
                <tbody>
                  <?php
                  // Sample data - Would be replaced with actual data from database
                  $flagged_documents = [
                    [1, 'Product Image', 'Lisa Wong', 'John Smith', '2023-06-01', 'Inappropriate Content'],
                    [2, 'Contract Document', 'John Doe', 'Maria Garcia', '2023-05-28', 'Confidential Information'],
                    [3, 'Team Photo', 'Robert Smith', 'Ahmed Khan', '2023-05-20', 'Copyright Violation'],
                    [4, 'Customer List', 'Emma Johnson', 'Sophia Martinez', '2023-05-15', 'Confidential Information'],
                    [5, 'Marketing Material', 'Michael Brown', 'Robert Adams', '2023-05-10', 'Other']
                  ];
                  
                  foreach ($flagged_documents as $doc) {
                    echo '<tr>';
                    echo '<td>' . $doc[0] . '</td>';
                    echo '<td>' . $doc[1] . '</td>';
                    echo '<td>' . $doc[2] . '</td>';
                    echo '<td>' . $doc[3] . '</td>';
                    echo '<td>' . $doc[4] . '</td>';
                    echo '<td><span class="badge badge-warning">' . $doc[5] . '</span></td>';
                    echo '<td>
                            <a href="view-document.php?id=' . $doc[0] . '" class="btn btn-info btn-sm" title="View Document">
                              <i class="ti-eye"></i>
                            </a>
                            <button type="button" class="btn btn-success btn-sm approve-document" data-id="' . $doc[0] . '" title="Approve Document">
                              <i class="ti-check"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm remove-document" data-id="' . $doc[0] . '" title="Remove Document">
                              <i class="ti-trash"></i>
                            </button>
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

  <!-- Approve Document Modal -->
  <div class="modal fade" id="approveDocumentModal" tabindex="-1" role="dialog" aria-labelledby="approveDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="approveDocumentModalLabel">Approve Document</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to approve this document? This will remove the flag.</p>
          <form id="approveDocumentForm" action="process-approve-document.php" method="post">
            <input type="hidden" id="approveDocumentId" name="documentId" value="">
            <div class="form-group">
              <label for="approveComments">Comments for User (Optional)</label>
              <textarea class="form-control" id="approveComments" name="approveComments" rows="3"></textarea>
              <small class="form-text text-muted">These comments will be sent to the document owner.</small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Approve Document</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Remove Document Modal -->
  <div class="modal fade" id="removeDocumentModal" tabindex="-1" role="dialog" aria-labelledby="removeDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeDocumentModalLabel">Remove Document</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to permanently remove this document? This action cannot be undone.</p>
          <form id="removeDocumentForm" action="process-remove-document.php" method="post">
            <input type="hidden" id="removeDocumentId" name="documentId" value="">
            <div class="form-group">
              <label for="removeReason">Reason for Removal</label>
              <textarea class="form-control" id="removeReason" name="removeReason" rows="3" required></textarea>
              <small class="form-text text-muted">These comments will be sent to the document owner.</small>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Remove Document</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<script>
  $(document).ready(function() {
    // Approve document
    $('.approve-document').on('click', function() {
      var documentId = $(this).data('id');
      $('#approveDocumentId').val(documentId);
      $('#approveDocumentModal').modal('show');
    });
    
    // Remove document
    $('.remove-document').on('click', function() {
      var documentId = $(this).data('id');
      $('#removeDocumentId').val(documentId);
      $('#removeDocumentModal').modal('show');
    });

    // Initialize DataTable
    $('#flagged-documents-table').DataTable({
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
  });
</script>

<?php
include 'include/footer.php';
?>