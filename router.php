
<?php 

// use Psr\Http\Message\ResponseInterface as Response;
// use Psr\Http\Message\ServerRequestInterface as Request;
// use App\Controllers\HomeController;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;


return function(App $app) {
    $app->get('/', HomeController::class . ":home");

    $app->group('/user', function(Group $group){
        // definition des routes
        $group->post("/login", "App\Controllers\UserController:login");
        $group->post("/register", "App\Controllers\UserController:register");
        
    });


    // $app->get('/bob', function (Request $request, Response $response, array $args) {
    //     $response->getBody()->write("Hello bob");
    //     return $response;
    // });
};