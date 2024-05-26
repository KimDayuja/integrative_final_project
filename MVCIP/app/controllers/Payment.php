    <?php

    class Payment {

        use Controller;

        public function index() {
            // Check if the user is logged in and get the user ID from the session
            
            // if (!isset($_SESSION['user_id'])) {
            //     // Redirect to login page or handle the case where the user is not logged in
            //     header('Location: login.php');
            //     exit;
            // }
            
            $userID = $_SESSION['user_id']; // Assuming the user ID is stored in the session
            
            // Create a Payment model instance
            $paymentModel = new PaymentModel;

            // Fetch reservations for the current user
            $reservations = $paymentModel->getReservations($userID);
            $resID = $paymentModel->getReservationID($userID);
            $reservationIDD = $resID[0]->ReservationID;
            $this->view('payment', ['reservations' => $reservations, 'resID' => $reservationIDD]);

            
        }

        public function processPayment() {
            // Ensure this is a POST request
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get the posted data
                $payEmail = $_POST['payemail'];
                $reservationID = (int) $_POST['reservationID']; 
                $userID = $_SESSION['user_id'];

                $paymentModel = new PaymentModel;

                // Update payment status
                $success = $paymentModel->updatePaymentStatus($reservationID, $userID);

                if (!($success)) {
                    // Payment successful
                    echo "Payment processed successfully.";
                    redirect('Movie');
                } else {
                    // Handle payment failure
                    echo "Failed to process payment.";
                }
            }   
        }
    }

    ?>
