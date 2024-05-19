<?php
function category_update() {
    // Fetch categories (assuming this function is defined and works correctly)
    $categories = fetch_category();

    // Check if 'id' is provided in the query string
    if (isset($_GET['id'])) {
        $CategoryID = $_GET['id'];
        $categoryFound = false;

        // Find the category with the matching ID
        foreach ($categories as $category) {
            if ($category["CategoryID"] == $CategoryID) {
                $categoryFound = true;
                break;
            }
        }

        if ($categoryFound) {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                // Update category details
                $updatedCategory = [
                    'CategoryID' => $CategoryID,
                    'CategoryName' => $_POST['categoryname'],
                    'Description' => $_POST['description']
                ];

                if (update_category($updatedCategory)) {  // Update the category in the database
                    echo "
                    <script>
                    alert('Category updated successfully');
                    window.location.href = 'category_update.php?id=" . $_GET['id'] . "';
                    </script>";
                } else {
                    echo "<script>alert('Failed to update Category');</script>";
                }
            }
            ?>
            <div class="container p-4">
                <h1 class="mt-4 mb-4">Update Category - Record</h1>
                <hr>
                <a href="category.php" class="text-dark fs-5" style="text-decoration: none;"><i class="fa-solid fa-right-left"></i> Back</a>
                <div class="container col-md-8 pb-5"> 
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $CategoryID; ?>" method="POST">
                                        <div class="mb-3">
                                            <label for="categoryname" class="form-label">Category Name</label>
                                            <input type="text" value="<?php echo htmlspecialchars($category['CategoryName']); ?>" name="categoryname" class="form-control" id="categoryname" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <input type="text" value="<?php echo htmlspecialchars($category['Description']); ?>" name="description" class="form-control" id="description">
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Update Category">
                                    </form>
                </div>
            </div>
            <?php
        } else {
            echo "<script>alert('Category not found');</script>";
        }
    } else {
        echo "<script>alert('No Category ID provided');</script>";
    }
}

function update_category($updatedCategory) {
    $conn = db_conn();
    $stmt = $conn->prepare("UPDATE categories SET CategoryName = ?, Description = ? WHERE CategoryID = ?");
    return $stmt->execute([
        $updatedCategory['CategoryName'],
        $updatedCategory['Description'],
        $updatedCategory['CategoryID']
    ]);
}
?>
