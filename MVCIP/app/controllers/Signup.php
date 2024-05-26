<?php

    class Signup{

        use Controller;
        
        public function index(){

            $users = new User;
            $data = [];

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $arr['email'] = $_POST['remail'];
                $row = $users->first($arr);

                if($row){
                    $users->errors['regemail'] = "Account or Email already exist. Try another email.";
                }else{
                    $arr['fname'] = $_POST['fname'];
                    $arr['lname'] = $_POST['lname'];
                    $arr['email'] = $_POST['remail'];
                    $arr['phone'] = $_POST['rmobile'];
                    $arr['password'] = $_POST['rpassword'];
    
                    $users->insert($arr);
    
                    redirect('login');
                }
                $data['errors'] = $users->errors;
            }

            $this->view('signup', $data);
        }
    }
