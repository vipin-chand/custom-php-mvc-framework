<?php

namespace App\Tests;

use App\Exceptions\MethodNotFound;
use App\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    private $router;

    public function setUp() : void
    {
        $this->router = new Router();
    }
    /**
     * @test
     */
    public function it_register_a_route()
    {

        //when we call register method on it
        $this->router->get('home', ['HomeController', 'index']);

        //then assert route is registered
        $expected = [
          'get' => [
            'home' => ['HomeController', 'index']
          ]
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    /**
     * @test
     */
    public function it_can_register_a_post_route()
    {
        //when we call register method on it
        $this->router->post('home', ['HomeController', 'index']);

        //then assert route is registered
        $expected = [
            'post' => [
                'home' => ['HomeController', 'index']
            ]
        ];

        $this->assertEquals($expected, $this->router->routes());
    }

    /**
     * @test
     */
    public function it_test_there_are_no_routes_when_router_is_created()
    {
        $this->assertEmpty($this->router->routes());
    }

    /**
     * @test
     * @dataProvider MethodNotFoundCases
     */
    public function it_throws_method_not_found_exception($requestMethod, $requestUri)
    {

        $user = new Class(){
            public function delete(){
                return true;
            }
        };

        $this->router->get('/users', [get_class($user), 'index']);
        $this->router->post('/users', [get_class($user), 'store']);

        $this->expectException(MethodNotFound::class);
        $this->router->resolveRoute($requestMethod, $requestUri);
    }

    public function MethodNotFoundCases()
    {
        return [
            ['put', '/users'],
            ['post', '/invoices']
        ];
    }

}