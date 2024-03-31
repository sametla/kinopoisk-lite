<?php

namespace App\Core\Config;

interface ConfigInterface
{
    public function get(string $key, $default = null): mixed;
}
