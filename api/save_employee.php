<?php
$dataFile = '../data/employees.json';
if (!file_exists('../data')) {
    mkdir('../data', 0777, true);
}

$fields = ['name', 'gender', 'marital_status', 'phone', 'email', 'address', 'dob', 'nationality', 'hire_date', 'department'];
$employee = [];

foreach ($fields as $field) {
    if (empty($_POST[$field])) {
        die("Error: Missing field - $field");
    }
    $employee[$field] = htmlspecialchars(trim($_POST[$field]));
}

if (!filter_var($employee['email'], FILTER_VALIDATE_EMAIL)) {
    header("Location: ../index.html?status=invalid_email");
    exit;
}

if (!preg_match('/^\+?[0-9]{7,15}$/', $employee['phone'])) {
    header("Location: ../index.html?status=invalid_phone");
    exit;
}

$employee['created_at'] = date('Y-m-d H:i:s');
$employee['id'] = time();

$allEmployees = [];

if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $allEmployees = json_decode($json, true) ?? [];
}

$allEmployees[] = $employee;

file_put_contents($dataFile, json_encode($allEmployees, JSON_PRETTY_PRINT));

header("Location: ../index.php?status=success");
exit;
?>
