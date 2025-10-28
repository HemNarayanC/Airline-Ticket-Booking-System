

<?php
session_start();

    include '../partials/_navbar.php';
    include '../partials/_db_connect.php';
    $sqlAirport = "SELECT * FROM `airport`";

    $result = mysqli_query($conn, $sqlAirport);

    //an array to store airport details
    $airports = [];

    while($row = mysqli_fetch_assoc($result)){
        //pushing the airport details into an array from database
        $airports[] = $row;
    }

    // echo $airports;
    // echo json_encode($airports);
    // echo $_SESSION['loggedIn'];

    if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true){
        header('Location: ../auth/login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search</title>
    <link rel="stylesheet" href="../assets/navbar.css">
    <link rel="stylesheet" href="flightSearch.css">
    <link rel="stylesheet" href="../assets/footer.css">
    <script src="https://kit.fontawesome.com/f4c39070b8.js" crossorigin="anonymous"></script>
</head>
<body>

    <h1>Welcome to Home Page</h1>
    <?php
        echo $_SESSION['user-type-email'];
    ?>

    <h1 id="home-heading">Let's SkyBooker take you around</h1>
    <div class="flight-search-container">
        <form action="flightCard.php" method="post" id="flightSearch">

        <!-- Trip-Type tabs -->
            <div class="trip-type" id="trip-type-two">
                <label for="oneWay">
                    <input type="radio" name="tripType" value="oneWay" id="oneWay" checked> One-Way
                </label>
                <label for="roundTrip">
                    <input type="radio" name="tripType" value="roundTrip" id="roundTrip"> Round-Trip
                </label>
            </div>

            <!-- Search fields -->
             <div class="search-fields">

                 <!-- Demo Place Departure-->
                 <div class="field">
                    <label for="demoPlaceDepart">
                    <i class="fa-solid fa-plane-departure"></i>
                        From
                    </label>
                    <select name="demoPlaceDepart" id="from-location" class="airport-select-drop">
                        <option value="airport" selected disabled>Select an airport</option>
                        <!-- options for departure airports -->
                    </select>
                    <small id="demoPlaceDepart"></small>
                 </div>

                  <!-- Demo Place Destination-->
                  <div class="field">
                    <label for="demoPlaceDest">
                        <i class="fa-solid fa-plane-arrival"></i>
                        To
                    </label>
                    <select name="demoPlaceDest" id="to-location" class="airport-select-drop">
                        <option value="airport" selected disabled>Select an airport</option>
                        <!-- options for destination airports -->
                    </select>
                    <small id="demoPlaceDest"></small>
                 </div>

                 

                 <!-- departure date -->
                  <div class="field" id="departureDateField">
                    <label for="departureDate">
                        Departure Date
                    </label>
                    <input type="date" name="departureDate" id="departureDate" required>
                  </div>

                  <!-- Return date -->
                  <div class="field returnDate-hidden" id="returnDateField">
                    <label for="returnDate">
                        Return Date
                    </label>
                    <input type="date" name="returnDate" id="returnDate">
                  </div>

                <div class="field">
                    <label for="seatClass">Seat Class</label>
                    <select name="seatClass" id="seatClass">
                        <option value="select class" disabled selected>Select Class</option>
                        <option value="Economy">Economy</option>
                        <option value="Business">Business</option>
                        <option value="First_Class">First Class</option>
                    </select>
                </div>

                <div class="field">
                    <label for="passenger-select">Passengers</label>
                    <div class="passenger-select">
                        <label for="adults">Adults</label>
                        <select name="adults" id="adults">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                        <small>12+ years</small>
                        
                        <label for="children">Children</label>
                        <select name="children" id="children">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        <small>2-12 years</small>

                        <label for="infants">Infants</label>
                        <select name="infants" id="infants">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        <small>0-2 years</small>
                    </div>

                </div>
             </div>

             <button type="submit" id="searchBtn">Search Best Airfares</button>
        </form>
    </div>

    <?php
        include('../partials/_footer.php');
    ?>

    <!-- Script files -->
    <script src="../assets/navbar.js"></script>
    <!-- <script src="../auth/signup.js"></script> -->
    <script>
        const airports = <?php echo json_encode($airports); ?>;
    </script>
    <script src="flightSearch.js"></script>
</body>
</html>

