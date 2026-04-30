<?php
declare(strict_types=1);

require_once __DIR__ . '/../interfaces/Publishable.php';

abstract class AbstractPost implements Publishable {
    protected string $title;
    protected string $content;
    protected string $author;

    public function __construct(string $title, string $content, string $author) {
        $this->setTitle($title);
        $this->setContent($content);
        $this->setAuthor($author);
    }

    // Геттеры
    public function getTitle(): string {
        return $this->title;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    // Сеттеры с валидацией
    public function setTitle(string $title): void {
        if (strlen($title) < 3) {
            throw new Exception("Title too short");
        }
        $this->title = $title;
    }

    public function setContent(string $content): void {
        if (empty($content)) {
            throw new Exception("Content cannot be empty");
        }
        $this->content = $content;
    }

    public function setAuthor(string $author): void {
        if (strlen($author) < 2) {
            throw new Exception("Author name too short");
        }
        $this->author = $author;
    }
}