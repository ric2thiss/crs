<?php
function employee_update() {
    // Fetch employees (assuming this function is defined and works correctly)
    $employees = fetch_employees();

    // Check if 'id' is provided in the query string
    if (isset($_GET['id'])) {
        $EmployeeID = $_GET['id'];
        $employeeFound = false;

        // Find the employee with the matching ID
        foreach ($employees as $employee) {
            if ($employee["EmployeeID"] == $EmployeeID) {
                $employeeFound = true;
                break;
            }
        }

        if ($employeeFound) {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                // Update employee details
                $updatedEmployee = [
                    'EmployeeID' => $EmployeeID,
                    'FirstName' => $_POST['firstname'],
                    'LastName' => $_POST['lastname'],
                    'BirthDate' => $_POST['birthdate'],
                    'Notes' => $_POST['note']
                ];

                if (update_employee($updatedEmployee)) {  // Update the employee in the database
                    echo "
                    <script>
                    alert('Employee updated successfully');
                    window.location.href = 'employees_update.php?id=" . $_GET['id'] . "';
                    </script>";
                } else {
                    echo "<script>alert('Failed to update Employee');</script>";
                }
            }
            ?>
            <div class="container p-4">
                <h1 class="mt-4 mb-4">Update Employee - Record</h1>
                <hr>
                <a href="employees.php" class="text-dark fs-5" style="text-decoration: none;"><i class="fa-solid fa-right-left"></i> Back</a>
                <div class="container col-md-8 pb-5"> 
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $EmployeeID; ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">First Name</label>
                                            <input type="text" value="<?php echo htmlspecialchars($employee['FirstName']); ?>" name="firstname" class="form-control" id="firstname" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Last Name</label>
                                            <input type="text" value="<?php echo htmlspecialchars($employee['LastName']); ?>" name="lastname" class="form-control" id="lastname">
                                        </div>
                                        <div class="mb-3">
                                            <label for="birthdate" class="form-label">Birth Date</label>
                                            <input type="date" value="<?php echo htmlspecialchars($employee['BirthDate']); ?>" name="birthdate" class="form-control" id="birthdate">
                                        </div>
                                        <div class="mb-3">
                                            <label for="note" class="form-label">Notes</label>
                                            <input type="text" value="<?php echo htmlspecialchars($employee['Notes']); ?>" name="note" class="form-control" id="note">
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Update Employee">
                                    </form>
                </div>
            </div>
            <?php
        } else {
            echo "<script>alert('Employee not found');</script>";
        }
    } else {
        echo "<script>alert('No Employee ID provided');</script>";
    }
}

function update_employee($updatedEmployee) {
    $conn = db_conn();
    $stmt = $conn->prepare("UPDATE employee SET FirstName = ?, LastName = ?, BirthDate = ?, Notes = ? WHERE EmployeeID = ?");
    return $stmt->execute([
        $updatedEmployee['FirstName'],
        $updatedEmployee['LastName'],
        $updatedEmployee['BirthDate'],
        $updatedEmployee['Notes'],
        $updatedEmployee['EmployeeID']
    ]);
}

// Assuming fetch_employees function is defined and fetches employee details
// function fetch_employees() {
//     $conn = db_conn();
//     $stmt = $conn->query('SELECT * FROM employee');
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }
?>
