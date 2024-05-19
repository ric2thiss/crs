<?php


function employees_table() {
    $employees = fetch_employees();
    $employees_count = fetch_employees_count();
    function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Sanitize input
        $firstname = sanitizeInput($_POST['firstname']);
        $lastname = sanitizeInput($_POST['lastname']);
        $birthdate = sanitizeInput($_POST['birthdate']);
        $note = sanitizeInput($_POST['note']);
        
        // Check if a file was uploaded without errors
        if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
            $fileTmpPath = $_FILES['profile']['tmp_name'];
            $fileName = $_FILES['profile']['name'];
            $fileSize = $_FILES['profile']['size'];
            $fileType = $_FILES['profile']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            
            // Specify allowed file types
            $allowedfileExtensions = array('png', 'jpg', 'jpeg');
            
            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Read file content into a variable
                $fileContent = file_get_contents($fileTmpPath);
                
                // Save the details and the image to the database
                if (save_employee_to_database($firstname, $lastname, $birthdate, $note, $fileContent)) {
                    echo "<script>
                    alert('Employee added successfully');
                    window.location.href = 'employees.php';
                    </script>";
                } else {
                    echo "<script>alert('Failed to add employee');</script>";
                }
            } else {
                echo 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
            }
        } else {
            echo 'No file uploaded or there was an upload error.';
        }
    }


    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4">Employees - Records</h1>
        <hr>
        <!-- FORM INSERT NEW EMPLOYEE -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Birth Date</label>
                            <input type="date" name="birthdate" class="form-control" id="birthdate" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Notes</label>
                            <input type="text" name="note" class="form-control" id="note" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="profile" class="form-label">Profile</label>
                            <input type="file" name="profile" class="form-control" id="profile" accept=".png, .jpg, .jpeg" required>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Add Employee">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Current Count of Employees - <span><?php echo $employees_count; ?></span>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa fa-add"></i> Add Employee
                </button>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>EmployeeID</th>
                            <th>LastName</th>
                            <th>FirstName</th>
                            <th>BirthDate</th>
                            <th>Photo</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>EmployeeID</th>
                            <th>LastName</th>
                            <th>FirstName</th>
                            <th>BirthDate</th>
                            <th>Photo</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($employees as $employee) { ?>
                            <tr>
                                <td><?php echo $employee['EmployeeID']; ?></td>
                                <td><?php echo $employee['LastName']; ?></td>
                                <td><?php echo $employee['FirstName']; ?></td>
                                <td><?php echo $employee['BirthDate']; ?></td>
                                <td>
                                <?php if (!empty($employee['Photo'])): ?>
                                <?php
                                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                                    $mime = $finfo->buffer($employee['Photo']);
                                    $imageData = base64_encode($employee['Photo']);
                                ?>
                                <img src="data:<?php echo $mime; ?>;base64,<?php echo $imageData; ?>" alt="Employee Photo" width="100">
                            <?php else: ?>
                                No Photo
                            <?php endif; ?>
                                </td>
                                <td>
                                    <span style="
                                        display: block;
                                        width: 250px;
                                        white-space: nowrap; 
                                        overflow: hidden;
                                        text-overflow: ellipsis;">
                                        <?php echo $employee['Notes']; ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-primary">Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <?php
}
?>
