<?php declare(strict_types=1);

namespace Club\Music;

/**
 * One music composition
 */
class Composition
{
    /**
     * @var string Composition name
     */
    private $title;

    /**
     * @var Genre
     */
    private $genre;

    /**
     * @param string $title
     * @param Genre $genre
     */
    public function __construct(string $title, Genre $genre)
    {
        $this->title = $title;
        $this->genre = $genre;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return Genre
     */
    public function getGenre(): Genre
    {
        return $this->genre;
    }
}