<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\Language;

class SettingService
{
    /**
     * Language collection
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    protected $languages;

    /**
     * Settings array
     *
     * @var array
     */
    protected $data = [];

    /**
     * @param \App\Models\Language $language
     * @param \App\Models\Setting $setting
     * @throws \Exception
     */
    public function __construct(Language $language, Setting $setting)
    {
        $this->languages = $language->loadFromCache();
        $this->data = $setting->loadFromCache();
    }

    /**
     * Get setting by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        $res = data_get($this->data, $key);

        return $res ?? $default;
    }

    /**
     * Get telecom languages
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLanguages()
    {
        return $this->languages;
    }
}
