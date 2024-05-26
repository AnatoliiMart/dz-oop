<?php

namespace Classes;

class Library
{
  private static $instance = null;
  private array $members = array();
  private array $books = array();

  // делаем все методы с помощью которых можно каким либо образом получить доступ к объекту - приватными
  private function __construct()
  {
  }
  private function __clone()
  {
  }

  // __sleep() возвращает пустой массив, предотвращая сериализацию объекта.
  public function __sleep()
  {
    return [];
  }
  //  __wakeup() выбрасывает исключение, если попытаться десериализовать объект Singleton, 
  // таким образом, предотвращая его восстановление из сериализованного состояния.
  public function __wakeup()
  {
    throw new \Exception("Serialization error: Singleton object cannot be unserialized");
  }
  public static function getInstance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }
  public function registerMember(Member $member)
  {
    $this->members[] = $member;
    echo $member . " registered successfully <br><br>";
  }
  public function addBook(Book $book)
  {
    $this->books[] = $book;
    echo $book . " added to library successfully <br><br>";
  }
  public function removeBook(Book $book)
  {
    $key = array_search($book, $this->books);
    if ($key !== false) {
      unset($this->books[$key]);
      echo $book . " removed from library successfully <br><br>";
    } else {
      throw new \Exception('Book not found. Nothing to remove');
    }
  }

  public function lendBook(Book $book, Member $member)
  {
    $key = array_search($member, $this->members);
    if ($key !== false) {
      $key = array_search($book, $this->books);
      if ($key !== false) {
        $member->borrowBook($book);
        $this->removeBook($book);
        echo $book . " lent to " . $member . "<br><br>";
      } else {
        throw new \Exception('Book not found in library');
      }
    } else {
      throw new \Exception('Member not found. No one to land a book to');
    }
  }
  public function receiveBook(Book $book, Member $member)
  {
    $key = array_search($member, $this->members);
    if ($key !== false) {
      try {
        $this->addBook($member->returnBook($book));
        echo $book . " received from " . $member . "<br><br>";
      } catch (\Throwable $th) {
        throw $th;
      }
    } else {
      throw new \Exception('Member not found. No one to return a book to');
    }
  }
}
