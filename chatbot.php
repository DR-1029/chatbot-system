<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chatbot</title>
    <style>
        #chatbox { width: 400px; height: 300px; border: 1px solid #ccc; padding: 10px; overflow-y: scroll; }
        #userInput { width: 300px; }
    </style>
</head>
<body>
<h2>Ticket Booking Chatbot</h2>
<div id="chatbox"></div><br>
<input type="text" id="userInput" placeholder="Ask something..." />
<button onclick="sendMessage()">Send</button>
<br><br>
<a href="logout.php">Logout</a>

<script>
    function sendMessage() {
        var userText = document.getElementById('userInput').value;
        var chatbox = document.getElementById('chatbox');
        chatbox.innerHTML += "<div>User: " + userText + "</div>";

        // Simple bot logic
        let botReply = "Sorry, I can't understand.";
        if (userText.toLowerCase().includes("book")) {
            botReply = "What destination would you like to book?";
        }
        chatbox.innerHTML += "<div>Bot: " + botReply + "</div>";
        document.getElementById('userInput').value = "";
        chatbox.scrollTop = chatbox.scrollHeight;
    }
</script>
</body>
</html>