<?php

declare(strict_types=1);
namespace App;

use App\Exceptions\MethodNotFound;

class Router
{

    private array $routes= [];

    public function routes(): array
    {
        return $this->routes;
    }

    public function registerRoute(string $requestMethod, string $path, $callable)
    {
        $this->routes[$requestMethod][$path] = $callable;
        return $this;
    }

    public function get(string $path, $callable)
    {
        return $this->registerRoute('get', $path, $callable);
    }

    public function post(string $path, $callable)
    {
        return $this->registerRoute('post', $path, $callable);
    }

    /**
     * @throws MethodNotFound
     */
    public function resolveRoute(string $requestMethod, string $path)
    {

        $path = explode('?',$path)[0];
        $action = $this->routes[$requestMethod][$path] ?? null;

        if (!$action){
            throw new MethodNotFound();
        }

        if (is_callable($action, true)){

            if (is_array($action)){

                [$class, $method] = $action;

                if (class_exists($class)){
                    $class = new $class();

                    if (method_exists($class, $method)){
                        return call_user_func_array([$class, $method], []);
                    }

                    throw new MethodNotFound;
                }

            }

            return call_user_func($action);
        }

        throw new MethodNotFound;
    }

}