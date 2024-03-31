<?php

namespace App\Core\Http;

interface RedirectInterface
{
    public function to(string $url);
}
