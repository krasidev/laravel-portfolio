<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    const IMAGE_PATH = '/images/projects/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order',
        'name',
        'slug',
        'url',
        'image',
        'short_description',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return self::IMAGE_PATH . $this->image;
        }
    }

    public function getImagePathWithTimestampAttribute()
    {
        if ($this->imagePath) {
            return $this->imagePath . '?' . strtotime($this->updated_at);
        }
    }
}
