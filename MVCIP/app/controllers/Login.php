    <?php

    class Login
    {
        use Controller;

        public function index()
        {
            $users = new User;
            $data = [];

            if (isset($_SESSION['users'])) {
                redirect('Movie');
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $arr['Email'] = $_POST['email'];
                $row = $users->first($arr);

                if ($row) {
                    if ($row->Password === $_POST['password']) {
                        if (($row->Role == 'admin') || ($row->Role == 'Admin')) {
                            $_SESSION['admin'] = $row;
                            redirect('admindashboard');
                        } else {
                            $_SESSION['users'] = $row;
                            $_SESSION['user_id'] = $row->UserID; // Set user_id in session
                            redirect('Movie');
                        }
                    } else {
                        $users->errors['password'] = "Incorrect password";
                    }
                } else {
                    $users->errors['email'] = "Account doesn't exist";
                }

                $data['errors'] = $users->errors;
            }

            $this->view('login', $data);
        }
    }
    ?>
