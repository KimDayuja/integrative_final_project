<?php
final class MovieModel
{
    use Model;
    private int $id = 0;
     private int $modal_id = 0;
    private string $title = "";
    private string $releaseDate = "";
    private string $rating = "";
    private string $image = "";
    private string $description = "";
    private int $duration = 0;
    private string $Price = "";
    private string $genre = "";

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(): int
    {
        return $this->id;
    }

    public function getModalId(): int
    {
        return $this->modal_id;
    }

    public function setModalId(int $modalId): self
    {
        $this->modal_id = $modalId;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(string $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getRating(): string
    {
        return $this->rating;
    }

    public function setRating(string $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;
        return $this;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): self
    {
        $this->Price = $Price;
        return $this;
    }

}
