<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename'
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function getImageUrl(?int $width = null, ?int $height = null): string
    {
        if ($width === null || $height === null) {
            return Storage::url($this->filename);
        }
        return Storage::url($this->filename) . "?width={$width}&height={$height}";
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($picture) {
            Storage::disk('public')->delete($picture->filename);
        });
    }

    public function delete()
    {
        Storage::disk('public')->delete($this->filename);
        return parent::delete();
    }
}
