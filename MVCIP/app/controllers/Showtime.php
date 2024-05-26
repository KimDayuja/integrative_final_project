<?php 

/**
 * Showtime class
 */
/**
 * Showtime class
 */
/**
 * Showtime class
 */
class Showtime
{
    use Controller;

    public function index()
    {

        // Check if user is logged in
        if (!isset($_SESSION['admin'])) {
            // If not logged in as admin, redirect to login page
            redirect('login');
        }

        // Check if the logged-in user has the role of 'admin'
        if ($_SESSION['admin']->Role !== 'admin' && $_SESSION['admin']->Role !== 'Admin') {
            // If role is not 'admin', redirect to unauthorized page or handle as needed
            redirect('unauthorized');
        }

        $showtimeModel = new ShowtimeModel();
        $showtimeDetails = $showtimeModel->getShowtimeDetails();

        $this->view('admin-showtime', ['showtimes' => $showtimeDetails]);
    }

    public function getSeatAvailability()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $showtimeId = $_POST['showtimeId'];

            // Load the Reservation model
            $reservationModel = new Reservation();
            $seatAvailability = $reservationModel->getSeatAvailabilityByShowtime($showtimeId);

            echo json_encode($seatAvailability);
        }
    }
}
