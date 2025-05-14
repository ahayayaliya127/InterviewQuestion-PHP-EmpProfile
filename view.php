<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Employee List</h2>
        <div id="status-alert" class="alert alert-success d-none" role="alert">
            Employee deleted successfully!
        </div>

        <?php
        $dataFile = 'data/employees.json';
        $employees = [];

        if (file_exists($dataFile)) {
            $json = file_get_contents($dataFile);
            $employees = json_decode($json, true);
        }
        ?>

        <?php if (isset($_GET['status']) && $_GET['status'] === 'deleted'): ?>
            <div class="alert alert-success" role="alert">
                Employee deleted successfully!
            </div>
        <?php endif; ?>

        <?php

        if (empty($employees)) {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='table-dark'>
                    <tr>
                        <th class='text-center'>#</th>
                        <th class='text-center'>Employee ID</th>
                        <th class='text-center'>Name</th>
                        <th class='text-center'>Gender</th>
                        <th class='text-center'>Marital Status</th>
                        <th class='text-center'>Phone</th>
                        <th class='text-center'>Email</th>
                        <th class='text-center'>Address</th>
                        <th class='text-center'>Date of Birth</th>
                        <th class='text-center'>Nationality</th>
                        <th class='text-center'>Hire Date</th>
                        <th class='text-center'>Department</th>
                        <th class='text-center'>Created At</th>
                        <th class='text-center'>Edit</th>
                        <th class='text-center'>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan='14' class='text-center'>No employees found.</td>
                    </tr>
                </tbody>
                </table>";
            echo "</div>";
        } else {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='table-dark'>
                    <tr>
                        <th class='text-center'>#</th>
                        <th class='text-center'>Employee ID</th>
                        <th class='text-center'>Name</th>
                        <th class='text-center'>Gender</th>
                        <th class='text-center'>Marital Status</th>
                        <th class='text-center'>Phone</th>
                        <th class='text-center'>Email</th>
                        <th class='text-center'>Address</th>
                        <th class='text-center'>Date of Birth</th>
                        <th class='text-center'>Nationality</th>
                        <th class='text-center'>Hire Date</th>
                        <th class='text-center'>Department</th>
                        <th class='text-center'>Created At</th>
                        <th class='text-center'>Edit</th>
                        <th class='text-center'>Delete</th>
                    </tr>
                </thead>
                <tbody>";

            foreach ($employees as $index => $emp) {
                echo "<tr>
                        <td>" . ($index + 1) . "</td>
                        <td class='text-center'>{$emp['id']}</td>
                        <td>{$emp['name']}</td>
                        <td>{$emp['gender']}</td>
                        <td>{$emp['marital_status']}</td>
                        <td class='text-center'>{$emp['phone']}</td>
                        <td>{$emp['email']}</td>
                        <td>{$emp['address']}</td>
                        <td class='text-center'>{$emp['dob']}</td>
                        <td>{$emp['nationality']}</td>
                        <td class='text-center'>{$emp['hire_date']}</td>
                        <td>{$emp['department']}</td>
                        <td class='text-center'>{$emp['created_at']}</td>
                        <td class='text-center'>
                            <button 
                                class='btn btn-sm btn-primary edit-btn' 
                                data-bs-toggle='modal' 
                                data-bs-target='#editModal'
                                data-id='{$emp['id']}'
                                data-name='" . htmlspecialchars($emp['name'], ENT_QUOTES) . "'
                                data-gender='{$emp['gender']}'
                                data-marital='{$emp['marital_status']}'
                                data-phone='{$emp['phone']}'
                                data-email='{$emp['email']}'
                                data-address='" . htmlspecialchars($emp['address'], ENT_QUOTES) . "'
                                data-dob='{$emp['dob']}'
                                data-nationality='{$emp['nationality']}'
                                data-hire='{$emp['hire_date']}'
                                data-department='{$emp['department']}'
                            >
                                Edit
                            </button>
                        </td>
                        <td class='text-center'>
                            <a href='api/delete_employee.php?id={$emp['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                    </tr>";
            }

            echo "</tbody></table></div>";
        }
        ?>

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="api/edit_employee.php">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <input type="hidden" name="id" id="edit-id">
                
                <div class="row g-3">
                <div class="col-md-6">
                    <label for="edit-name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="edit-name" required>
                </div>

                <div class="col-md-6">
                    <label for="edit-gender" class="form-label">Gender</label>
                    <select class="form-control" name="gender" id="edit-gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="edit-marital" class="form-label">Marital Status</label>
                    <select class="form-control" name="marital" id="edit-marital" required>
                        <option value="">Select</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="edit-phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" id="edit-phone" required>
                </div>
                <div class="col-md-6">
                    <label for="edit-email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="edit-email" required>
                </div>
                <div class="col-md-6">
                    <label for="edit-address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="edit-address" required>
                </div>
                <div class="col-md-6">
                    <label for="edit-dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" name="dob" id="edit-dob" required>
                </div>
                <div class="col-md-6">
                    <label for="edit-nationality" class="form-label">Nationality</label>
                    <input type="text" class="form-control" name="nationality" id="edit-nationality" required>
                </div>
                <div class="col-md-6">
                    <label for="edit-hire" class="form-label">Date of Hire</label>
                    <input type="date" class="form-control" name="hire" id="edit-hire" required>
                </div>
                <div class="col-md-6">
                    <label for="edit-department" class="form-label">Department</label>
                    <input type="text" class="form-control" name="department" id="edit-department" required>
                </div>
                </div>

                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
            </form>
        </div>
        </div>

        <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('edit-id').value = button.getAttribute('data-id');
                document.getElementById('edit-name').value = button.getAttribute('data-name');
                document.getElementById('edit-gender').value = button.getAttribute('data-gender');
                document.getElementById('edit-marital').value = button.getAttribute('data-marital');
                document.getElementById('edit-phone').value = button.getAttribute('data-phone');
                document.getElementById('edit-email').value = button.getAttribute('data-email');
                document.getElementById('edit-address').value = button.getAttribute('data-address');
                document.getElementById('edit-dob').value = button.getAttribute('data-dob');
                document.getElementById('edit-nationality').value = button.getAttribute('data-nationality');
                document.getElementById('edit-hire').value = button.getAttribute('data-hire');
                document.getElementById('edit-department').value = button.getAttribute('data-department');
            });
        });
        </script>

        <br><br>
        <a href="index.php" class="btn btn-primary mt-3">← Back to Form</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
