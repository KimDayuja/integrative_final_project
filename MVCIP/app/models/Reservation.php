<?php

/**
 * Reservation model class
 */
class Reservation
{
    use Model; // Use the Model trait

    protected $table = 'reservation'; // Define the table name

    // Optional: Define allowed columns
    protected $allowedColumns = ['UserID', 'ShowtimeID']; // Specify allowed columns for insert

    // Insert reservation into the database
    public function insertReservation($userID, $showtimeID)
    {
        $success = false;
    
        $data = [
                'UserID' => $userID,
                'ShowtimeID' => $showtimeID,
        ];
    
        // Insert the data
        if ($this->insert($data)) {
            $success = true;
        }
    
        return $success;
    }
    
    

    // Optional: Add custom methods specific to the reservation model
}

?>

?>
