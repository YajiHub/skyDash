<?php
// File: public/view.php
include 'include/header.php';
include 'include/sidebar.php';

// Get document ID from URL parameter
$doc_id = isset($_GET['doc']) ? $_GET['doc'] : '';

// In a real application, you would fetch document details from a database
// This is a placeholder for demonstration purposes
$document = [
  'id' => 1,
  'title' => 'Project Proposal',
  'type' => 'PDF',
  'size' => '4.2 MB',
  'uploaded_date' => '2023-06-01',
  'description' => 'This document contains the project proposal for the new marketing campaign.',
  'tags' => ['project', 'proposal', 'marketing'],
  'path' => 'sample-files/sample.pdf'
];
?>

<!-- Main Panel -->
<div class="main-panel">
  <div class="content-wrapper">
    <!-- Page Title -->
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold"><?php echo htmlspecialchars($document['title']); ?></h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="my-documents.php">My Documents</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($document['title']); ?></li>
              </ol>
            </nav>
          </div>
          <div class="col-12 col-xl-4">
            <div class="justify-content-end d-flex">
              <a href="download.php?doc=<?php echo urlencode($doc_id); ?>" class="btn btn-primary mr-2">
                <i class="ti-download mr-1"></i> Download
              </a>
              <a href="delete.php?doc=<?php echo urlencode($doc_id); ?>" class="btn btn-danger delete-doc">
                <i class="ti-trash mr-1"></i> Delete
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Document View -->
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="document-viewer">
              <?php 
              // Based on document type, display appropriate viewer
              if ($document['type'] == 'PDF') {
                echo '<iframe src="' . $document['path'] . '" width="100%" height="600px" style="border: none;"></iframe>';
              } elseif ($document['type'] == 'JPG' || $document['type'] == 'PNG') {
                echo '<img src="' . $document['path'] . '" class="img-fluid" alt="' . htmlspecialchars($document['title']) . '">';
              } else {
                echo '<div class="alert alert-warning">Preview not available for this file type.</div>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Document Details</h4>
            <div class="list-group list-group-flush">
              <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                <span class="font-weight-bold">File Type:</span>
                <span class="badge badge-info"><?php echo htmlspecialchars($document['type']); ?></span>
              </div>
              <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                <span class="font-weight-bold">Size:</span>
                <span><?php echo htmlspecialchars($document['size']); ?></span>
              </div>
              <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                <span class="font-weight-bold">Uploaded:</span>
                <span><?php echo htmlspecialchars($document['uploaded_date']); ?></span>
              </div>
              <div class="list-group-item px-0">
                <span class="font-weight-bold">Description:</span>
                <p class="mt-2"><?php echo htmlspecialchars($document['description']); ?></p>
              </div>
              <div class="list-group-item px-0">
                <span class="font-weight-bold">Tags:</span>
                <div class="mt-2">
                  <?php
                  foreach ($document['tags'] as $tag) {
                    echo '<span class="badge badge-primary mr-1">' . htmlspecialchars($tag) . '</span>';
                  }
                  ?>
                </div>
              </div>
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
          <a href="delete.php?doc=<?php echo urlencode($doc_id); ?>" class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>

<script>
  // Script for delete confirmation
  $(document).ready(function() {
    $('.delete-doc').on('click', function(e) {
      e.preventDefault();
      $('#deleteModal').modal('show');
    });
  });
</script>

<?php
include 'include/footer.php';
?>