<?php
declare(strict_types=1);

require_once 'classes/Category.php';
require_once 'classes/NewsPost.php';
require_once 'classes/BlogPost.php';

$category = new Category("Tech");

try {
    // стартовые посты
    $category->addPost(new NewsPost("AI News", "New AI released", "Renat"));
    $category->addPost(new BlogPost("My Blog", "I love coding", "Renat"));
    $category->addPost(new BlogPost("Мой пост", "Это мой текст", "Renat"));

    // обработка формы добавления поста
    if ($_SERVER["REQUEST_METHOD"] === "POST" 
        && isset($_POST["title"], $_POST["content"], $_POST["author"])) {

        $newPost = new BlogPost(
            trim($_POST["title"]),
            trim($_POST["content"]),
            trim($_POST["author"])
        );

        $category->addPost($newPost);
    }

} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velocity</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="reset.css">
</head>
<body>
<header class="header">
    <div class="container header__container">
        <h1 class="logo">Velocity</h1>
        <nav class="header__nav">
            <ul>
                <li><a href="#!">More</a></li>
                <li><a href="#!">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="main">

    <!-- Секция welcome -->
    <section class="welcome">
    <div class="containeer">
        <h2 class="welcome__heading">This is Velocity</h2>
        <div class="welcome__links flex-row">
            <!-- Форма регистрации -->
            <form action="handler.php" method="POST" class="welcome__form">
                <input type="text" name="name" placeholder="Your name" required>
                <input type="email" name="email" placeholder="Your email" required>
                <button type="submit" class="link-primary">Sign Up</button>
                <a href="#!" class="link learn-more-btn">Learn More</a>
            </form>
            <!-- Кнопка learn more -->
            
        </div>
    </div>
</section>

    <!-- Секция about -->
    <section class="about common-section">
        <div class="container">
            <div class="title-wrapper">
                <h3 class="title">What we do</h3>
                <p class="subtitle">This is some text inside a div block</p>
            </div>

            <div class="cards-wrapper">
                <div class="card">
                    <img src="img/card-icon1.svg" alt="error">
                    <h4>Graphic Design</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.</p>
                </div>

                <div class="card">
                    <img src="img/card-icon2.svg" alt="error">
                    <h4>Awesome code</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.</p>
                </div>

                <div class="card">
                    <img src="img/card-icon3.svg" alt="error">
                    <h4>Free template</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Секция services -->
    <section class="services common-section common-section--dark">
        <div class="container">
            <div class="title-wrapper">
                <h3 class="title">What we do</h3>
                <p class="subtitle">This is some text inside a div block</p>
            </div>

            <div class="cards-wrapper">
                <div class="card">
                    <img src="img/services1.jpg" alt="error">
                    <h4>Services one</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.</p>
                    <a href="#!" class="link">learn more</a>
                </div>
                <div class="card">
                    <img src="img/services2.jpg" alt="error">
                    <h4>Services two</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.</p>
                    <a href="#!" class="link">learn more</a>
                </div>
            </div>
        </div>
    </section>
    <section class="tab-section common-section">
        <div class="container">
            <div class="title-wrapper">
                <h3 class="title">
                    Tab section</h3>
                <p class="subtitle"> This is some text inside a div block</p>
            </div>
            <!-- Секция tabs-->
<div class="tabs">
    <div class="tabs__nav">
        <button type="button" class="active">Tab button 1</button>
        <button type="button">Tab button 2</button>
        <button type="button">Tab button 3</button>
    </div>

<div class="tabs__item">
    <img src="img/tab1.jpg" alt="error">
    <h4>Some title here</h4>
    <div class="tabs__desc">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.</p>
    </div>
</div>
            </div>
        </div>
    </section>

    <!-- Секция форма добавления поста -->
    <section class="add-post-section common-section">
        <div class="container">
            <h2 class="title">Add a New Post</h2>
            <?php if (!empty($error)): ?>
                <p style="color:red; text-align:center;"><?= $error ?></p>
            <?php endif; ?>
            <form method="POST" class="post-form">
                <input type="text" name="title" placeholder="Title" required class="post-form__input">
                <input type="text" name="content" placeholder="Content" required class="post-form__input">
                <input type="text" name="author" placeholder="Author" required class="post-form__input">
                <button type="submit" class="link-primary post-form__button">Add Post</button>
            </form>
        </div>
    </section>

    <!-- Секция вывод постов -->
    <section class="posts-section common-section">
        <div class="container">
            <h2 class="title">Posts</h2>
            <?php foreach ($category->getPosts() as $post): ?>
                <div class="post-card">
                    <?= $post->publish(); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<footer class="footer">
    <div class="footer__desc">
        <div class="container footer__desc-container">
            <div class="footer__about">
                <h4>About Velocity</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.</p>
            </div>
            <div class="footer__links">
                <h4>Useful links</h4>
                <ul>
                    <li><a href="#!">Phasellus gravida semper nisi</a></li>
                    <li><a href="#!">Suspendisse nisl elit</a></li>
                    <li><a href="#!">Dellentesque habitant morbi</a></li>
                    <li><a href="#!">Etiam sollicitudin ipsum</a></li>
                </ul>
            </div>
            <div class="footer__social">
                <h4>Social</h4>
                <ul>
                    <li><img src="img/icon-tw.svg" alt="Twitter"><a href="#!">Twitter</a></li>
                    <li><img src="img/icon-fb.svg" alt="Facebook"><a href="#!">Facebook</a></li>
                    <li><img src="img/icon-pt.svg" alt="Pinterest"><a href="#!">Pinterest</a></li>
                    <li><img src="img/icon-google.svg" alt="Google"><a href="#!">Google</a></li>
                    <li><img src="img/icon-wb.svg" alt="Webflow"><a href="#!">Webflow</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer___copyright">
        <div class="container">
            <p>Made by MNAU student CS 2\2 Bondar 2026<p>
        </div>
    </div>
</footer>

</body>
</html>