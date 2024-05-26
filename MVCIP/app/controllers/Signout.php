<?php

    class Signout {

        use Controller;

        public function index() {

            if (!isset($_SESSION['users'])) {
                return $this->redirect("login");
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                unset($_SESSION['users']);
                session_destroy(); // It's a good practice to destroy the session
                $this->redirect('login');
            }

            $this->view('signout');
        }

        private function redirect($url) {
            header("Location: $url");
            exit();
        }
    }
?>
