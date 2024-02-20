<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e)
    {
        if($e instanceof AuthorizationException)
        return to_route('statistiques');

        if ($e instanceof ModelNotFoundException)
        return response()->view('errors.401', [], 401);

        if ($e instanceof AccessDeniedHttpException)
        return response()->view('Errors.403', [], 403);

        if ($e instanceof NotFoundHttpException)
        return response()->view('Errors.404', [], 404);

        if ($e instanceof MethodNotAllowedHttpException)
        return response()->view('Errors.405', [], 405);

        /* if ($e instanceof HttpException && $this->isHttpException($e))
        return response()->view('errors.500', [], $e->getStatusCode()); */

        return parent::render($request, $e);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
            if(Auth::user()->hasAnyPermission([
                'Gérer les Départements',
                'Gérer les Communes',
                'Gérer les Arrondissements',
                'Gérer les Quartiers',
                'Gérer les Hôtels',
                'Gérer les Types de Chambres',
                'Gérer les Types de Services',
                'Gérer les Moyens de Paiement',
                'Gérer les Rôles',
                'Gérer les Utilisateurs',
                'Gérer les Chambres',
                'Gérer les Réservations',
                'Gérer les Demandes de Services',
            ])){
                return to_route('statistiques');
            }
            else{
                return to_route('clients.hotels.index');
            }
        });
    }
}
