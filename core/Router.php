<?php 

namespace app\core;

class Router
{
    private array $routes = [];

    public function addRoute(string $method, string $path, string $controller, string $action): void
    {
        $this->routes[] = compact('method', 'path', 'controller', 'action');
    }

    public function dispatch(string $requestMethod, string $requestUri, $container)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['path'] === $requestUri) {
                return $this->handleRoute($route, $container);
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    private function handleRoute(array $route, $container)
    {
        $controller = $container->get($route['controller']);
        $action = $route['action'];

        if (!method_exists($controller, $action)) {
            throw new \Exception("Method $action not found in controller " . $route['controller']);
        }

        $reflectionMethod = new \ReflectionMethod($controller, $action);
        $params = $this->resolveMethodDependencies($reflectionMethod, $container);
        return $reflectionMethod->invokeArgs($controller, $params);
    }

    private function resolveMethodDependencies(\ReflectionMethod $method, $container)
    {
        $params = [];

        foreach ($method->getParameters() as $param) {

            $type = $param->getType();         
                        
            if (!$type) {
                throw new \Exception("The parameter {$param->getName()} does not have a type hint or could not be resolved.");
            }

            $className = $type->getName();
            $params[] = $container->get($className);
        }

        return $params;
    }
}
