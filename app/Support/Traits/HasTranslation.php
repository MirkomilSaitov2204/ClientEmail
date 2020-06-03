<?php

namespace App\Support\Traits;

trait HasTranslation
{
    /**
     * Check if model has translatable keys
     *
     * @return bool
     */
    public function hasTranslatable()
    {
        return property_exists($this, 'translatable');
    }

    /**
     * Check if key is translatable
     *
     * @param string $key
     * @return bool
     */
    public function isTranslatable(string $key): bool
    {
        if(! $this->hasTranslatable()) {
            return false;
        }

        return in_array($key, $this->translatable);
    }

    /**
     * Get translatable key
     *
     * @param string $key
     * @return mixed
     */
    protected function getTranslatable(string $key = null)
    {
        if(! $this->hasTranslatable()) {
            return [];
        }

        if(is_null($key)) {
            return $this->translatable;
        }

        return $this->isTranslatable($key)
            ? $this->translatable[$key]
            : null;
    }

    /**
     * Translate key
     *
     * @param string $key
     * @param string $locale
     * @return mixed
     */
    public function translate(string $key, string $locale = null)
    {
        $key = $this->getAttributeValue($key);

        if(! is_array($key)) {
            return $key;
        }

        if(! is_null($locale)) {
            return data_get($key, $locale);
        }

        return data_get($key, config('app.locale'));
    }

    /**
     * Get all attribute translations
     *
     * @param string $key
     * @return mixed
     */
    public function getTranslations(string $key)
    {
        return $this->getAttributeValue($key);
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if($this->isTranslatable($key)) {
            return $this->translate($key);
        }

        return parent::getAttribute($key);
    }

    /**
     * Get the casts array.
     *
     * @return array
     */
    public function getCasts(): array
    {
        return array_merge(
            parent::getCasts(),
            array_fill_keys($this->getTranslatable(), 'array')
        );
    }
}
