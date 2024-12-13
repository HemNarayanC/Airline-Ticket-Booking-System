<div class = "airport-list-container">
    <h2>Airport List</h2>
    <table class="airport-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Airport Name</th>
                <th>Location</th>
                <th>Area Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include('../partials/_db_connect.php');
                $sqlAirportCheck = "SELECT * FROM `airport`";
                $resultAirport = mysqli_query($conn, $sqlAirportCheck);
                if($resultAirport && mysqli_num_rows($resultAirport)){
                    while($row = mysqli_fetch_assoc($resultAirport)) {
                        echo "<tr>";
                        echo "<td>{$row['airport_id']}</td>";
                        echo "<td>{$row['airport_name']}</td>";
                        echo "<td>{$row['location']}</td>";
                        echo "<td>{$row['area_code']}</td>";
                        echo "<td class = 'airport-action-btn'>";
                            echo "<button class = 'airport-edit-btn'> Edit </button>";
                            echo "<button class = 'airport-delete-btn'> Delete </button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }

                else{
                    echo "<tr><td colspan = '4'>No airports found</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>