    <?php

    class UserReservations
    {
        use Controller;

        public function index()
        {
            $screenModel = new Screen;
            $screens = $screenModel->findAll();

            $movieId = isset($_POST['movie_id']) ? $_POST['movie_id'] : null;

            $showtimeModel = new ShowtimeModel;
            $showtimes = $showtimeModel->findByMovieID($movieId);

            $movies = new Movie;
            $arr['MovieID'] = $movieId;
            $movie = $movies->where($arr);

            $user_id = $_SESSION['user_id'] ?? null; // Access user_id from session

            $this->view('user-reservations', [
                'screens' => $screens, 
                'MovieID' => $movieId, 
                'showtimes' => $showtimes, 
                'Movie' => $movie, 
                'user_id' => $user_id
            ]);
        }

        public function addReservation()
        {
            header('Content-Type: application/json'); // Set the content type header for JSON
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Validate and sanitize input data
                $user_id = $_SESSION['user_id'] ?? null; // Access user_id from session
                $showtimeId = $_POST['showtimeId'] ?? null; // Get showtimeId from POST data
        
                if (!$user_id) {
                    echo json_encode(['success' => false, 'message' => 'Missing user ID']);
                    return;
                }
        
                if (!$showtimeId) {
                    echo json_encode(['success' => false, 'message' => 'Missing showtime ID']);
                    return;
                }
        
                $arr['UserID'] = $user_id;
                $arr['ShowtimeID'] = $showtimeId;
        
                $reservation = new Reservation;
                if ($reservation->insert($arr)) {
                    // Optionally, you can send a JSON response back to confirm the reservation
                    echo json_encode(['success' => true]);
                    return;
                } else {
                    // Optionally, send an error message
                    echo json_encode(['success' => false, 'message' => 'Failed to reserve seats']);
                    return;
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
                return;
            }
        }
    }

    ?>
