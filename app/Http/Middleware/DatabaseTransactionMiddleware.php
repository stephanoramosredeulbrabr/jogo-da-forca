<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class DatabaseTransactionMiddleware
 * @package App\Http\Middleware
 */
class DatabaseTransactionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        DB::beginTransaction();

        try {
            $response = $next($request);
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }

        $response instanceof Response && $response->isSuccessful() ? DB::commit() : DB::rollBack();

        return $response;

    }
}
