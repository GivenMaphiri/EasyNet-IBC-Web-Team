const messageList = document.getElementById('messages');

// Simulate fetching messages from a server (replace with your actual data fetching logic)
const messages = [
  { sender: 'John Doe', senderEmail: 'john.doe@example.com', content: 'This is a message from John Doe. I have a question about my recent order #12345.' },
  { sender: 'Jane Smith', senderEmail: 'jane.smith@example.com', content: 'This is a message from Jane Smith. I would like to request a return for product XYZ (SKU: ABC123) because it arrived damaged.' },
  { sender: 'David Lee', senderEmail: 'david.lee@example.com', content: 'Hi, I placed an order yesterday but haven\'t received a confirmation email yet. Can you please check on it? Order number: #54321' },
  { sender: 'Sarah Jones', senderEmail: 'sarah.jones@example.com', content: 'I\'m interested in learning more about your product XYZ. Can you provide any additional information on its features and specifications?' },
  { sender: 'Michael Brown', senderEmail: 'michael.brown@example.com', content: 'I just subscribed to your newsletter and received a discount code. How do I use it during checkout?' },
];

// Function to display a single message
function displayMessage(message) {
  const messageElement = document.createElement('div');
  messageElement.classList.add('message');

  const senderElement = document.createElement('span');
  senderElement.classList.add('message-sender');
  senderElement.textContent = 'Name: ' + message.sender;

  const emailElement = document.createElement('p');
  emailElement.classList.add('message-email');
  emailElement.textContent = `Email: ${message.senderEmail}`;

  const contentElement = document.createElement('p');
  contentElement.classList.add('message-content');
  contentElement.textContent = 'Message:    ' + message.content;

  const actionsElement = document.createElement('div');
  actionsElement.classList.add('message-actions');

  const deleteButton = document.createElement('button');
  deleteButton.classList.add('delete-message');
  deleteButton.textContent = 'Delete';

  // Add event listener for delete button (replace with actual delete functionality)
  deleteButton.addEventListener('click', () => {
    // Simulate message deletion
    messageList.removeChild(messageElement);
    alert('Message deleted (simulated)');
  });

  actionsElement.appendChild(deleteButton);

  messageElement.appendChild(senderElement);
  messageElement.appendChild(emailElement);
  messageElement.appendChild(contentElement);
  messageElement.appendChild(actionsElement);

  messageList.appendChild(messageElement);
}

// Display all messages
messages.forEach(displayMessage);
