<?php
declare(strict_types=1);

require_once 'db.php';

$db = Database::getConnection();

$db->exec("PRAGMA foreign_keys = ON");

$db->exec("
CREATE TABLE IF NOT EXISTS categories (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    parent_id INTEGER NULL,
    name TEXT NOT NULL UNIQUE,

    FOREIGN KEY (parent_id)
        REFERENCES categories(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);
");

$db->exec("
CREATE TABLE IF NOT EXISTS posts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    category_id INTEGER NOT NULL,
    post_type TEXT NOT NULL,
    title TEXT NOT NULL,
    content TEXT NOT NULL,
    author TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (category_id)
        REFERENCES categories(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
");

$db->exec("
CREATE INDEX IF NOT EXISTS idx_posts_category
ON posts(category_id);
");

$db->exec("
CREATE INDEX IF NOT EXISTS idx_posts_created
ON posts(created_at);
");

$db->exec("
CREATE INDEX IF NOT EXISTS idx_categories_parent
ON categories(parent_id);
");

$db->exec("
INSERT OR IGNORE INTO categories (id, name)
VALUES (1, 'Tech');
");

$db->exec("
INSERT OR IGNORE INTO categories (id, name, parent_id)
VALUES (2, 'PHP', 1);
");

$db->exec("
INSERT OR IGNORE INTO categories (id, name, parent_id)
VALUES (3, 'AI', 1);
");

$db->exec("
INSERT OR IGNORE INTO posts (
    category_id,
    post_type,
    title,
    content,
    author
)
VALUES (
    1,
    'NewsPost',
    'AI News',
    'New AI released',
    'Renat'
);
");

$db->exec("
INSERT OR IGNORE INTO posts (
    category_id,
    post_type,
    title,
    content,
    author
)
VALUES (
    2,
    'BlogPost',
    'Learning PHP',
    'PHP is powerful',
    'Renat'
);
");

$db->exec("
INSERT OR IGNORE INTO posts (
    category_id,
    post_type,
    title,
    content,
    author
)
VALUES (
    3,
    'BlogPost',
    'AI Future',
    'AI changes the world',
    'Renat'
);
");

echo "База данных успешно создана!";
