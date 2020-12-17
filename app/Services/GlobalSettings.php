<?php


namespace App\Services;


use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

class GlobalSettings
{
    private $settings;

    public function __construct(Collection $settings)
    {
        foreach ($settings as $setting) {
            $this->settings[$setting->key] = $setting->value;
        }
    }

    public function has(string $key)
    {
        return array_key_exists($key, $this->settings);
    }

    public function contains(string $value)
    {
        return in_array($value, $this->settings);
    }

    public function get(string $key)
    {
        return $this->settings[$key];
    }
}
