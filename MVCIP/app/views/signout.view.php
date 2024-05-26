<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .btn-outline-success {
        border-color: #CCC830;
        color: white;
    }
    .btn-outline-success:hover {
        border-color: #CCC830;
        background-color: #CCC830;
        color: white;
    }

</style>
<body style="background-color: #2C3438;">

    <!-- Signout Modal -->
    <div class="modal fade" id="signoutModal" tabindex="-1" aria-labelledby="signoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content"  style="background-color: #2C3438;">
                <div class="modal-header text-white" style="border: none;">
                    <h5 class="modal-title" id="logoutModalLabel">Signed Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body my-4 text-white text-center">
                    Thank you for using our service! You're now signed out. Have a great day!
                </div>
                <div class="modal-footer d-flex justify-content-center" style="border: none;">
                    <form name="signout" method="post">
                        <button type="submit" class="btn btn-lg btn-outline-success" name="gotit">Got it!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#signoutModal').modal('show');
        });
    </script>
</body>
</html>
