<?php
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function categories_table(){

        $categories = fetch_category();
        $categories_count = fetch_category_count();


        $errMsg = ""; // Initialize error message variable

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["categoryname"]) || empty($_POST["description"])) {
                $errMsg = "All fields are required!";
            } else {
                // Sanitize input
                $categoryname = sanitizeInput($_POST["categoryname"]);
                $description = sanitizeInput($_POST["description"]);
                
                // Insert into database or any other processing
                if (create_new_category($categoryname, $description)) { // Changed to create_new_customer
                    echo "
                    <script>
                        alert('Successfully created new category');
                        window.location.href = 'category.php';
                    </script>
                    ";
                } else {
                    echo "Failed to create new category.";
                }
            }
        }

        
        ?>
            <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Category - Records</h1>
    
                        <hr>
                        <?php if (!empty($errMsg)): ?>
                        <p style="color: red;"><?php echo $errMsg; ?></p>
                        <?php endif; ?>
                        <!-- FORM INSERT NEW CATEGORY -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Category</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                                        <div class="mb-3">
                                            <label for="categoryname" class="form-label">Category Name</label>
                                            <input type="text"  name="categoryname"  class="form-control" id="customer-nam" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <input type="text" name="description"  class="form-control" id="contact-name" >
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Create Category">
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
                                Current Count of Categories - <span><?php echo $categories_count?></span>
                                <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><li class="fa fa-add"></li> Add Category</button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>CategoryID</th>
                                            <th>CategoryName</th>
                                            <th>Description</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>CategoryID</th>
                                            <th>CategoryName</th>
                                            <th>Description</th>
                                            <th>Actions</th> <!-- Added a new column for actions -->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($categories as $category) { ?>
                                            <tr>
                                                <td><?php echo $category['CategoryID'] ?></td>
                                                <td><?php echo $category['CategoryName'] ?></td>
                                                <td><?php echo $category['Description'] ?></td>
                                                <td>
                                                    <a href="category_update.php?id=<?php echo $category['CategoryID'] ?>" class="btn btn-primary">Edit</a>
                                                    <a href='delete_category.php?id=<?php echo $category['CategoryID'] ?>' class="btn btn-danger">Delete</a>
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