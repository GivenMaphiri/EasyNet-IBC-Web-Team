<?php
session_start(); // Start the session
include "DBConn.php"; // Include your database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages</title>
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />
  <link rel="stylesheet" href="_styles/admin_style.css" />
</head>

<body>

  <div class="sidebar">
    <div class="sidebar-brand">
      <div class="brand-flex">
        <div class="checkout_heading">
          <h1 id="Logo_name1">Easy</h1>
          <h1 id="Logo_name2">Net</h1>
        </div>
        <!-- <div class="brand-icons">
              <span class="las la-bell"></span>
              <span class="las la-user-circle"></span>
            </div>
        -->
      </div>
    </div>

    <div class="sidebar-main">
      <div class="sidebar-user">
        <div class="menu-head">
          <span>Admin</span>
        </div>
        <span>admin@gmail.com</span>
      </div>
    </div>

    <div class="sidebar-menu">
      <div class="menu-head">
        <span>Dashboard</span>
      </div>
      <ul>
        <li>
          <a href="admin.php">
            <span class="las la-chart-bar"></span>
            Analytics
          </a>
        </li>
        <li>
          <a href="orders.php">
            <span class="las la-shopping-cart"></span>
            Order
          </a>
        </li>
      </ul>

      <div class="menu-head">
        <span>Application</span>
      </div>
      <ul>
        <li>
          <a href="ecommerce.php">
            <span class="las la-store-alt"></span>
            Ecommerce
          </a>
        </li>
        <li>
          <a href="messages.php">
            <span class="las la-envelope"></span>
            Messages
          </a>
        </li>
        <li>
          <a href="#">
            <span class="las la-check-circle"></span>
            Tasks
          </a>
        </li>
        <li>
          <a href="index.php">
            <span class="las la-sign-out-alt"></span>
            Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
  </div>

  <div class="main-content">
    <div class="main-messages">
      <h1>Messages</h1>
      <div id="messages">
        <!-- Messages will be dynamically inserted here -->
      </div>
    </div>
  </div>

  <script>
    // JavaScript to fetch and display messages
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
  </script>

</body>
</html>