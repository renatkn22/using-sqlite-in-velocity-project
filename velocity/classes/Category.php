<?php
declare(strict_types=1);

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../interfaces/Publishable.php';
require_once 'BlogPost.php';
require_once 'NewsPost.php';

class Category {
    private int $id;
    private string $name;
    private ?int $parentId;

    public function __construct(string $name, ?int $parentId = null) {
        $this->name = $name;
        $this->parentId = $parentId;
        $this->loadOrCreate();
    }

    private function loadOrCreate(): void {
        $db = Database::getConnection();

        // ищем категорию
        $stmt = $db->prepare("SELECT id FROM categories WHERE name = ?");
        $stmt->execute([$this->name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id = (int)$row['id'];
        } else {
            // создаём если нет
            $stmt = $db->prepare("
                INSERT INTO categories (parent_id, name)
                VALUES (?, ?)
            ");
            $stmt->execute([$this->parentId, $this->name]);

            $this->id = (int)$db->lastInsertId();
        }
    }

    public function addPost(Publishable $post): void {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            INSERT INTO posts (category_id, post_type, title, content, author)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $this->id,
            get_class($post),
            $post->getTitle(),
            $post->getContent(),
            $post->getAuthor()
        ]);
    }

    public function getPosts(): array {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            SELECT * FROM posts
            WHERE category_id = ?
            ORDER BY created_at DESC
        ");

        $stmt->execute([$this->id]);

        $posts = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $class = $row['post_type'];

            $posts[] = new $class(
                $row['title'],
                $row['content'],
                $row['author']
            );
        }

        return $posts;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }
}