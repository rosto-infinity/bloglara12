<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Database\Factories\AuthorFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\ActivityLog;
use App\Support\Traits\Searchable;

class Author extends Model
{
    use ActivityLog, HasFactory, Searchable, SoftDeletes;

    protected $table = 'authors';

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return asset("storage/blog/{$this->image}");
        }

        return null;
    }

    protected static function newFactory(): Factory
    {
        return AuthorFactory::new();
    }
}
