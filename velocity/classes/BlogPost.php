<?php
declare(strict_types=1);

require_once 'AbstractPost.php';

class BlogPost extends AbstractPost
{
    public function publish(): string
    {
        return "
        <div class='blog-post-card'>
            <h3>{$this->getTitle()}</h3>
            <p>{$this->getContent()}</p>
            <p><em>Author: {$this->getAuthor()}</em></p>
        </div>
        ";
    }
}
