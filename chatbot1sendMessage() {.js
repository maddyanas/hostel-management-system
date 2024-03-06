function sendMessage() {
    var userInput = document.getElementById('user-input');
    var chatBox = document.getElementById('chat-box');

    // Get user input
    var userMessage = userInput.value;

    // Append user message to the chat box
    chatBox.innerHTML += '<div class="user-message">' + userMessage + '</div>';

    // Clear the input field
    userInput.value = '';

    // Simulate bot response based on user input (replace with your own logic)
    var botMessage;

    if (userMessage.toLowerCase().includes('hello')) {
        botMessage = 'Hello there! How can I help you?';
    } else if (userMessage.toLowerCase().includes('how are you')) {
        botMessage = 'I am just a computer program, but thank you for asking!';
    } 
    else if (userMessage.toLowerCase().includes('fees')) {
        botMessage = 'The fees structure differs,it depends on the hostel you choose,thank you for asking!';
    }
    else if (userMessage.toLowerCase().includes('rooms')) {
        botMessage = 'There are several kinds of rooms available like AC,Non-AC,Single room,Two sharing,Four sharing and the price differs based on the room you choose,thank you for asking!';
    }
    else if (userMessage.toLowerCase().includes('department')) {
        botMessage = 'The rooms are allocated within your department students,thank you for asking!';
    }

    else if (userMessage.toLowerCase().includes('food')) {
        botMessage = 'Monday: morning-bread toast,bread omlette,jam..\nLunch:Veg biriyani,Raita,Curd..\nEve:Groundnuts\nNight:Dosai,tomato gravy\nTuesday: Morning:Idli,sambar,chutney\nLunch:White rice,Sambar,Curd\nEve:Pori\nNight:Chappathi,Veg-gravy\n\nWednesday:Morning:Pongal,Sambar\nLunch:White rice,Sambar,Curd\nEve:Pori\nNight:Chappathi,Veg-gravy\n\nThursday: morning-bread toast,bread omlette,jam..\nLunch:Veg biriyani,Raita,Curd..\nEve:Groundnuts\nNight:Dosaithank you for asking!';
    }
    else {
        botMessage = 'Thank you for your message: ' + userMessage;
    }

    // Append bot message to the chat box after a delay
    setTimeout(function() {
        chatBox.innerHTML += '<div class="bot-message">' + botMessage + '</div>';
        // Scroll to the bottom of the chat box to show the latest messages
        chatBox.scrollTop = chatBox.scrollHeight;
    }, 500);
}
