<?php

namespace Classes;

require_once 'traits\Timestampable.php';
class Book
{
  use \Traits\Timestampable;
  private string $title;
  private string $author;
  private string $isbn;

  public function __construct(string $title, string $author, string $isbn, int $year)
  {
    $this->title = $title;
    $this->author = $author;
    $this->isbn = self::validateISBN($isbn) ? $isbn : "0000000000000";
    $this->setCreatedAt(strtotime("$year/01/01"));
  }

  public function getTitle()
  {
    return $this->title;
  }
  public function getAuthor()
  {
    return $this->author;
  }
  public function getISBN()
  {
    return $this->isbn;
  }
  public function getYear()
  {
    return date("Y", $this->getCreatedAt());
  }
  public function setAuthor($author)
  {
    $this->author = $author;
  }
  public function setTitle($title)
  {
    $this->title = $title;
  }
  public function setISBN($isbn)
  {
    $this->isbn = self::validateISBN($isbn) ? $isbn : "0000000000000";
  }
  public function setYear($year)
  {
    $this->setCreatedAt(strtotime("$year/01/01"));
  }

  public function __toString()
  {
    return $this->title . " by " . $this->author . " " . $this->getYear() . "y " . " ISBN: " . $this->isbn;
  }

  private static function validateISBN($isbn)
  {
    $pattern = '/^(?:\d{9}[\dX]|\d{13})$/';

    if (preg_match($pattern, $isbn)) {
      return true;
    } else {
      return false;
    }
  }
}
