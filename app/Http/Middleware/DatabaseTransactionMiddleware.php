<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Class DatabaseTransactionMiddleware
 * @package App\Http\Middleware
 */
class DatabaseTransactionMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws Throwable
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
