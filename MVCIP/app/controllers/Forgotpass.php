<?php

    class Forgotpass{

        use Controller;
        
        public function index(){

            $users = new User;
            $data = [];

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $arr1['email'] = $_POST['femail'];
                $row = $users->first($arr1);

                if($row){
                    if($_POST['newpassword'] === $_POST['retypepassword']){
                        $arr2['password'] = $_POST['retypepassword'];
                        $users->update($_POST['femail'], $arr2, 'email');
                        redirect('finallogin');
                    }else{
                        $users->errors['newpassword'] = "Passwords do not match. Please try again.";
                    }
                }else{
                    $users->errors['femail'] = "Account doesn't exist.";
                }
                $data['errors'] = $users->errors;
            }


            $this->view('forgotpass', $data);
        }
    }
