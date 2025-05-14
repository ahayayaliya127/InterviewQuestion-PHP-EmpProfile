<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataFile = '../data/employees.json';

    $employees = json_decode(file_get_contents($dataFile), true);

    $id = $_POST['id'];
    $index = array_search($id, array_column($employees, 'id'));

    if ($index === false) {
        die("Employee not found.");
    }

    $employees[$index] = [
        'id' => $id,
        'name' => $_POST['name'],
        'gender' => $_POST['gender'],
        'marital_status' => $_POST['marital'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'address' => $_POST['address'],
        'dob' => $_POST['dob'],
        'nationality' => $_POST['nationality'],
        'hire_date' => $_POST['hire'],
        'department' => $_POST['department'],
        'created_at' => $employees[$index]['created_at']
    ];

    file_put_contents($dataFile, json_encode($employees, JSON_PRETTY_PRINT));

    header("Location: ../view.php?status=updated");
    exit();
}
?>
