<?php
declare(strict_types=1);

// проверяем метод
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // получаем данные
    $name = htmlspecialchars($_POST["name"] ?? '');
    $email = htmlspecialchars($_POST["email"] ?? '');

    // простая проверка
    if (empty($name) || empty($email)) {
        echo "Заполните все поля!";
        exit;
    }

    // можно сохранить в файл
    $data = "Имя: $name | Email: $email\n";
    file_put_contents("data.txt", $data, FILE_APPEND);

    // ответ пользователю
    echo "<h2>Спасибо, $name!</h2>";
    echo "<p>Вы успешно зарегистрировались.</p>";
}