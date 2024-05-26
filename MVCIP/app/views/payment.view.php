    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap"
            rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/login/footer.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/payment.css">
    </head>
    <body style="background-image: url('<?= ROOT ?>/assets/css/bglogin.png'); background-repeat: no-repeat; background-color:#0F131E; font-family: Poppins;">

        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5" style="border-radius: 5px;">

                        <p class="title text-center" style="font-size: 35px; color: #ffffff;">Payment</p>
                        
                        <div class="accordion mt-2" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#paypal" aria-expanded="true" aria-controls="collapseOne">
                                        <span>PayPal</span><i class="fab fa-paypal ms-2"></i>
                                    </button>
                                </h2>

                                <div id="paypal" class="accordion-collapse collapse" aria-labelledby="paypalheading" data-bs-parent="#Accordionpaypal">
                                    <div class="accordion-body">
                                        <form class="mt-4" id="paypalform" name="paypalform" method="post" action="Payment/processPayment">
                                            <div class="form-inside pr-4 pl-4">
                                                <div data-mdb-input-init class="form-outline mb-2">
                                                    <input type="email" id="payemail" name="payemail" class="form-control" placeholder="PayPal Email" required="" />
                                                </div>

                                                <div data-mdb-input-init class="form-outline mt-2">
                                                    <p>Amount to be paid: 
                                                    <?php foreach ($reservations as $index => $reservation): ?>
                                                        <b><?= $reservation->Price ?></b>
                                                        <input type="hidden" name="reservationID" id="reservationID" value="<?= $resID ?>">
                                                        <input type="hidden" name="userID" value="<?= $reservation->userID ?>">
                                                        <?php break; // break out of the loop after the first iteration ?>
                                                    <?php endforeach; ?>
                                                    </p>
                                                </div>
                                                <div class="pt-1 mb-5 mt-2 pb-1 text-center">
                                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" style="width: 70%;" name="paypalsubmit" type="submit" id="paypalsubmit">Pay now ></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    </body>
    </html>
