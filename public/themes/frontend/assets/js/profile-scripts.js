// Initialize tooltips
const tooltipTriggerList = document.querySelectorAll('[data-bs-tooltip="tooltip"]');

// Function to fetch requests from the API by status
function fetchRequestsByStatus(status, containerId) {
    console.log(`Fetching requests with status: ${status}`);
    fetch(`/api/requests/${status}`)
        .then(response => response.json())
        .then(data => {
            const requestsContainer = document.getElementById(containerId);
            requestsContainer.innerHTML = ''; // Clear previous content

            data.data.forEach(request => {
                // Create request item
                const requestItem = document.createElement('div');
                requestItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                requestItem.id = `request-${request.id}`;
                requestItem.innerHTML = `
                    <div>
                        <h5 class="mb-1 text-dark">${request.song}</h5>
                        <p class="mb-1 text-secondary">Requested by: ${request.name}</p>
                    </div>
                    <div class="btn-group" role="group">
                        <!-- Vote button -->
                        <button type="button" class="btn btn-danger btn-small" onclick="voteRequest('${request.id}')">
                            <span class="icon-heart"></span> <span class="badge text-bg-secondary">${request.votes}</span>
                        </button>
                        <!-- Play button -->
                        <button type="button" class="btn btn-success btn-small" title="Play song" onclick="playRequest('${request.id}')">
                            <span class="icon-play"></span>
                        </button>
                        <!-- Approve button for all requests -->
                        <button type="button" class="btn btn-primary btn-small" title="Approve request" onclick="handleRequest('${request.id}', 'approve')">
                            <span class="icon-check"></span>
                        </button>
                        ${status !== 'rejected' ? `
                        <!-- Reject button for all requests -->
                        <button type="button" class="btn btn-warning btn-small" title="Reject request" onclick="handleRequest('${request.id}', 'reject')">
                            <span class="icon-remove"></span>
                        </button>
                        ` : ''}
                        <!-- Delete button for all requests -->
                        <button type="button" class="btn btn-danger btn-small" title="Delete request" onclick="handleRequest('${request.id}', 'delete')">
                            <span class="icon-bin"></span>
                        </button>
                    </div>
                `;

                requestsContainer.appendChild(requestItem);
            });
        })
        .catch(error => {
            console.error(`Error fetching ${status} requests:`, error);
        });
}

// Fetch all requests
function fetchAllRequests() {
    fetchRequestsByStatus('accepted', 'acceptedRequestsContainer');
    fetchRequestsByStatus('rejected', 'rejectedRequestsContainer');
    fetchRequestsByStatus('pending', 'requestsContainer');
}

// Function to prompt user for confirmation before deleting requests
function confirmDeleteRequests(userId) {
    // Show confirmation prompt
    const userConfirmed = confirm("Are you sure you want to delete all rejected requests?");
    
    // If user confirms, call the deleteRequestsByUserId function
    if (userConfirmed) {
        deleteRequestsByUserId(userId);
    }
}

// Function to delete requests by user ID
function deleteRequestsByUserId(userId) {
    console.log(`Deleting requests by user ID: ${userId}`);
    fetch(`/api/requests/delete/user/${userId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            console.log('Requests deleted successfully');
            fetchRequestsByStatus('rejected', 'rejectedRequestsContainer');
        } else {
            console.error('Failed to delete requests:', data.message);
        }
    })
    .catch(error => {
        console.error('Error deleting requests:', error);
    });
}

// Function to show request details in the modal
function showRequestDetails(comment) {
    console.log('Showing request details...');
    const commentElement = document.getElementById('comment');
    commentElement.innerHTML = comment;
}

// Function to handle approve/reject/delete actions
function handleRequest(requestId, action) {
    console.log(`Handling request ${requestId} with action ${action}`);
    let method, url;

    if (action === 'approve') {
        method = 'PATCH';
        url = `/api/requests/approve/${requestId}`;
    } else if (action === 'reject') {
        method = 'PATCH';
        url = `/api/requests/reject/${requestId}`;
    } else if (action === 'delete') {
        method = 'DELETE';
        url = `/api/requests/delete/${requestId}`;
    } else {
        console.error('Unknown action:', action);
        return;
    }

    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json'
        },
        body: method === 'PATCH' ? JSON.stringify({status: action === 'approve' ? 'accepted' : 'rejected'}) : null
    })
    .then(response => response.json())
    .then(data => {
        console.log('Request updated:', data);
        if (action === 'approve') {
            // Remove the request from the pending list and refresh the pending list
            removeRequestFromDOM(requestId, 'requestsContainer');
            fetchRequestsByStatus('pending', 'requestsContainer'); // Refresh pending list
            fetchRequestsByStatus('accepted', 'acceptedRequestsContainer'); // Refresh accepted list
        } else {
            fetchAllRequests(); // Refresh all lists if not approved
        }
    })
    .catch(error => {
        console.error('Error updating request:', error);
    });
}

// Function to remove a request from the DOM
function removeRequestFromDOM(requestId, containerId) {
    const requestElement = document.getElementById(`request-${requestId}`);
    if (requestElement && requestElement.closest(`#${containerId}`)) {
        requestElement.remove();
    }
}

// Initial fetch on page load
document.addEventListener('DOMContentLoaded', fetchAllRequests);
