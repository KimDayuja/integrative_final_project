<?php

include (__DIR__ . '/../models/Movie/MovieModel.php');
include (__DIR__ . '/../models/Movie/SearchModel.php');

/**
 * home class
 */
class Movie
{
    use Controller;
    use Database;
    use Model;

    const MINUTES_PER_HOUR = 60;

    public function index()
    {
        // This instance is responsible for rendering the page.
        // DO NOT DELETE!
        // Movie::Movies();
        $this->view('movie');
    }

    private function MovieList($title, $img, $modal_id, $year, $rating, $genre)
    {
        return '<div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex flex-column my-2 card-effect">' // Adjust the column classes
            . '<div class="card primary-color flex-grow-1 shadow w-100 inner-card-effect p-lg-2">' // Remove the width styles
            . '<a data-bs-toggle="modal"><img src="' . APP . '/Images/Images' . $img . '" alt="' . $title . '" style="height: 100%; width: 100%;"></a>' // Set image width to 100% and height to auto
            . '<div class="card-body my-5 primary-color">'
            . '<h5 class="card-title" style="color: white;">' . $title . '</h5>'
            . '<small class="card-title" style="color: white;">' . $genre . '</small>'
            . '</div>'
            . '<ul class="primary-color ">'
            . '<li class="list-group-item primary-color d-flex text-end my-3 " style="color: white; font-size:0.8rem;"><button type="button" class="border-0 rounded-5 shadow-lg browse-button" data-bs-toggle="modal" data-bs-target="#' . $modal_id . '">'
            . '<i class="bi bi-info-circle fs-5"></i>'
            . '</button>'
            . '</li>'
            . '</ul>'
            . '<ul class="primary-color d-flex justify-content-between">'
            . '<li class="list-group-item primary-color" style="color: white; font-size:0.8rem;">' . $year . '</li>'
            . '<li class="list-group-item primary-color d-flex text-end" style="color: white; font-size:0.8rem; margin-right:1rem;">' . $genre . '</li>'
            . '</ul>'
            . '<ul class="primary-color d-flex justify-content-between">'
            . '<li class="list-group-item primary-color" style="color: white; font-size:0.8rem;">Up to IMAX</li>'
            . '<li class="list-group-item primary-color d-flex text-end" style="color: white; font-size:0.8rem; margin-right:0.5rem;">' . number_format($rating, 1) . '<i class="bi bi-star-fill px-2" style="color:#CCC830"></i></li>'
            . '</ul>'
            . '</div>'
            . '</div>';
    }

    private function Modal($modal_id, $title, $movie, $img, $duration)
    {
        return '<div class="modal fade" id="' . $modal_id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">'
            . '<div class="modal-dialog">'
            . '<div class="modal-content" style="background: url(' . APP . '/Images/Images' . $img . ') no-repeat center center; background-size: cover;">'
            . '<div class="modal-header">'
            . '<h1 class="text-white title" id="logo">i<small id="accent" class="fw-bolder">M</small>ovie</h1>'
            . '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: #CCC830;"></button>'
            . '</div>'
            . '<div class="modal-body fs-4" style="color: #CCC830;">' . $title . '</div>'
            . '<div class="modal-body bg-black opacity-75 m-3 rounded" style="color: white;">' . $movie
            . '<p style="color: white;" class=" mt-5 ">Duration: ' . $duration . ' Hours</p>'
            . '<p style="color: white;">Price: ₱99.00</p>'
            . '<p style="color: white;">Schedule: Monday, May 12, 2024</p>'
            . '</div>'
            . '<form action="UserReservations" method="POST">'
            . '<input type="hidden" name="movie_id" value="' . $modal_id . '">'
            . '<button type="submit" id="reserve" name="reserve" class="btn btn-primary mt-1 w-100 browse-button shadow-lg fw-semibold ">Reserve</button>'
            . '</form>'
            . '<button type="button" id="return" name="return" class="btn btn-primary mt-1 w-100 browse-button shadow-lg fw-semibold" data-bs-dismiss="modal">Return</button>'
            . '</div>'
            . '</div>'
            . '</div>';
    }

    private function MinutesToHours(int $mins)
    {
        return number_format((float) $mins / self::MINUTES_PER_HOUR, 1);
    }

    // This method will render the movies.
    public function GetMovie()
    {
        $movie = new MovieModel();

        $markup = '';
        $markup .= '<div class="container">';
        $markup .= '<div class="row d-flex align-items-stretch w-100">'; // Change align-items-center to align-items-stretch
        try {
            $this->connect();
            $result = $this->query("SELECT * FROM movie ORDER BY MovieID");

            if ($result == null) {
                echo "<br>";
                echo "Error encountered while fetching movies.";
                echo "</br>";
                return $this->view('movie');
            }
            foreach ($result as $statement) {
                $movie->setModalId($statement->MovieID);
                $movie->setTitle($statement->Title);
                $movie->setReleaseDate($statement->ReleaseDate);
                $movie->setRating($statement->Rating);
                $movie->setImage($statement->Image);
                $movie->setDescription($statement->Description);
                $movie->setGenre($statement->Genre);
                $movie->setDuration($statement->Duration);

                $markup .= $this->MovieList($movie->getTitle(), $movie->getImage(), $movie->getModalId(), $movie->getReleaseDate(), $movie->getRating(), $movie->getGenre());
                $markup .= $this->Modal($movie->getModalId(), $movie->getTitle(), $movie->getDescription(), $movie->getImage(), Movie::MinutesToHours($movie->getDuration()));
            }
            $markup .= '</div>';
            $markup .= '</div>';

            echo $markup;
            // require '../app/Views/Movie.view.php';
        } catch (Exception $e) {
            echo "Something went wrong. We will get back in a moment.\n" . $e->getMessage();
        }
    }

    public function search()
    {
        if (!isset($_POST['searchMovie'])) {
            // Handle the error, e.g., return or throw an exception
            return;
        }
        $search = new SearchModel();
        $search->setMovieName($_POST['searchMovie']);
        $movieModel = new MovieModel();

        $searching = $this->SearchMovie($search->getMovieName());
        foreach ($searching as $movieResult) {
            // Access individual movie fields

            $movieModel->setModalId($movieResult['MovieID']);
            $movieModel->setTitle($movieResult['Title']);
            $movieModel->setReleaseDate($movieResult['ReleaseDate']);
            $movieModel->setRating($movieResult['Rating']);
            $movieModel->setImage($movieResult['Image']);
            $movieModel->setDescription($movieResult['Description']);
            $movieModel->setGenre($movieResult['Genre']);
            $movieModel->setDuration($movieResult['Duration']);
            $movieModel->setPrice($movieResult['Price']);
            // Add more fields as per your database schema
        }

        $markup = '';
        $markup .= '<div class="container">';
        $markup .= '<div class="row d-flex align-items-stretch w-100">'; // Change align-items-center to align-items-stretch
        $markup .= $this->MovieList($movieModel->getTitle(), $movieModel->getImage(), $movieModel->getModalId(), $movieModel->getReleaseDate(), $movieModel->getRating(), $movieModel->getGenre());
        $markup .= $this->Modal($movieModel->getModalId(), $movieModel->getTitle(), $movieModel->getDescription(), $movieModel->getImage(), $movieModel->getDuration());
        $markup .= '</div>';
        $markup .= '</div>';

        echo $markup;
    }


    public function ByCategory()
    {
        if (!isset($_POST['genre'])) {
            // Handle the error, e.g., return or throw an exception
            return;
        }

        $searching = $this->FetchByCategory($_POST['genre']);
        $markup = '';
        $markup .= '<div class="container">';
        $markup .= '<div class="row d-flex align-items-stretch w-100">'; // Change align-items-center to align-items-stretch

        foreach ($searching as $movieResult) {
            // Access individual movie fields
            $movieModel = new MovieModel();
            $movieModel->setModalId($movieResult->MovieID);
            $movieModel->setTitle($movieResult->Title);
            $movieModel->setReleaseDate($movieResult->ReleaseDate);
            $movieModel->setRating($movieResult->Rating);
            $movieModel->setImage($movieResult->Image);
            $movieModel->setDescription($movieResult->Description);
            $movieModel->setGenre($movieResult->Genre);
            $movieModel->setDuration($movieResult->Duration);

            // Add more fields as per your database schema

            // Generate the HTML for each movie inside the loop
            $markup .= $this->MovieList($movieModel->getTitle(), $movieModel->getImage(), $movieModel->getModalId(), $movieModel->getReleaseDate(), $movieModel->getRating(), $movieModel->getGenre());
            $markup .= $this->Modal($movieModel->getModalId(), $movieModel->getTitle(), $movieModel->getDescription(), $movieModel->getImage(), $movieModel->getDuration());
        }

        $markup .= '</div>';
        $markup .= '</div>';

        // Echo out the markup
        echo $markup;
    }

}
if (isset($_POST['reserve'])) {
    // Redirect to reservations.php
    header("Location: UserReservations.php");
    exit();
}
?>