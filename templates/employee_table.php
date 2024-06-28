<?php

function employees_table() {
    $employees = fetch_employees();
    $employees_count = fetch_employees_count();
    
    function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize input
        $firstname = sanitizeInput($_POST['firstname']);
        $lastname = sanitizeInput($_POST['lastname']);
        $birthdate = sanitizeInput($_POST['birthdate']);
        $note = sanitizeInput($_POST['note']);
        $photo = $_POST["Photo"];

        if (save_employee_to_database($firstname, $lastname, $birthdate, $note, $photo)) {
            echo "<script>
            alert('Employee added successfully');
            window.location.href = 'employees.php';
            </script>";
        } else {
            echo "<script>alert('Failed to add employee');</script>";
        }
    }

    ?>
    <div class="container-fluid px-4">
    <!-- START -->
     <!-- Modal -->
     <div class="modal fade" id="employee_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Employee Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" 
                        style="
                        display:flex;
                        align-items:flex-start;
                        justify-content: space-between;
                        "
                        >
                            <div>
                                <div><strong>EmployeeID :</strong> <span id="modalEmployeeID"></span></div>
                                <div><strong>Last Name :</strong>  <span id="modalEmployeeLastName"></span></div>
                                <div><strong>First Name :</strong> <span id="modalEmployeeFirstName"></span></div>
                                <div><strong>BirthDate :</strong> <span id="modalEmployeeBirthDate"></span></div>
                                <!-- <div>Photo : <span id="modalEmployeePhoto"></span></div> -->
                                <div><strong>Notes :</strong> <span id="modalEmployeeNotes"></span></div>
                            </div>
                            <div id="image"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        </div>
                        </div>
                    </div>
                    </div>

                    <script>
                        function ModalEmployee(data){
                            var employeeid = data.getAttribute('data-employeeid');
                            var lastname = data.getAttribute('data-lastname');
                            var firstname = data.getAttribute('data-firstname');
                            var birthdate = data.getAttribute('data-birthdate');
                            var photo = data.getAttribute('data-photo');
                            var notes = data.getAttribute('data-notes');

                            var image = document.getElementById('image');
                            image.innerHTML = `<img src="photos/${photo}" alt="Profile" width="150">`;

                            document.getElementById('modalEmployeeID').textContent = employeeid;
                            document.getElementById('modalEmployeeLastName').textContent = lastname;
                            document.getElementById('modalEmployeeFirstName').textContent = firstname;
                            document.getElementById('modalEmployeeBirthDate').textContent = birthdate;
                            document.getElementById('modalEmployeeNotes').textContent = notes;
                        }

                    </script>


                <!-- End -->


    <!-- END -->
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
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
                            <label for="Photo" class="form-label">Profile</label>
                            <input type="file" name="Photo" class="form-control" id="Photo" required>
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
                    <tbody>
                    <?php
                        foreach($employees as $employee){
                            ?>
                            <tr>
                                <td>
                                <button 
                                    type="button" 
                                    class="btn btn-light" 
                                    data-bs-toggle="modal" 
                                    onclick="ModalEmployee(this)"
                                    data-employeeid="<?php echo $employee['EmployeeID']?>" 
                                    data-lastname="<?php echo $employee['LastName'] ?>"
                                    data-firstname="<?php echo $employee['FirstName'] ?>"
                                    data-birthdate="<?php echo $employee['BirthDate'] ?>"
                                    data-photo="<?php echo $employee['Photo'];?>"
                                    data-notes="<?php echo $employee['Notes'];?>"
                                    data-bs-target="#employee_modal">
                                    <?php echo $employee['EmployeeID']?>
                                </button>
                                
                                </td>
                                <td><?php echo $employee['LastName']; ?></td>
                                <td><?php echo $employee['FirstName']; ?></td>
                                <td><?php echo $employee['BirthDate']; ?></td>
                                <td><img src="photos/<?php echo $employee['Photo'];?>" width ="100px"></td>
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
                                    <a href="employees_update.php?id=<?php echo $employee['EmployeeID']; ?>" class="btn btn-primary">Edit</a>
                                    <a href="delete_employee.php?id=<?php echo $employee['EmployeeID']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php
                            }
                        ?>
                        <!-- Diri ibalik -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
}
?>
