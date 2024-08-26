function deleteMessage(messageId) {
  if (confirm("Are you sure you want to delete this message?")) {
    // Replace with your server-side code to delete the message
    // For example, you could use AJAX to send a DELETE request to your server
    fetch(`/delete-message/${messageId}`, {
      method: 'DELETE'
    })
    .then(response => {
      if (response.ok) {
        // Message deleted successfully, remove the message from the DOM
        const messageElement = document.getElementById(`message-${messageId}`);
        messageElement.remove();
      } else {
        // Error deleting message, handle the error appropriately
        console.error('Error deleting message:', response.statusText);
      }
    })
    .catch(error => {
      // Error making the request, handle the error appropriately
      console.error('Error making request:', error);
    });
  }
}