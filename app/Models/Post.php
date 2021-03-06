<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'create_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function create_by()
    {
        return $this->belongsTo(User::class, 'create_by', 'id');
    }
}
