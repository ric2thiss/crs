<?php
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function suppliers_table(){

        $suppliers = fetch_suppliers();
        $suppliers_count = fetch_suppliers_count();


        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            // Sanitize and validate input
            $supplierName = htmlspecialchars(trim($_POST['SupplierName']));
            $contactName = htmlspecialchars(trim($_POST['contactname']));
            $address = htmlspecialchars(trim($_POST['address']));
            $city = htmlspecialchars(trim($_POST['city']));
            $postalCode = htmlspecialchars(trim($_POST['postal']));
            $country = htmlspecialchars(trim($_POST['country']));
            $phone = htmlspecialchars(trim($_POST['phone']));
            
            // Check for empty fields
            if (empty($supplierName) || empty($contactName) || empty($address) || empty($city) || empty($postalCode) || empty($country) || empty($phone)) {
                echo "<script>alert('Please fill in all the fields');</script>";
            } else {
                // Save the new supplier
                if (save_new_supplier([
                    'SupplierName' => $supplierName,
                    'contactname' => $contactName,
                    'address' => $address,
                    'city' => $city,
                    'postal' => $postalCode,
                    'country' => $country,
                    'phone' => $phone
                ])) {
                    echo "<script>
                            alert('Supplier created successfully.');
                            window.location.href = 'suppliers.php'; // Redirect to a suppliers listing page or relevant page
                          </script>";
                } else {
                    echo "<script>alert('Failed to create Supplier.');</script>";
                }
            }
        }
        
        ?>
            <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Supplier - Records</h1>
    
                        <hr>
                        <!-- ------------------------------- -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Supplier</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                                        <div class="mb-3">
                                            <label for="SupplierName" class="form-label">SupplierName</label>
                                            <input type="text"  name="SupplierName"  class="form-control" id="SupplierName" aria-describedby="emailHelp">
                                            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                                        </div>
                                        <div class="mb-3">
                                            <label for="contact-name" class="form-label">Contact Name</label>
                                            <input type="text" name="contactname"  class="form-control" id="contact-name" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" name="address"  class="form-control" id="address" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City</label>
                                            <input type="text" name="city"  class="form-control" id="city">
                                        </div>
                                        <div class="mb-3">
                                            <label for="postalcode" class="form-label">Postal Code</label>
                                            <input type="number" name="postal"  class="form-control" id="postalcode">
                                        </div>
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Country</label>
                                            <input type="text" name="country"  class="form-control" id="country">
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


                        <!-- ------------------------------- -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Current Count of Categories - <span><?php echo $suppliers_count?></span>
                                <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><li class="fa fa-add"></li> Add Supplier</button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>SupplierID</th>
                                            <th>SupplierName</th>
                                            <th>ContactName</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>PostalCode</th>
                                            <th>Country</th>
                                            <th>Phone</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SupplierID</th>
                                            <th>SupplierName</th>
                                            <th>ContactName</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>PostalCode</th>
                                            <th>Country</th>
                                            <th>Phone</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($suppliers as $supplier) { ?>
                                            <tr>
                                                <td><?php echo $supplier['SupplierID'] ?></td>
                                                <td><?php echo $supplier['SupplierName'] ?></td>
                                                <td><?php echo $supplier['ContactName'] ?></td>
                                                <td><?php echo $supplier['Address'] ?></td>
                                                <td><?php echo $supplier['City'] ?></td>
                                                <td><?php echo $supplier['PostalCode'] ?></td>
                                                <td><?php echo $supplier['Country'] ?></td>
                                                <td><?php echo $supplier['Phone'] ?></td>

                                                <td>
                                                    <a href="update_supplier.php?id=<?php echo $supplier['SupplierID']; ?>" class="btn btn-primary">Edit</a>
                                                    <a href="delete_supplier.php?id=<?php echo $supplier['SupplierID']; ?>" class="btn btn-danger">Delete</a>
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