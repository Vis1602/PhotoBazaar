<?php
// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Initialize response array
$response = [];

if (isset($data['accountHolder'], $data['accountNumber'], $data['bankName'], $data['ifscCode'])) {
    // Perform validation (you can add additional checks here if needed)
    $accountHolder = $data['accountHolder'];
    $accountNumber = $data['accountNumber'];
    $bankName = $data['bankName'];
    $ifscCode = $data['ifscCode'];

    // You can add your database insert logic here

    // Prepare success response
    $response['status'] = 'success';
    $response['message'] = 'Bank details submitted successfully.';
} else {
    // Prepare error response
    $response['status'] = 'error';
    $response['message'] = 'Please fill out all fields.';
}

// Set header to return JSON
header('Content-Type: application/json');
echo json_encode($response);
