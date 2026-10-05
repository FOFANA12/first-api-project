<?php

namespace App\Http\Repositories;

use App\Models\Post;

final class PostRepository
{
    public function canPublish(int $id): bool
    {
        return $id <= 5;
    }
}
