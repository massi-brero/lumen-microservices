<?php
//
//use \Psr\Http\Message\ResponseInterface;
//use Psr\Http\Message\ServerRequestInterface;
//$first = function (ServerRequestInterface $request,
//                   ResponseInterface $response, callable $next)
//{
//    $request = $request->withAttribute('word', 'hello');
//    $response = $next($request, $response);
//    $response = $response->withHeader('X-App-Environment',
//                                      'development');
//    return $response;
//};
//
//class Second {
//    public function __invoke(ServerRequestInterface $request,
//                             ResponseInterface $response, callable $next)
//    {
//        $response->getBody()->write('word:'.
//                                    $request->getAttribute('word'));
//        $response = $next($request, $response);
//        $response = $response->withStatus(200, 'OK');
//        return $response;
//    }
//}
//
//class MiddlewareHandler {
//    public function __construct()
//    { //this depends the framework and you are using
//        $this->middlewareStack = new Stack;
//        $this->middlewareStack[] = $first;
//        $this->middlewareStack[] = $second;
//        $this->middlewareStack[] = $endfunction;
//    }
//... }
//
//$second = new Second;
//$endfunction = function (
//    ServerRequestInterface $request, ResponseInterface $response)
//{
//    $response->getBody()->write('function reached');
//    return $response;
//};
//
//// error handling in the middleware stack
//try { // Things to do
//}
//catch (\Exception $e)
//{
//// Error happened return
//        $response->withStatus(500);
//}
//
////The response will be sent immediately to the user without ending the entire execution.
