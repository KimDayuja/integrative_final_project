<?php

/**
 * Reservation model class
 */
class PaymentModel
{
    use Model; // Use the Model trait

    protected $table = 'reservation'; // Define the table name

    // Retrieve reservations with related information for a specific user
    public function getReservations($userID)
    {
        $query = "
            SELECT 
                R.ReservationID,
                M.MovieID,
                M.Title,
                M.Price,
                R.UserID,
                R.PaymentStatus
            FROM 
                reservation R
            JOIN 
                showtime S ON R.ShowtimeID = S.ShowtimeID
            JOIN 
                movie M ON S.MovieID = M.MovieID
            WHERE 
                R.UserID = $userID AND
                R.PaymentStatus = 'Unpaid'
            ORDER BY R.ReservationID DESC
                LIMIT 1;
        ";
        
        return $this->query($query);
    }

    public function getReservationID($userID)
    {
        $query = "
        SELECT 
            R.ReservationID,
            M.MovieID,
            M.Title,
            M.Price,
            R.UserID,
            R.PaymentStatus
        FROM 
            reservation R
        JOIN 
            showtime S ON R.ShowtimeID = S.ShowtimeID
        JOIN 
            movie M ON S.MovieID = M.MovieID
        WHERE 
            R.UserID = $userID AND
            R.PaymentStatus = 'Unpaid'
        ORDER BY R.ReservationID DESC;
        ";
        
        return $this->query($query);
    }
    
    public function updatePaymentStatus($reservationID, $userID)
    {
        $query = "UPDATE reservation SET PaymentStatus='Paid' WHERE ReservationID= $reservationID AND UserID= $userID AND PaymentStatus='Unpaid'";
        
        // Execute the query
        return $this->query($query);
    }
    // Optional: Add custom methods specific to the reservation model
}

?>
