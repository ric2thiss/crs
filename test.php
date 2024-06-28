<?php foreach ($employees as $employee) { ?>
                            <tr>
                                <td><?php echo $employee['EmployeeID']; ?></td>
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
                        <?php } ?>