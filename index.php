<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hope</title>
    <link rel="stylesheet" href="style.css">
</head>

<h1><img src="logo.png" alt="HOPE" class="custom-image"></h1>

<body>
    <form action="insert.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="facility">Facility:</label>
        <select id="facility" name="facility" required>
            <option value="" disabled selected>Select Facility</option>
            <option value="0">Swimming Pool</option>
            <option value="1">Football Field</option>
            <option value="2">Tennis Court</option>
            <option value="3">Volleyball Court</option>
        </select>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" onchange="validateDate()" required>

        <label for="timeStart">Start Time:</label>
        <input type="time" id="timeStart" name="timeStart" onchange="validateTime()" required>

        <label for="timeEnd">End Time:</label>
        <input type="time" id="timeEnd" name="timeEnd" onchange="validateTime()" required>

        <button type="submit">SUBMIT BOOKING</button>
    </form>

    <?php
    session_start();
    if (isset($_SESSION['success']) && $_SESSION['success']) {
        $bookingData = $_SESSION['bookingData'];
        echo "<div class='success-message'>";
        echo "<h2>Booking Successful!</h2>";
        echo "<p><strong>Name:</strong> " . htmlspecialchars($bookingData['name']) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($bookingData['email']) . "</p>";
        echo "<p><strong>Phone:</strong> ". htmlspecialchars($bookingData['phone']) . "</p>";
        echo "<p><strong>Facility:</strong> " . htmlspecialchars($bookingData['facility']) . "</p>";
        echo "<p><strong>Date:</strong> " . htmlspecialchars($bookingData['date']) . "</p>";
        echo "<p><strong>Start Time:</strong> " . htmlspecialchars($bookingData['timeStart']) . "</p>";
        echo "<p><strong>End Time:</strong> " . htmlspecialchars($bookingData['timeEnd']) . "</p>";
        echo "<p><strong>Hourly Rate:</strong> RM" . htmlspecialchars($bookingData['hourly_rate']) . "</p>";
        echo "<p><strong>Total Hours:</strong> " . htmlspecialchars($bookingData['total_hour']) . "</p>";
        echo "<p><strong>Total Fee:</strong> RM" . htmlspecialchars($bookingData['total_fee']) . "</p>";
        echo "</div>";
        // Clear the session data
        session_unset();
        session_destroy();
    }
    ?>

    <script src="index.js"></script>
</body>
</html>