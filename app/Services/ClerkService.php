<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\JWK;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class ClerkService
{
    protected string $issuer;
    protected string $secret;

    public function __construct()
    {
        $this->issuer = config('services.clerk.issuer');
        $this->secret = config('services.clerk.secret');
    }

    /**
     * Verify JWT & return decoded payload
     */
    public function verifyToken(string $token): object
    {
        $jwks = Http::get($this->issuer . '/.well-known/jwks.json')->json();

        if (!isset($jwks['keys'])) {
            throw new \Exception('Invalid JWKS format');
        }

        $decoded = JWT::decode($token, JWK::parseKeySet($jwks));

        if ($decoded->iss !== $this->issuer) {
            throw new \Exception('Invalid token issuer');
        }

        return $decoded;
    }

    /**
     * Fetch full user data from Clerk
     */
    public function fetchClerkUser(string $clerkUserId): array
    {
        $response = Http::withToken($this->secret)
            ->get("https://api.clerk.dev/v1/users/{$clerkUserId}");

        if ($response->failed()) {
            throw new \Exception('Failed fetching user from Clerk');
        }

        return $response->json();
    }

    /**
     * Sync Clerk user with local DB
     */
    public function syncUser(array $clerkUser): User
    {
        return User::firstOrCreate(
            ['clerk_id' => $clerkUser['id']],
            [
                'email'  => $clerkUser['email_addresses'][0]['email_address'] ?? null,
                'name'   => trim(
                    ($clerkUser['first_name'] ?? '') . ' ' .
                        ($clerkUser['last_name'] ?? '')
                ) ?: null,
                'avatar' => $clerkUser['image_url'] ?? null,
                'role'   => $clerkUser['public_metadata']['role'] ?? 'client',
            ]
        );
    }



    /**
     * Extract user data directly from JWT
     */
    public function getUserFromToken(string $token): array
    {
        $decoded = $this->verifyToken($token);
        return $this->fetchClerkUser($decoded->sub);
    }
}
