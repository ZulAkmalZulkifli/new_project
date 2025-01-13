// Function to validate the selected date
function validateDate() {
    const dateInput = document.getElementById("date");
    const selectedDate = new Date(dateInput.value);
    const currentDate = new Date();
    const dayOfWeek = selectedDate.getDay();

    // Check if the selected date is in the past
    if (selectedDate < currentDate.setHours(0, 0, 0, 0)) {
        alert("You cannot select a date in the past. Please choose a valid date.");
        dateInput.value = ""; // Clear the invalid date
        return;
    }

    // Check if the selected day is a weekend (Saturday or Sunday)
    if (dayOfWeek !== 6 && dayOfWeek !== 0) {
        alert("Bookings are only accepted for weekends (Saturday and Sunday). Please select a valid date.");
        dateInput.value = ""; // Clear the invalid date
    }
}

// Function to validate the selected time range
function validateTime() {
    const dateInput = document.getElementById("date");
    const timeStartInput = document.getElementById("timeStart");
    const timeEndInput = document.getElementById("timeEnd");

    const selectedDate = new Date(dateInput.value);
    const currentDate = new Date();
    const timeStart = timeStartInput.value ? parseTime(timeStartInput.value) : null;
    const timeEnd = timeEndInput.value ? parseTime(timeEndInput.value) : null;

    const minStartTime = 8 * 60; // 8:00 AM in minutes
    const maxEndTime = 24 * 60; // 12:00 AM midnight in minutes

    // Check if the selected date is today
    const isToday =
        selectedDate.getFullYear() === currentDate.getFullYear() &&
        selectedDate.getMonth() === currentDate.getMonth() &&
        selectedDate.getDate() === currentDate.getDate();

    // If the selected date is today, compare with the current time
    if (isToday) {
        const currentMinutes = currentDate.getHours() * 60 + currentDate.getMinutes();

        if (timeStart && timeStart < currentMinutes) {
            alert("The start time must not be in the past. Please select a valid time.");
            timeStartInput.value = ""; // Clear the invalid start time
            return;
        }

        if (timeEnd && timeEnd < currentMinutes) {
            alert("The end time must not be in the past. Please select a valid time.");
            timeEndInput.value = ""; // Clear the invalid end time
            return;
        }
    }

    // Check if the start time is earlier than the minimum allowed start time
    if (timeStart && timeStart < minStartTime) {
        alert("The start time must be at least 8:00 AM. Please select a valid time.");
        timeStartInput.value = ""; // Clear the invalid start time
    }

    // Check if the end time exceeds the maximum allowed time
    if (timeEnd && timeEnd > maxEndTime) {
        alert("The end time must not exceed 12:00 AM midnight. Please select a valid time.");
        timeEndInput.value = ""; // Clear the invalid end time
    }

    // Ensure the start time is earlier than the end time
    if (timeStart && timeEnd && timeStart >= timeEnd) {
        alert("The start time must be earlier than the end time. Please adjust your time selection.");
        timeStartInput.value = ""; // Clear both fields if the range is invalid
        timeEndInput.value = "";
    }
}

// Helper function to convert time in "HH:MM" format to minutes
function parseTime(time) {
    const [hours, minutes] = time.split(":").map(Number);
    return hours * 60 + minutes;
}