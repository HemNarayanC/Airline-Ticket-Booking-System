<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Card</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
</head>
<body>
    <div class="flight-card">

    <!-- Flight header -->
        <div class="flight-card-header">
            <div class="airline">
                <span>Ransh Airline</span>
            </div>
            <div class="seat-class">
                <span>Seat Class</span>
                <button class="price-btn">NPR. 7500</button>
            </div>
        </div>

        <!-- Flight Route -->
         <div class="flight-routes-container">
            <!-- onward-flight -->
            <div class="flight-route onward-flight">
                <div class="route-info">
                    <div class="departure">
                        <div class="time">9:45 am</div>
                        <div class="city">Kathmandu, KTM</div>
                        <div class="date">12 Oct 2024, Mon</div>
                    </div>

                    <div class="flight-duration">
                        <div class="duration-line">
                            <span class="dot"></span>
                            <span class="line"></span>
                            <span class="dot"></span>
                        </div>
                    </div>

                    <div class="arrival">
                        <div class="time">11:06 am</div>
                        <div class="city">Pokhara, PKR</div>
                        <div class="date">12 Oct, 2024, Mon</div>
                    </div>

                    <div class="flight-details">
                        <div class="detail">
                            <span class="label">Seats Left:</span>
                            <span class="value">10+</span>
                        </div>
                        <div class="detail">
                            <span class="label">Flight:</span>
                            <span class="value">U6-5084</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Return Flight -->
             

         </div>
    </div>
</body>
</html>