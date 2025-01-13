<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $facilityIndex = $_POST['facility'];
    $date = $_POST['date'];
    $timeStart = $_POST['timeStart'];
    $timeEnd = $_POST['timeEnd'];

    // Facilities array
    $facilities = ["Swimming Pool", "Football Field", "Tennis Court", "Volleyball Court"];
    $hourlyRate = [8, 200, 16, 32];
    $facility = $facilities[$facilityIndex];

    // Calculate total hours and fee
    $start = strtotime($timeStart);
    $end = strtotime($timeEnd);
    $totalHours = round(($end - $start) / 3600, 2);
    $totalFee = round($totalHours * $hourlyRate[$facilityIndex], 2);

    $sql = "INSERT INTO facility (email, name, phone, facility, date, time_start, time_end, hourly_rate, total_hour, total_fee)
            VALUES ('$email', '$name', '$phone', '$facility', '$date', '$timeStart', '$timeEnd', '$hourlyRate[$facilityIndex]', '$totalHours', '$totalFee')";

    if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION['success'] = true;
        $_SESSION['bookingData'] = [
            'email' => $email,
            'name' => $name,
            'phone'=> $phone,
            'facility' => $facility,
            'date' => $date,
            'timeStart' => $timeStart,
            'timeEnd' => $timeEnd,
            'hourly_rate'=> $hourlyRate[$facilityIndex],
            'total_hour' => $totalHours,
            'total_fee' => $totalFee
        ];
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>