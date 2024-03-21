// Function to update the clock
function updateClock() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var timeString = formatTime(hours) + ":" + formatTime(minutes) + ":" + formatTime(seconds);
    document.getElementById("clock").innerHTML = timeString;
}

// Function to format time values
function formatTime(time) {
    return (time < 10 ? "0" : "") + time;
}

// Update the clock every second
setInterval(updateClock, 1000);

// Initial call to update the clock
updateClock();