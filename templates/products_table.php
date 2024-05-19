<?php
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function products_table(){

        $products = fetch_products();
        $products_count = fetch_products_count();
        $categoryIDs = fetch_category();
        $supplierIDs = fetch_suppliers();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            // Sanitize input
            $productName = htmlspecialchars($_POST['productname']);
            $supplierID = htmlspecialchars($_POST['supplierID']);
            $categoryID = htmlspecialchars($_POST['categoryID']);
            $unit = htmlspecialchars($_POST['Unit']);
            $price = htmlspecialchars($_POST['price']);
        
            // Save the product to the database
            if (save_product_to_database($productName, $supplierID, $categoryID, $unit, $price)) {
                echo "<script>
                        alert('Product added successfully');
                        window.location.href = 'products.php';
                      </script>";
            } else {
                echo "<script>alert('Failed to add product');</script>";
            }
        }
        
        ?>
            <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Products - Records</h1>
    
                        <hr>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Product</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="productname" class="form-label">Product Name</label>
                                            <input type="text" name="productname" class="form-control" id="productname" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="supplierID" class="form-label">Supplier</label>
                                            <select class="form-select" name="supplierID" aria-label="Default select example" required>
                                                <option selected disabled>Select Supplier</option>
                                                <?php
                                                    foreach($supplierIDs as $supplier) {
                                                        echo '<option value="' . $supplier["SupplierID"] . '">' . $supplier["SupplierName"] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="categoryID" class="form-label">Category</label>
                                            <select class="form-select" name="categoryID" aria-label="Default select example" required>
                                                <option selected disabled>Select Category</option>
                                                <?php
                                                    foreach($categoryIDs as $categoryID) {
                                                        echo '<option value="' . $categoryID["CategoryID"] . '">' . $categoryID["CategoryName"] . '</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Unit" class="form-label">Unit</label>
                                            <input type="text" name="Unit" class="form-control" id="Unit" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" step="0.01" name="price" class="form-control" id="price" aria-describedby="emailHelp" required>
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Add New Product">
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
                                Current Count of Products - <span><?php echo $products_count?></span>
                                <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><li class="fa fa-add"></li> Add Products</button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>ProductID</th>
                                            <th>ProductName</th>
                                            <th>SupplierID</th>
                                            <th>CategoryID</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ProductID</th>
                                            <th>ProductName</th>
                                            <th>SupplierID</th>
                                            <th>CategoryID</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($products as $product) { ?>
                                            <tr>
                                                <td><?php echo $product['ProductID'] ?></td>
                                                <td><?php echo $product['ProductName'] ?></td>
                                                <td><?php echo $product['SupplierID'] ?></td>
                                                <td><?php echo $product['CategoryID'] ?></td>
                                                <td><?php echo $product['Unit'] ?></td>
                                                <td><?php echo $product['Price'] ?></td>
                                                <td>
                                                    <a href="update_product.php?id=<?php echo $product['ProductID']?>" class="btn btn-primary">Edit</a>
                                                    <a href="delete_product.php?id=<?php echo $product['ProductID']?>" class="btn btn-danger">Delete</a>
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