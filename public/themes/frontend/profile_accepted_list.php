<!-- Requests list -->
<div class="row">
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-danger">Accepted Requests List</h2>
            <div>
                <button class="btn btn-outline-success" onclick="fetchAllRequests()">
                    <span class="icon-refresh"></span> Refresh
                </button>
            </div>
        </div>

        <div id="acceptedRequestsContainer" class="list-group">
            <!-- Requests will be dynamically inserted here -->
        </div>
    </div>
</div>
<!-- end Requests list -->
