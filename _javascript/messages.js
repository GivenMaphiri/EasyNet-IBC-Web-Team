// Handle form submission and send message to the server
document.getElementById('contactForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const message = document.getElementById('message').value;

  fetch('_php/save_message.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({ name, email, message })
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          alert('Message sent successfully');
      } else {
          alert('Failed to send message');
      }
  })
  .catch(error => console.error('Error:', error));
});

// Fetch and display messages on the admin side
document.addEventListener('DOMContentLoaded', function() {
fetch('_php/get_messages.php')
.then(response => response.json())
.then(data => {
    data.messages.forEach(displayMessage);
})
.catch(error => console.error('Error fetching messages:', error));
});

function displayMessage(message) {
const messageList = document.getElementById('messages');

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
contentElement.textContent = 'Message: ' + message.content;

const actionsElement = document.createElement('div');
actionsElement.classList.add('message-actions');

const deleteButton = document.createElement('button');
deleteButton.classList.add('delete-message');
deleteButton.textContent = 'Delete';

deleteButton.addEventListener('click', () => {
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


