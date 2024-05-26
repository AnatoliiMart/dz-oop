<?php

use \Classes\Book;
use \Classes\Member;
use \Classes\Library;

spl_autoload_register(function ($class) {
  require_once "$class.php";
});

$book1 = new Book("Evgeniy Onegin", "Pushkin Aleksandr", "1234567890", 1920);
echo $book1 . '<br><br>';
$book1->setAuthor("Lesia Ukrainka");
echo $book1 . "<br><br>";
$book1->setTitle('Contra spem spero!');
echo $book1 . "<br><br>";
$book1->setYear(2010);
echo $book1 . "<br><br>";

$book2 = new Book("Kobzar", "Taras Shevchenko", "0987654321123", 1980);
echo $book2 . '<br><br>';
// id одинаковые потому что используется timestamp при создании объекта пользователя, 
// и так как код выполняется слишком быстро, timestamp будет одинаковым 
// в связи с этим в классе Member я добавляю random_int(1, PHP_INT_MAX) к timestamp
$member1 = new Member("Ivan Ivanov");
$member2 = new Member("Petr Petrov");

$library = Library::getInstance();

$library->addBook($book1);

$library->addBook($book2);

$library->registerMember($member1);

$library->registerMember($member2);

$library->lendBook($book1, $member1);

$library->lendBook($book2, $member2);

$library->receiveBook($book1, $member1);

$library->receiveBook($book2, $member2);
