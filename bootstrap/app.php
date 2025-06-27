<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AdminOrCreatorsMiddleware;
use App\Http\Middleware\CreatorsMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'creators' => CreatorsMiddleware::class,
            'admin_or_creators' => AdminOrCreatorsMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle 404 errors
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Record not found.'
                ], 404);
            }

            return response()->view('errors.404', [], 404);
        });

        // Handle 403 errors
        $exceptions->render(function (AccessDeniedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Access denied.'
                ], 403);
            }

            return response()->view('errors.403', [], 403);
        });

        // Handle general exceptions
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Something went wrong.',
                    'error' => app()->hasDebugModeEnabled() ? $e->getMessage() : 'Internal server error'
                ], 500);
            }
        });
    })->create();
