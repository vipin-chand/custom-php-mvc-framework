<?php

namespace App;

class View
{

    private string $path;

    private array $parameters;

    public function __construct(string $path, array $parameters = [])
    {
        $this->path = $path;
        $this->parameters = $parameters;
    }

    public function render()
    {
        ob_start();

        include VIEW_PATH .$this->path . '.php';

        return ob_get_clean();
    }

    public static function make(string $path, array $parameters = [])
    {
        return new static($path, $parameters);
    }

    public function __toString()
    {
        return (string) $this->render();
    }
}