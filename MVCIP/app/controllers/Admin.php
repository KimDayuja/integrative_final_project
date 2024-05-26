<?php

class Admin {
    use Controller;

    public function index() {
        $users = new User;
        $data = [];

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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $arr['email'] = $_POST['email'];
            $row = $users->first($arr);

            if ($row) {
                if ($row->Password === $_POST['password']) {
                    if (($row->Role == 'admin') || ($row->Role == 'Admin')) {
                        $_SESSION['admin'] = $row;
                        redirect('admindashboard');
                    } else {
                        $_SESSION['users'] = $row;
                        redirect('movie');
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
