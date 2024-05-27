<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Seat Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/sstyle.css">
    <style>
        /* Additional styles for visualization */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .screen {
                width: 100%;
            }
        }

        .form-control{
            border-radius: 7px;
            border-color: rgb(143, 143, 143);
            background-color: transparent !important;
            padding: 10px;  
            height: 53px;
            width: 25%; 
            color: #ffffff !important;
            margin: 0 auto;
        }

        .form-control::placeholder, .form-select::placeholder {
            color: #747d85;
        }

        .form-control:focus, .form-select:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: none;
        }

        .form-control:-webkit-autofill, .form-select:-webkit-autofill {
            -webkit-text-fill-color: white !important;
            transition: background-color 5000s ease-in-out 0s;
            -webkit-box-shadow: 0 0 0px 1000px transparent inset !important;
            background-color: transparent !important;
        }

        .form-control option {
            background-color: #242333;
            color: white;
            border: none !important;
        }
        
    </style>
</head>
<body>
    <!-- text center -->
    <div class="container text-center">
        <div class="header">
            <h2>Reserve a Seat</h2>
        </div>
        <form id="reservationForm" name="reservationForm" method="post" action="<?= ROOT ?>/UserReservations/addReservation" enctype="multipart/form-data" class="user">
            <div class="form-group">
                <label for="movieID">Movie ID:</label>
                <input type="text" id="movieID" name="movieID" class="form-control form-control-user" required readonly value="<?= htmlspecialchars($MovieID) ?>">
            </div>
            <!-- my-3 -->
            <div class="form-group my-3">
                <label for="userID">User ID:</label>
                <input type="text" id="userID" name="userID" class="form-control form-control-user" required readonly value="<?= htmlspecialchars($user_id) ?>">
            </div>
            <div class="form-group">
                <label for="showtime">Select Showtime:</label>
                <select class="form-control form-control-user" id="showtime" name="showtime" required>
                    <option value="">Select Showtime</option>
                    <?php foreach ($showtimes as $showtime) : ?>
                        <option value="<?= htmlspecialchars($showtime->ShowtimeID) ?>" data-screen="<?= htmlspecialchars($showtime->ScreenID) ?>">
                            <?= "SCREEN {$showtime->ScreenID} - MOVIE ID: {$showtime->MovieID} - {$showtime->StartTime} - {$showtime->EndTime}" ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- btnlight, mt-3,  style="width: 25%; -->
            <input type="submit" id="reserve-btn" value="Reserve" class="btn btn-light btn-user btn-block mt-3"  style="width: 25%;">
        </form>
    </div>
    
    <script src="<?= ROOT ?>/assets/js/jquery-3.7.1.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/sscript.js"></script>
    <script>
$(document).ready(function() {
    $('#reservationForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission to do it programmatically

        var showtimeId = $('#showtime').val(); // Get the selected showtime ID
        var movieId = $('#movieID').val(); // Get the movie ID

        if (!showtimeId) {
            alert('Please select a showtime.');
            return;
        }

        // Assuming you have validated the form and all values are correct
        // Now, proceed to submit the form programmatically
        $.ajax({
            url: 'UserReservations/addReservation',
            type: 'POST',
            data: {
                showtimeId: showtimeId,
                movieID: movieId
            },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.success) {
                    alert('Reservation added successfully. Proceeding to payment.'); // Display a success message
                    console.log('Reservation added successfully');
                    
                    // Redirect to payment page
                    window.location.href = '<?= ROOT ?>/Payment'; // Replace with your actual payment page URL
                } else {
                    alert(result.message);
                    console.error('Error adding reservation:', result.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                alert('Reservation added successfully');
                
                window.location.href = '<?= ROOT ?>/Payment'; // Replace with your actual payment page URL
            }
        });
    });
});
</script>

</body>
</html>
