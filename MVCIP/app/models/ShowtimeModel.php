<?php 


/**
 * User class
 */
class ShowtimeModel
{
	
	use Model;

	protected $table = 'showtime';

	public function getShowtimeDetails()
    {
        $query = "
            SELECT 
                S.ShowtimeID,
                M.MovieID,
                M.Title AS MovieTitle,
                M.Duration,
                SC.ScreenName,
                S.StartTime,
                S.EndTime
            FROM Showtime S
            JOIN Movie M ON S.MovieID = M.MovieID
            JOIN Screen SC ON S.ScreenID = SC.ScreenID
        ";

        return $this->query($query);
    }

	    public function findByMovie($movieId, $screenId)
    {
        // Assuming your database structure, adjust accordingly
        $query = "SELECT * FROM showtime WHERE MovieID = $movieId and ScreenID = $screenId";

        return $this->query($query);
    }

        public function getScreen($movieId)
    {
        // Assuming your database structure, adjust accordingly
        $query = "SELECT screenId FROM showtime WHERE MovieID = $movieId;";

        return $this->query($query);
    }

        public function findByMovieID($movieId)
    {
        // Assuming your database structure, adjust accordingly
        $query = "SELECT * FROM showtime WHERE MovieID = $movieId";

        return $this->query($query);
    }
	
}