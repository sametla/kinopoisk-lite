<?php

namespace App\Core\View;

use App\Core\Exceptions\ViewNotFoundException;
use App\Core\Session\SessionInterface;

class View implements ViewInterface
{
    public function __construct(
        private readonly SessionInterface $session
    ) {
    }

    public function page(string $name): void
    {
        $viewPath = ROOT."/views/pages/$name.php";

        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException("View $name not found");
        }

        extract($this->defaultData());
        include_once $viewPath;
    }

    public function component(string $name): void
    {
        $compPath = ROOT."/views/components/$name.php";
        if (! file_exists($compPath)) {
            throw new ViewNotFoundException("Component $name not found");
        }

        extract([
            'view' => $this,
        ]);
        include_once $compPath;
    }

    private function defaultData(): array
    {
        return [
            'view' => $this,
            'session' => $this->session,
        ];
    }
}
