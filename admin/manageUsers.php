
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="airlineReviewTable.css">
    <link rel="stylesheet" href="adminDashboard.css">
    <link rel="stylesheet" href="manageAirport.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <?php
        include('adminDashboard.php');
        // include('../partials/_db_connect.php');
        if (isset($_GET['user_id']) && isset($_GET['action']) && $_GET['action'] === 'delete') {
            $user_id = $_GET['user_id'];
            $delete_user_sql = "DELETE FROM `users` WHERE `user_id` = $user_id";
            $delete_user_result = mysqli_query($conn, $delete_user_sql);
            if ($delete_user_result) {
                echo "<p>Record deleted successfully!</p>";
                header("Location: manageUsers.php");
                exit();
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        }
    ?>
    <!-- Main Content -->
    <main class="main-content">
            <!-- Header -->
             <header class="header">
                <div class="header-content">
                    <div class="section-title">
                        DASHBOARD
                    </div>
                    <div class="search-bar">
                        <i class="material-icons">search</i>
                        <input type="text" name="search" id="searchBar" placeholder="Search">
                    </div>
                </div>
             </header>
         

            <div class="managing-container">
                <div class = "airport-list-container">
                    <h2>Users(Passengers)</h2>
                    <table class="airport-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // include('../partials/_db_connect.php');
                                $sqlUsersCheck = "SELECT * FROM `users`";
                                $resultUsers = mysqli_query($conn, $sqlUsersCheck);
                                if($resultUsers && mysqli_num_rows($resultUsers)){
                                    while($row = mysqli_fetch_assoc($resultUsers)) {
                                        echo "<tr>";
                                        echo "<td>{$row['user_id']}</td>";
                                        echo "<td>{$row['fname']} {$row['mid_name']} {$row['lname']}</td>";
                                        echo "<td>{$row['phone']}</td>";
                                        echo "<td>{$row['email']}</td>";
                                        echo "<td class = 'airport-action-btn'>";
                                            // echo "<button class='airport-edit-btn'><a href='updateAirport.php?air_id={$row["airport_id"]}&action=edit'> Edit </a></button>";
                                            echo "<button class = 'airport-delete-btn'><a href='manageUsers.php?user_id={$row['user_id']}&action=delete'> Delete </a></button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }

                                else{
                                    echo "<tr><td colspan = '4'>No Users found</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
         </main>
        <script src="airlineReviewTable.js"></script>
</body>
</html>