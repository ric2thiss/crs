<?php
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function customer_table(){
        // Customers
        $customers = fetch_customers();
        $customer_count = fetch_customers_count();
        

        $errMsg = ""; // Initialize error message variable

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["customername"]) || 
                empty($_POST["contactname"]) || 
                empty($_POST["address"]) || 
                empty($_POST["city"]) || 
                empty($_POST["postal"]) || 
                empty($_POST["country"])) {
                $errMsg = "All fields are required!";
            } else {
                // Process the form data
                $customerName = sanitizeInput($_POST["customername"]);
                $contactName = sanitizeInput($_POST["contactname"]);
                $address = sanitizeInput($_POST["address"]);
                $city = sanitizeInput($_POST["city"]);
                $postalCode = sanitizeInput($_POST["postal"]);
                $country = sanitizeInput($_POST["country"]);
                
                // Insert into database or any other processing
                if (create_new_customer($customerName, $contactName, $address, $city, $postalCode, $country)) {
                    echo "
                    <script>
                        alert('Successfully created new customer')
                        window.location = 'customers.php'
                    </script>
                    ";
                } else {
                    echo "Failed to create new customer.";
                }
            }
}

        ?>
            <div class="container-fluid px-4">
                <!-- Modals for Customer Information -->
                    <!-- Button trigger modal -->
                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customer_modal">
                    Launch demo modal
                    </button> -->

                    <!-- Modal -->
                    <div class="modal fade" id="customer_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                    </div>


                <!-- End -->




                        <h1 class="mt-4 mb-4">Customers - Records</h1>
                        <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Records</li>
                        </ol> -->
                        <hr>
                        <?php if (!empty($errMsg)): ?>
                        <p style="color: red;"><?php echo $errMsg; ?></p>
                        <?php endif; ?>
                        <!-- Modal -->
                          <!-- Adding Customer Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Customer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                                        <div class="mb-3">
                                            <label for="customer-name" class="form-label">Customer Name</label>
                                            <input type="text"  name="customername"  class="form-control" id="customer-nam" aria-describedby="emailHelp">
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
                                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
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
                                Current Count of Customers - <span><?php echo $customer_count ?></span>
                                <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><li class="fa fa-add"></li> Add Customer</button>
                            </div>
                            <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer Name</th>
                                                <th>Contact Name</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>Postal Code</th>
                                                <th>Country</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer Name</th>
                                                <th>Contact Name</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>Postal Code</th>
                                                <th>Country</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                            <?php
                                                foreach($customers as $customer){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $customer['CustomerID']?></td>
                                                        <td><?php echo $customer['CustomerName'] ?></td>
                                                        <td><?php echo $customer['ContactName'] ?></td>
                                                        <td><?php echo $customer['Address'] ?></td>
                                                        <td><?php echo $customer['City'] ?></td>
                                                        <td><?php echo $customer['PostalCode'] ?></td>
                                                        <td><?php echo $customer['Country'] ?></td>
                                                        <td>
                                                            <a href="customer_update.php?id=<?php echo $customer['CustomerID'] ?>" class="btn btn-primary">Edit</a>
                                                            <a href='delete.php?id=<?php echo $customer['CustomerID'] ?>' class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
        <?php
    }

?>