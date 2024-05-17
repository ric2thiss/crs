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
        
        ?>
            <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Category - Records</h1>
    
                        <hr>
    
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