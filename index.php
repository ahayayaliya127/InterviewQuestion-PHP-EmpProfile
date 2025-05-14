<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Add Employee</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-light">
    <div class="container py-5">
      <h2 class="mb-4">Add New Employee</h2>
      <div id="status-alert" class="alert alert-success d-none" role="alert">
        Employee data saved successfully!
      </div>
      <form method="POST" action="api/save_employee.php">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Employee Name</label>
            <input type="text" name="name" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-select" required>
              <option value="">Select</option>
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Marital Status</label>
            <select name="marital_status" class="form-select" required>
              <option value="">Select</option>
              <option>Single</option>
              <option>Married</option>
              <option>Divorced</option>
              <option>Widowed</option>
              <option>Others</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Phone No.</label>
            <input type="tel" name="phone" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Nationality</label>
            <input
              type="text"
              name="nationality"
              class="form-control"
              required
            />
          </div>
          <div class="col-md-6">
            <label class="form-label">Hire Date</label>
            <input type="date" name="hire_date" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Department</label>
            <input
              type="text"
              name="department"
              class="form-control"
              required
            />
          </div>
        </div>
        <div class="mt-4 text-end">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>

      <div class="col-12">
        <a href="view.php" class="btn btn-primary mt-3">View Employees</a>
      </div>
    </div>

    <script>
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.get("status") === "success") {
        document.getElementById("status-alert").classList.remove("d-none");
      }
    </script>
  </body>
</html>
