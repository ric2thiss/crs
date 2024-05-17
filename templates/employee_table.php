<?php
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function employees_table() {
    $employees = fetch_employees();
    $employees_count = fetch_employees_count();
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4 mb-4">Employees - Records</h1>
        <hr>
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
                                <td><?php echo $employee['BirthDate']; ?></td>
                                <td><img src="<?php echo $employee['Photo']; ?>" alt="Employee Photo" width="50" height="50"></td>
                                <td>
                                    <span style="
                                        display: block;
                                        width: 350px;
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
