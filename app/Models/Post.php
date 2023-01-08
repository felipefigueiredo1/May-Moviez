<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'body',
        'user_id',
        'linkImage',
        'rating',
    ];

    protected $with = ['user'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postLikes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'body' => 'required',
            'rating' => 'required',
        ];
    }

    public function feedback()
    {
        return [
            'name.required' => 'O campo titulo não pode ser vazio!',
            'name.body' => 'O campo descrição não pode ser vazio!',
            'name.rating' => 'O campo nota não pode ser vazio!',
        ];
    }
}
