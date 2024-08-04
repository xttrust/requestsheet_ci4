const tooltipTriggerList = document.querySelectorAll('[data-bs-tooltip="tooltip"]')


//// Fetch all requests
//fetch('/api/requests')
//    .then(response => response.json())
//    .then(responseData => {
//        console.log('All Requests:', responseData.data);
//        // Handle the data
//    })
//    .catch(error => {
//        console.error('Error fetching requests:', error);
//    });
//
//// Fetch requests by status
//fetch('/api/requests/status/accepted')
//    .then(response => response.json())
//    .then(responseData => {
//        console.log('Accepted Requests:', responseData.data);
//        // Handle the data
//    })
//    .catch(error => {
//        console.error('Error fetching requests by status:', error);
//    });
//
//// Fetch requests sorted by created_at and votes
//fetch('/api/requests/sorted')
//    .then(response => response.json())
//    .then(responseData => {
//        console.log('Sorted Requests:', responseData.data);
//        // Handle the data
//    })
//    .catch(error => {
//        console.error('Error fetching sorted requests:', error);
//    });
