<!-- Requests list -->
<div class="row">
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Requests List</h2>
            <button class="btn btn-outline-success" onclick="fetchRequests();">
                <span class="icon-refresh"></span> Refresh Requests
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
<!-- end Requests list -->

<script>
// Function to fetch requests from the API
                function fetchRequests() {
                fetch('/api/requests/sorted')
                        .then(response => response.json())
                        .then(data => {
                        const requestsContainer = document.getElementById('requestsContainer');
                                        requestsContainer.innerHTML = ''; // Clear previous content

                                        data.data.forEach(request => {
                                        // Create request item
                                        const requestItem = document.createElement('div');
                                                requestItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                                                requestItem.innerHTML = `
                                                        <div>
                        <h5 class="mb-1 text-dark">${request.song}</h5>
                                                        <p class="mb-1 text-secondary">Requested by: ${request.name}</p>
                                                </div>
                                                <div class="btn-group" role="group">
                                <!-- Info button to trigger a modal -->
                                <button type="button"
                                        class="btn btn-dark btn-small"
                                        data-bs-toggle="modal"
                    data-bs-target="#infoModal"
                    title="View Comments"
                    onclick="showRequestDetails('${request.id}')">
                <span class="icon-info2"></span>
            </button>
            <!-- Accept button -->
            <button type="button"
                    class="btn btn-success btn-small"                                     title="Accept request"
                    onclick="handleRequest('${request.id}', 'accepted')">
                <span class="icon-check"></span>
            </button>
            <!-- Reject button -->
            <button type="button"
                    class="btn btn-danger btn-small"
                    title="Reject request"
                    onclick="handleRequest('${request.id}', 'rejected')">
                <span class="icon-close"></span>
            </button>
            <!-- Email button -->
            <a href="mailto:${request.email}"
               class="btn btn-dark btn-small"
               title="Email Requestor">
                <span class="icon-envelope"></span>
            </a>
        </div>
    `;

    requestsContainer.appendChild(requestItem);
});
})
.catch(error => {
console.error('Error fetching requests:', error);
});
    }

// Function to show request details in the modal
function showRequestDetails(requestId) {
    // Fetch request details and update modal content
    // Example: fetch(`/api/requests/${requestId}`).then(...);
    console.log('Show details for request ID:', requestId);
}

// Function to handle accept/reject actions
function handleRequest(requestId, action) {
    fetch(`/api/requests/${requestId}`, {
        method: 'PATCH', // Or 'POST', depending on your API design
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ status: action })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Request updated:', data);
        fetchRequests(); // Refresh the list
    })
    .catch(error => {
        console.error('Error updating request:', error);
    });
}

// Initial fetch on page load
document.addEventListener('DOMContentLoaded', fetchRequests);
</script>
