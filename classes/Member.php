<?php

namespace Classes;

use Traits\Timestampable;

class Member
{
  use Timestampable;
  private string $name;
  private int $membershipId;
  private array $booksBorrowed  = array();

  public function __construct(string $name)
  {
    $this->name = $name;
    $this->setCreatedAt(time());
    $this->membershipId = $this->created_at + random_int(1, PHP_INT_MAX);
  }
  public function getName()
  {
    return $this->name;
  }
  public function getMembershipId()
  {
    return $this->membershipId;
  }
  public function getBooksBorrowed()
  {
    return $this->booksBorrowed;
  }
  public function setName(string $name)
  {
    $this->name = $name;
  }
  public function borrowBook(Book $book)
  {
    $this->booksBorrowed[] = $book;
    echo $this->name . " ID:" . $this->membershipId .  " borrowed " . $book . "<br><br>";
  }
  public function returnBook(Book $book)
  {
    $key = array_search($book, $this->booksBorrowed);
    if ($key !== false) {
      return $this->booksBorrowed[$key];
      unset($this->booksBorrowed[$key]);
    } else {
      throw new \Exception("I don't have this book. Can't return it");
    }
  }
  public function __toString()
  {
    return $this->name . "  ID: " . $this->membershipId;
  }
}
