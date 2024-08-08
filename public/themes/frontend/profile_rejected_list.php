<!-- Requests list -->
<div class="row">
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-danger">Rejected Requests List</h2>
            <div>
                <button class="btn btn-outline-success" onclick="fetchAllRequests()">
                    <span class="icon-refresh"></span> Refresh
                </button>
                <button id="deleteRejectedListButton" class="btn btn-outline-danger"
                        onclick="confirmDeleteRequests(<?= $user['id']; ?>)">
                    <span class="icon-bin"></span> Clear all
                </button>
            </div>
        </div>

        <div id="rejectedRequestsContainer" class="list-group">
            <!-- Requests will be dynamically inserted here -->
        </div>
    </div>
</div>
<!-- end Requests list -->
