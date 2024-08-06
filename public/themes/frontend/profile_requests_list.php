<!-- Requests list -->
<div class="row">
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Requests List</h2>
            <button class="btn btn-outline-success" onclick="fetchRequests();">
                <span class="icon-refresh"></span> Refresh
            </button>
        </div>

        <div id="requestsContainer" class="list-group">
            <!-- Requests will be dynamically inserted here -->
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
                        <p class="text-dark" id='comment'></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Requests list -->