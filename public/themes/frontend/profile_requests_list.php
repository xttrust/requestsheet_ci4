<!-- Requests list -->
<div class="row">
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Requests List</h2>
            <button class="btn btn-outline-success" onclick="location.reload();">
                <span class="icon-refresh"></span> Refresh Requests
            </button>
        </div>

        <div class="list-group">
            <!-- List Group Item 1 -->
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1 text-dark">Call on me - Eric Prydz</h5>
                    <p class="mb-1 text-secondary">Requested by: xttrust</p>
                </div>
                <div class="btn-group" role="group">
                    <!-- Info button to trigger a modal -->
                    <button type="button"
                            class="btn btn-dark btn-small"
                            data-bs-toggle="modal"
                            data-bs-target="#infoModal"
                            title="View Comments">
                        <span class="icon-info2"></span>
                    </button>
                    <!-- Accept button -->
                    <button type="button" class="btn btn-success btn-small" title="Accept request">
                        <span class="icon-check"></span>
                    </button>
                    <!-- Reject button -->
                    <button type="button" class="btn btn-danger btn-small" title="Reject request">
                        <span class="icon-close"></span>
                    </button>
                    <!-- Email button -->
                    <a href="mailto:requestor@example.com" class="btn btn-dark btn-small" title="Email Requestor">
                        <span class="icon-envelope"></span>
                    </a>
                </div>
            </div>

            <!-- List Group Item 2 (duplicate, adjust as needed) -->
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1 text-dark">Call on me - Eric Prydz</h5>
                    <p class="mb-1 text-secondary">Requested by: xttrust</p>
                </div>
                <div class="btn-group" role="group">
                    <!-- Info button to trigger a modal -->
                    <button type="button"
                            class="btn btn-dark btn-small"
                            data-bs-toggle="modal"
                            data-bs-target="#infoModal"
                            title="View Comments">
                        <span class="icon-info2"></span>
                    </button>
                    <!-- Accept button -->
                    <button type="button" class="btn btn-success btn-small" title="Accept request">
                        <span class="icon-check"></span>
                    </button>
                    <!-- Reject button -->
                    <button type="button" class="btn btn-danger btn-small" title="Reject request">
                        <span class="icon-close"></span>
                    </button>
                    <!-- Email button -->
                    <a href="mailto:requestor@example.com" class="btn btn-dark btn-small" title="Email Requestor">
                        <span class="icon-envelope"></span>
                    </a>
                </div>
            </div>

            <!-- Modal for Info button -->
            <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h5 class="modal-title" id="infoModalLabel">View Comments</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-white text-black">
                            <p class="text-dark">Details about the request go here.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</div>
<!-- end Requests list -->