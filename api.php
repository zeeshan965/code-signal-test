<?php

//http://localhost/site1/api.php

header("Content-Type:application/json");

$conn = new mysqli("localhost", "root", "warfare2", "code_signal");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$headers = apache_request_headers();

$first_name = isset($headers['residentFirstName']) ? $headers['residentFirstName'] : "";
$last_name = isset($headers['residentLastName']) ? $headers['residentLastName'] : "";

$query = "SELECT residentFirstName, residentLastName, room FROM residents WHERE residentFirstName = '{$first_name}' 
                                                                  AND residentLastName = '{$last_name}' ";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    echo $row['room'];
    $response = [
        "residentFirstName" => $row['residentFirstName'],
        "residentLastName" => $row['residentLastName']
    ];
    echo json_encode($response);
} else {
    echo "No rooms.";
}
