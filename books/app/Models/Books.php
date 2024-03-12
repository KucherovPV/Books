<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Author;

class Books extends Model
{
    use HasFactory;
    public function author()
    {
        return $this->belongsTo(Authors::class, 'author_id');
    }

    // Определение связи с издательством
    public function publishingHouse()
    {
        return $this->belongsTo(PublishingHouses::class);
    }

    // Определение связи с жанром
    public function genre()
    {
        return $this->belongsTo(Genres::class);
    }
}
