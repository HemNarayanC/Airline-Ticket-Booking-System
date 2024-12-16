<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="adminDashboard.css">
    <link rel="stylesheet" href="adminProfile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <?php
        include('adminDashboard.php');
        $sqlAdmin = "SELECT * FROM `admin` WHERE `admin_id` = $a_id";
        $resultAdmin = mysqli_query($conn, $sqlAdmin);
        $numOfRows = mysqli_num_rows($resultAdmin);
        if($numOfRows == 1){
            $row = mysqli_fetch_assoc($resultAdmin);
            $admin_id = $row['admin_id'];
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $address = $row['address'];
            $dob = $row['date_of_birth'];
            $doj = $row['created_at'];
            // $formatted_doj = date('Y-m-d', strtotime($doj));
            $formatted_doj = date('Y-m-d\TH:i', strtotime($doj));
        }

        else{
            echo "No record found with ID:";
        }
    ?>
    <main class="main-content">
            <!-- Header -->      

            <div class="managing-container">
                <div class="profile-container">
                    <!-- Profile Header -->
                    <div class="header profile-header">
                        <div class="avatar" id="avatar">
                            <span class="initial"><?php echo $initialName; ?></span>
                        </div>
                        <div class="info">
                            <h2 id="headerName"><?php echo $name; ?></h2>
                            <p id="headerRole"><?php echo $_SESSION['user-type']; ?></p>
                            <p id="headerLocation"><?php echo $address; ?></p>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="section">
                        <div class="section-header">
                            <h3>Personal Information</h3>
                            <button class="edit-btn">Edit</button>
                            <button class="save-btn hidden">Save</button>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label for="admin-id">Admin ID</label>
                                <input type="text" id="admin-id" value="<?php echo $a_id; ?>" readonly>
                            </div>

                            <div class="field">
                                <label for="name">Name</label>
                                <input type="text" id="name" value="<?php echo $name; ?>" readonly>
                            </div>

                            <div class="field">
                                <label for="dob">Date of Birth</label>
                                <input type="date" id="dob" value="<?php echo $dob; ?>" readonly>
                            </div>

                            <div class="field">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" value="<?php echo $email; ?>" readonly>
                            </div>

                            <div class="field">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" value="<?php echo $phone; ?>" readonly>
                            </div>

                            <div class="field">
                                <label for="address">Address</label>
                                <input type="text" id="address" value="<?php echo $address; ?>" readonly>
                            </div>

                            <div class="field">
                                <label for="doj">Date Of Joining</label>
                                <input type="datetime-local" id="doj" value="<?php echo $formatted_doj; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
</body>
</html>