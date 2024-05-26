<?php

    class Aboutus{

        use Controller;
        
        public function index(){

            if (!isset($_SESSION['users']))
            {
                return Redirect("login");
            }

            $this->view('aboutus');
        }
    }
