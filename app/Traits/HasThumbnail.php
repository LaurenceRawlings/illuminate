<?php


namespace App\Traits;


use App\Helpers\Utils;
use Illuminate\Support\Facades\Storage;

trait HasThumbnail
{
    /**
     * @return string
     */
    public function getThumbnailUrlAttribute(): string
    {
        if (Utils::isValidUrl($this->thumbnail)) {
            return $this->thumbnail;
        }

        return Storage::disk('public')->url($this->thumbnail ? $this->thumbnail : 'app-images/default-thumbnail.png');
    }
}
