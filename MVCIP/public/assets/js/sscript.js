// Assuming you're using jQuery for simplicity

$(document).ready(function() {
    $('.seat').click(function() {
        var seatId = $(this).text();
        console.log('Selected seat ID: ' + seatId);
        // You can display the seat ID wherever you want, for example in an alert or on the page
        alert('Selected seat ID: ' + seatId);

        // You can also store the selected seat ID in a hidden input field for form submission
        $('#selectedSeats').val(seatId);
    });
});
