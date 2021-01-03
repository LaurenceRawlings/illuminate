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

        return Storage::disk($this->thumbnailsDisk())->url($this->thumbnail ? $this->thumbnail : 'app-images/default-thumbnail.png');
    }

    /**
     * Get the disk that thumbnails should be stored on.
     *
     * @return string
     */
    protected function thumbnailsDisk(): string
    {
        return config('app.env') == 'production' ? 's3' : 'public';
    }
}
