<?php
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function shippers_table(){

        $shippers = fetch_shippers();
        $shippers_count = fetch_shippers_count();


        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            // Sanitize input
            $shipperName = htmlspecialchars(trim($_POST['ShipperName']));
            $phone = htmlspecialchars(trim($_POST['phone']));
    
            // Validate input
            $errors = [];
            if (empty($shipperName)) {
                $errors[] = "Shipper Name is required.";
            }
            if (empty($phone)) {
                $errors[] = "Phone number is required.";
            } elseif (!preg_match("/^[0-9]{10,15}$/", $phone)) {
                $errors[] = "Phone number should be between 10 and 15 digits.";
            }
    
            // If there are no errors, proceed to save the shipper to the database
            if (empty($errors)) {
                if (insert_shipper_to_database($shipperName, $phone)) {
                    echo "<script>
                            alert('Shipper added successfully');
                            window.location.href = 'shippers.php';
                          </script>";
                } else {
                    echo "<script>alert('Failed to add shipper');</script>";
                }
            } else {
                // Display errors
                foreach ($errors as $error) {
                    echo "<script>alert('$error');</script>";
                }
            }
        }
        
        ?>
            <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Shippers</h1>
    
                        <hr>

                        <!-- ------------------------------------ -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Shipper</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                                        <div class="mb-3">
                                            <label for="ShipperName" class="form-label">ShipperName</label>
                                            <input type="text"  name="ShipperName"  class="form-control" id="ShipperName" aria-describedby="emailHelp">
                                            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" name="phone"  class="form-control" id="phone" >
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- --------------------- -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Current Count of Shippers - <span><?php echo $shippers_count?></span>
                                <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><li class="fa fa-add"></li> Add Shippers</button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>ShipperID</th>
                                            <th>ShipperName</th>
                                            <th>Phone</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ShipperID</th>
                                            <th>ShipperName</th>
                                            <th>Phone</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($shippers as $shipper) { ?>
                                            <tr>
                                                <td><?php echo $shipper['ShipperID'] ?></td>
                                                <td><?php echo $shipper['ShipperName'] ?></td>
                                                <td><?php echo $shipper['Phone'] ?></td>
                                                <td>
                                                    <a href="update_shipper.php?id=<?php echo $shipper['ShipperID']?>" class="btn btn-primary">Edit</a>
                                                    <a href="delete_shipper.php?id=<?php echo $shipper['ShipperID']?>" class="btn btn-danger">Delete</a>
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