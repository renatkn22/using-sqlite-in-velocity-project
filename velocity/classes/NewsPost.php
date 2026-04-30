<?php
declare(strict_types=1);

require_once 'AbstractPost.php';

class NewsPost extends AbstractPost
{
    public function publish(): string
    {
        return "
        <div class='news-post-card'>
            <h3>{$this->getTitle()}</h3>
            <p>{$this->getContent()}</p>
            <p><strong>By: {$this->getAuthor()}</strong></p>
        </div>
        ";
    }
}