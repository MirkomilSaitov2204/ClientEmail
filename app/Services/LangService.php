<?php

namespace App\Services;

use Illuminate\Session\Store;

class LangService
{
    /**
     * Currency key in session
     *
     * @var string
     */
    const KEY = 'lang';

    /**
     * @var \Illuminate\Session\Store
     */
    protected $session;

    /**
     * @param \Illuminate\Session\Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Check if user has lang code
     *
     * @return mixed
     */
    public function hasCode()
    {
        return $this->session->has(self::KEY);
    }

    /**
     * Get user lang code
     *
     * @return mixed
     */
    public function getCode()
    {
        return $this->session->get(self::KEY);
    }

    /**
     * Set user lang
     *
     * @param string $code
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->session->put(self::KEY, $code);

        return $this;
    }
}
