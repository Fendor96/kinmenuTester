document.addEventListener('DOMContentLoaded', async function() {
    // Get references to DOM elements
    const favorisElement = document.getElementById('favoris');
    const historiqueElement = document.getElementById('historique');
    const messageErrorDiv = document.getElementById('messageDiv');

    // Clear any previous error messages when the page loads
    messageErrorDiv.textContent = '';
    messageErrorDiv.style.display = 'none'; // Hide the error div initially

    try {
        // Fetch data from the API endpoint
        const response = await fetch('http://localhost/kinmenuTest/api/userHome.php');

        // Check if the HTTP response was successful (status code 200-299)
        if (!response.ok) {
            // If not successful, throw an error with the status
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        // Parse the JSON response body
        const data = await response.json();

        // Check the 'success' flag in the JSON data
        if (data.success) {
            // Log the data for debugging purposes (can be removed in production)
            console.log('API data:', data);

            // Update the text content of the respective elements
            // Use more descriptive variable names for clarity (e.g., favorisElement)
            favorisElement.textContent = data.favoris || 'N/A'; // Provide a fallback if data.favoris is null/undefined
            historiqueElement.textContent = data.users || 'N/A'; // Provide a fallback if data.users is null/undefined

        } else {
            // If data.success is false, display the message from the API or a generic one
            messageErrorDiv.textContent = data.message || "Failed to retrieve data.";
            messageErrorDiv.style.display = 'block'; // Show the error div
            console.error('API reported an error:', data.message);
        }

    } catch (err) {
        // Catch network errors, parsing errors, or errors thrown from !response.ok
        if (err.name !== 'AbortError') { // 'AbortError' is typically for cancelled fetches, good to ignore if not intentionally cancelling
            console.error("Fetch error:", err);
            messageErrorDiv.textContent = "Error connecting to the server. Please try again later.";
            messageErrorDiv.style.display = 'block'; // Show the error div
        }
    }
});