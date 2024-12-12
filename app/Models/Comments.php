<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Comments extends Model
{
    use SoftDeletes;
    protected $fillable=['text', 'user_id', 'post_id'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
