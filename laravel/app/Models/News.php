<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/**
 * @package App
 *
 * @property-read $id
 * @property-read $title
 * @property-read $description
 */
class News extends Model
{
    use HasFactory;

    public function newsId()
    {
        return $this->id;
    }

    public function getImageId(): int
    {
        return $this->id % 9 + 1;
    }
}
