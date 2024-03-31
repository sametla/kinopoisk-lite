<?php

namespace App\Core\Session;

interface SessionInterface
{
    public function set(string $key, $value): void;

    public function get(string $key, ?string $default = null);

    public function getFlash(string $key, $default = null);

    public function delete(string $key): void;

    public function has(string $key): bool;

    public function destroy(): void;
}
