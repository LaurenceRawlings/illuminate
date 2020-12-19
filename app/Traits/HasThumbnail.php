<?php


namespace App\Traits;


use App\Helpers\Utils;
use Illuminate\Support\Facades\Storage;

trait HasThumbnail
{
    public function getThumbnailUrlAttribute()
    {
        if (Utils::isValidUrl($this->thumbnail)) {
            return $this->thumbnail;
        }

        return $this->thumbnail
            ? Storage::disk('public')->url($this->thumbnail)
            : '/img/placeholder.png';
    }
}
