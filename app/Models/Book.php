<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Book
 *
 * Represents a Book model in the application.
 *
 * @package App\Models
 */
class Book extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_title',
        'author_name',
        'user_id',
        'book_description',
        'price',
        'cover_image_path',
        'file_path',
        'uuid_column',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid_column' => 'string',
    ];

    /**
     * Get the user that owns the book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Boot method to hook into model events.
     */
    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID before creating a new record
        static::creating(function ($model) {
            $model->uuid_column = Str::uuid();
        });
    }
}
