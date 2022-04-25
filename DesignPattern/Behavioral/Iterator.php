<?php

/**
 * 让对象变得可迭代并表现得像对象集合。
 */

class Book
{
    private string $author;

    private string $title;

    public function __construct(string $title, string $author)
    {
        $this->author = $author;
        $this->title = $title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthorAndTitle(): string
    {
        return $this->getTitle() . ' by [' . $this->getAuthor() . ']';
    }
}

class BookList implements \Countable, \Iterator
{
    /**
     * @var Book[]
     */
    private array $books = [];

    private int $currentIndex = 0;

    public function addBook(Book $book)
    {
        $this->books[] = $book;
    }

    public function removeBook(Book $bookToRemove)
    {
        foreach ($this->books as $key => $book) {
            if ($book->getAuthorAndTitle() === $bookToRemove->getAuthorAndTitle()) {
                unset($this->books[$key]);
            }
        }

        $this->books = array_values($this->books);
    }

    public function count(): int
    {
        return count($this->books);
    }

    public function current(): Book
    {
        return $this->books[$this->currentIndex];
    }

    public function key(): int
    {
        return $this->currentIndex;
    }

    public function next()
    {
        ++$this->currentIndex;
    }

    public function rewind()
    {
        $this->currentIndex = 0;
    }

    public function valid(): bool
    {
        return isset($this->books[$this->currentIndex]);
    }
}

$bookList = new BookList();
$bookList->addBook(new Book('Learning PHP Design Patterns', 'William Sanders'));
$bookList->addBook(new Book('Professional Php Design Patterns', 'Aaron Saray'));
$bookList->addBook(new Book('Clean Code', 'Robert C. Martin'));
foreach ($bookList as $book) {
    echo $book->getAuthorAndTitle() . PHP_EOL;
}


$book = new Book('Clean Code', 'Robert C. Martin');
$book2 = new Book('Professional Php Design Patterns', 'Aaron Saray');

$bookList = new BookList();
$bookList->addBook($book);
$bookList->addBook($book2);
$bookList->removeBook($book);

$books = [];
foreach ($bookList as $book) {
    echo $book->getAuthorAndTitle() . PHP_EOL;
}