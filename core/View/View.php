<?php

namespace App\Core\View;

class View
{
    public function page(string $name): void
    {
        include_once ROOT."/views/pages/$name.php";

    }
}
