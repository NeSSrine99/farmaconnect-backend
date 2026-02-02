<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\ClerkService;

class ClerkAuthMiddleware
{
    public function __construct(
        protected ClerkService $clerk
    ) {}

    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token missing'], 401);
        }

        try {
            //  Verify token
            $decoded = $this->clerk->verifyToken($token);

            //  Fetch Clerk user
            $clerkUser = $this->clerk->fetchClerkUser($decoded->sub);

            //  Sync DB user
            $user = $this->clerk->syncUser($clerkUser);

            //  Attach user to request
            $request->setUserResolver(fn () => $user);
            $request->merge(['auth_user' => $user]);

            return $next($request);

        } catch (\Throwable $e) {
            return response()->json([
                'error'   => 'Invalid or expired token',
                'message' => $e->getMessage(),
            ], 401);
        }

    }
    
}
