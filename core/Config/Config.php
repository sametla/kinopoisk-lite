<?php

namespace App\Core\Config;

class Config implements ConfigInterface
{
    public function get(string $key, $default = null): mixed
    {
        [$file, $key] = explode('.', $key);

        $configPath = ROOT."/config/$file.php";

        if (! file_exists($configPath)) {
            return $default;
        }

        $config = include $configPath;

        return $config[$key] ?? $default;
    }
}
