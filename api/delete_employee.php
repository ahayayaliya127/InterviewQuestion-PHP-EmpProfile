<?php
$dataFile = '../data/employees.json';

if (!isset($_GET['id'])) {
    die("Error: No ID provided");
}

$id = (int) $_GET['id'];

$employees = [];

if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $employees = json_decode($json, true);
}

$found = false;

foreach ($employees as $index => $emp) {
    if ((int)$emp['id'] === $id) {
        $found = true;
        array_splice($employees, $index, 1);
        break;
    }
}

if (!$found) {
    die("Error: Employee not found");
}

file_put_contents($dataFile, json_encode($employees, JSON_PRETTY_PRINT));

header("Location: ../view.php?status=deleted");
exit;
