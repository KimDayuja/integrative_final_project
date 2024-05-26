<?php

class Customers
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

        $user = new User();
        $arr['Role'] = 'user';
        $result = $user->where($arr);
        //show($result);
        $this->view('admin-customers', ['users' => $result]);

    }

    public function deleteUser()
    {
        // Start output buffering
        ob_start();

        // Check if the request method is POST and if the user ID is set
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
            // Retrieve user ID from the POST data
            $userId = $_POST['userId'];

            // Instantiate the User model
            $user = new User();

            // Attempt to delete the user
            $result = $user->deleteUser($userId, "UserID");

            // Prepare the response
            $response = ['success' => $result];

            // Clear the output buffer
            ob_clean();

            // Set the content type to JSON
            header('Content-Type: application/json');

            // Return the response as JSON
            echo json_encode($response);
            exit; // Terminate script execution
        } else {
            // Clear the output buffer
            ob_clean();

            // Set the content type to JSON
            header('Content-Type: application/json');

            // Handle invalid request
            echo json_encode(['success' => false]); // Add debug statement to verify the response

            exit; // Terminate script execution
        }
    }
}
