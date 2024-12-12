<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comments;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Post extends Model
{
    use SoftDeletes;
    protected $fillable=['header','text', 'image_name', 'publishes_on', 'is_published'];
    public function comments(): HasMany
    {
        return $this->hasMany(Comments::class);
    }
}
