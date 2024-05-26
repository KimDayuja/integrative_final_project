<?php 

/**
 * home class
 */
class Reservations
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

		$reservation = new AdminReservation;
		$arr['PaymentStatus'] = 'Paid';
		$reservations = $reservation->where($arr);
		$this->view('admin-reservations', ['Reservations' => $reservations]);


		// $user = new User();
        // $arr['Role'] = 'user';
        // $result = $user->where($arr);
        // //show($result);
        // $this->view('admin-customers', ['users' => $result]);
	}
	
}
