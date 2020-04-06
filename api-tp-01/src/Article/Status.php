<?php

namespace App\Article;

class Status {
    const NOT_PUBLISHED = 0;
    const NOT_FINISHED = 1;
    const PUBLISHED = 2;

    public static function getArticle()
    {
        return [self::NOT_PUBLISHED, self::NOT_FINISHED, self::PUBLISHED];
    }
}