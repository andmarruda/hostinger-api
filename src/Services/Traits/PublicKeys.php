<?php

namespace Hostinger\Services\Traits;

use Illuminate\Support\Facades\Http;

trait PublicKeys
{
    /**
     * List all public keys
     *
     * @return array
     * @throws \Exception
     */
    public function listPublicKeys(): array
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer {$this->token}",
            "Content-Type"  => "application/json",
        ])->get(config('hostinger.url') . "/public-keys");

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception("Failed to list public keys: " . $response->body());
    }

    /**
     * Attach a public key to a virtual machine
     *
     * @param string $vmId
     * @param string $keyData
     * @return array
     * @throws \Exception
     */
    public function attachPublicKey(string $vmId, string $keyData): array
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer {$this->token}",
            "Content-Type"  => "application/json",
        ])->post(config('hostinger.url') . "/virtual-machines/{$vmId}/public-keys", [
            'public_key' => $keyData
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception("Failed to attach public key to VM {$vmId}: " . $response->body());
    }

    /**
     * Delete a public key by ID
     *
     * @param string $keyId
     * @return bool
     */
    public function deletePublicKey(string $keyId): bool
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer {$this->token}",
            "Content-Type"  => "application/json",
        ])->delete(config('hostinger.url') . "/public-keys/{$keyId}");

        return $response->successful();
    }

    /**
     * Create a new public key
     *
     * @param string $keyData
     * @return array
     * @throws \Exception
     */
    public function createPublicKey(string $keyData): array
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer {$this->token}",
            "Content-Type"  => "application/json",
        ])->post(config('hostinger.url') . "/public-keys", [
            'public_key' => $keyData
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception("Failed to create public key: " . $response->body());
    }
}
