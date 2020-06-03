<?php

use App\Services\SettingService;

if (! function_exists('settings')) {

    /**
     * App settings
     *
     * @param string|null $key
     * @param mixed $default
     * @return App\Services\SettingService|mixed
     * @deprecated Will be removed. Use shop() method instead
     */
    function settings(string $key = null, $default = null)
    {
        if(is_null($key)) {
            return app(SettingService::class);
        }

        return app(SettingService::class)->get($key, $default);
    }
}
if (! function_exists('shop')) {

    /**
     * Get shop data
     *
     * @param string|null $key
     * @param mixed $default
     * @return App\Services\SettingService|mixed
     */
    function shop(string $key = null, $default = null)
    {
        if(is_null($key)) {
            return app(SettingService::class);
        }

        return app(SettingService::class)->get($key, $default);
    }
}
