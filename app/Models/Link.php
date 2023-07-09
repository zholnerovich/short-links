<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Link
 * @property string $path
 */
class Link extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['url'];

    /**
     * get latest 10 entries
     * @return Collection
     */
    public static function getLatestEntries():Collection
    {
        return Link::orderBy('id', 'desc')->limit(10)->get();
    }

    public static function  getUrlByShortPath(string $path) {
        $link = Link::where('path' , $path)->first();
        if ($link) {
            return $link->url;
        } else {
            return null;
        }
    }

    /**
     * generating a new path from the last path in DB
     * @return void
     */
    public function generatePath(): void
    {
        $last = Link::orderBy('id', 'desc')->first();
        if ($last) {
            $this->path = ++ $last->path;
        } else {
            $this->path = 'a';
        }
    }

    /**
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        self::creating(function (Link $model) {
            $model->generatePath();
        });
    }
}
