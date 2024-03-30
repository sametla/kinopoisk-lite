<?php

namespace App\Core\Http;

class Redirect
{
    public function to(string $url)
    {
        header("Location: $url");
        exit;
    }
}
