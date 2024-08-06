const tooltipTriggerList = document.querySelectorAll('[data-bs-tooltip="tooltip"]')


// Function to fetch requests from the API
function fetchRejectedRequests() {
    fetch('/api/requests/rejected')
            .then(response => response.json())
            .then(data => {
                const requestsContainer = document.getElementById('acceptedRequestsContainer');
                requestsContainer.innerHTML = ''; 

                data.data.forEach(request => {
                    // Create request item
                    const requestItem = document.createElement('div');
                    requestItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                    requestItem.id = `request-${request.id}`;
                    requestItem.innerHTML =
                        `
                        <div>
                            <h5 class="mb-1 text-dark">${request.song}</h5>
                            <p class="mb-1 text-secondary">Requested by: ${request.name}</p>
                        </div>
                        <div class="btn-group" role="group">
                            <!-- Vote button -->
                            <button type="button" 
                                    class="btn btn-danger btn-small" 
                                    onclick="voteRequest('${request.id}')">
                                <span class="icon-heart"></span> <span class="badge text-bg-secondary">4</span>
                            </button>
                            <!-- Play button -->
                            <button type="button" 
                                    class="btn btn-success btn-small" 
                                    title="Play song" 
                                    onclick="playRequest('${request.id}')">
                                <span class="icon-play"></span>
                            </button>
                            <!-- Delete button -->
                            <button type="button"
                                    class="btn btn-danger btn-small"
                                    title="Delete request"
                                    onclick="handleRequest('${request.id}', 'delete')">
                                <span class="icon-bin"></span>
                            </button>
                        </div>
                    `;

                    requestsContainer.appendChild(requestItem);
                });
            })
            .catch(error => {
                console.error('Error fetching requests:', error);
            });
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
            // Perform any additional actions on success, e.g., update UI
            fetchRejectedRequests();
        } else {
            console.error('Failed to delete requests:', data.message);
            // Handle the error accordingly
        }
    })
    .catch(error => {
        console.error('Error deleting requests:', error);
    });
}


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
                    requestItem.id = `request-${request.id}`; // Fixed  ID formatting
                    requestItem.innerHTML =
                            `
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
                                        onclick="showRequestDetails('${request.comment}')">
                                <span class="icon-info2"></span>
                                </button>  
            
                            <!-- Accept button -->
                        <button type="button"
                                class="btn btn-success btn-small"
                                title="Accept request"
                                onclick="handleRequest('${request.id}', 'approve')">
                                <span class="icon-check"></span>
                        </button>
            
                        <!-- Reject button -->
                        <button type="button"
                                class="btn btn-danger btn-small"
                                title="Reject request"
                                onclick="handleRequest('${request.id}', 'reject')">
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
                    fetchRejectedRequests();
                });
            })
            .catch(error => {
                console.error('Error fetching requests:', error);
            });
}

// Function to show request details in the modal
function showRequestDetails(comment) {
    const commentElement = document.getElementById('comment');
    commentElement.innerHTML = comment;
}

// Function to handle accept/reject/delete actions
function handleRequest(requestId, action) {
    let method, url;

    if (action === 'approve') {
        method = 'PATCH';
        url = `/api/requests/approve/${requestId}`;
        // Remove the request from the DOM when accepted
        removeRequestFromDOM(requestId);
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
                if (action !== 'approve') {
                    fetchRequests(); // Refresh the list if not approved
                }
            })
            .catch(error => {
                console.error('Error updating request:', error);
            });
}

// Function to remove a request from the DOM
function removeRequestFromDOM(requestId) {
    const requestElement = document.getElementById(`request-${requestId}`);
    if (requestElement) {
        requestElement.remove();
    }
}

// Initial fetch on page load
document.addEventListener('DOMContentLoaded', fetchRequests);
document.addEventListener('DOMContentLoaded', fetchRejectedRequests);