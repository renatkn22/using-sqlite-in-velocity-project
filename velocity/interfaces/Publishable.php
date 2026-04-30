<?php
declare(strict_types=1);

interface Publishable {
    public function publish(): string;
}