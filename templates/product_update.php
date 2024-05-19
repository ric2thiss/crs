<?php
function product_update() {
    // Initialize Fetching of Data Functions
    $products = fetch_products();
    $supplierIDs = fetch_suppliers();
    $categoryIDs = fetch_category();

    // Check if 'id' is provided in the query string
    if (isset($_GET['id'])) {
        $productID = $_GET['id'];
        $productFound = false;

        // Find the product with the matching ID
        foreach ($products as $product) {
            if ($product["ProductID"] == $productID) {
                $productFound = true;
                break;
            }
        }

        if ($productFound) {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                // Update product details
                $updatedProduct = [
                    'ProductID' => $productID,
                    'ProductName' => $_POST['productname'],
                    'SupplierID' => $_POST['supplierID'],
                    'CategoryID' => $_POST['categoryID'],
                    'Unit' => $_POST['unit'],
                    'Price' => $_POST['price']
                ];

                if (update_product($updatedProduct)) {  // Update the product in the database
                    echo "
                    <script>
                    alert('Product updated successfully');
                    window.location.href = 'product_update.php?id=" . $_GET['id'] . "';
                    </script>";
                } else {
                    echo "<script>alert('Failed to update Product');</script>";
                }
            }
            ?>
            <div class="container p-4">
                <h1 class="mt-4 mb-4">Update Product - Record</h1>
                <hr>
                <a href="products.php" class="text-dark fs-5" style="text-decoration: none;"><i class="fa-solid fa-right-left"></i> Back</a>
                <div class="container col-md-8 pb-5"> 
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $productID; ?>" method="POST">
                    <div class="mb-3">
                        <label for="productname" class="form-label">Product Name</label>
                        <input type="text" value="<?php echo htmlspecialchars($product['ProductName']); ?>" name="productname" class="form-control" id="productname" required>
                    </div>
                    <div class="mb-3">
                        <label for="supplierID" class="form-label">Supplier</label>
                        <select name="supplierID" class="form-select" aria-label="Default select example" required>
                            <option disabled>Select Supplier</option>
                            <?php
                                foreach($supplierIDs as $supplier) {
                                    // Set selected option
                                    $selected = ($product['SupplierID'] == $supplier["SupplierID"]) ? 'selected' : '';
                                    echo '<option value="'.$supplier["SupplierID"].'" '.$selected.'>'.$supplier["SupplierName"].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="categoryID" class="form-label">Category</label>
                        <select name="categoryID" class="form-select" aria-label="Default select example" required>
                            <option disabled>Select Category</option>
                            <?php
                                foreach($categoryIDs as $categoryID) {
                                    // Set selected option
                                    $selected = ($product['CategoryID'] == $categoryID["CategoryID"]) ? 'selected' : '';
                                    echo '<option value="'.$categoryID["CategoryID"].'" '.$selected.'>'.$categoryID["CategoryName"].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" value="<?php echo htmlspecialchars($product['Unit']); ?>" name="unit" class="form-control" id="unit" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" value="<?php echo htmlspecialchars($product['Price']); ?>" name="price" class="form-control" id="price" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update Product">
                </form>
            </div>
            <?php
        } else {
            echo "<script>alert('Product not found');</script>";
        }
    } else {
        echo "<script>alert('No Product ID provided');</script>";
    }
}

function update_product($updatedProduct) {
    $conn = db_conn();
    $stmt = $conn->prepare("UPDATE products SET ProductName = ?, SupplierID = ?, CategoryID = ?, Unit = ?, Price = ? WHERE ProductID = ?");
    return $stmt->execute([
        $updatedProduct['ProductName'],
        $updatedProduct['SupplierID'],
        $updatedProduct['CategoryID'],
        $updatedProduct['Unit'],
        $updatedProduct['Price'],
        $updatedProduct['ProductID']
    ]);
}
?>
