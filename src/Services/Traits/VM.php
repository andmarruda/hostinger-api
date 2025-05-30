<?php

namespace Hostinger\Services\Traits;

use Illuminate\Support\Facades\Http;

trait VM
{
    /**
     * Returns a list of virtual machines
     *
     * @return array
     * @throws \Exception
     */
    public function list(): array
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer {$this->token}",
            "Content-Type"  => "application/json",
        ])->get(config('hostinger.url') . "/virtual-machines");

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception("Failed to fetch virtual machines: " . $response->body());
    }

    /**
     * Get a single virtual machine by ID
     *
     * @param string $vmId
     * @return array
     * @throws \Exception
     */
    public function get(string $vmId): array
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer {$this->token}",
            "Content-Type"  => "application/json",
        ])->get(config('hostinger.url') . "/virtual-machines/{$vmId}");

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception("Failed to fetch VM {$vmId}: " . $response->body());
    }

    /**
     * Start a virtual machine
     *
     * @param string $vmId
     * @return bool
     */
    public function start(string $vmId): bool
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer {$this->token}",
            "Content-Type"  => "application/json",
        ])->post(config('hostinger.url') . "/virtual-machines/{$vmId}/actions/start");

        return $response->successful();
    }

    /**
     * Stop a virtual machine
     *
     * @param string $vmId
     * @return bool
     */
    public function stop(string $vmId): bool
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer {$this->token}",
            "Content-Type"  => "application/json",
        ])->post(config('hostinger.url') . "/virtual-machines/{$vmId}/actions/stop");

        return $response->successful();
    }

    /**
     * Restart a virtual machine
     *
     * @param string $vmId
     * @return bool
     */
    public function restart(string $vmId): bool
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer {$this->token}",
            "Content-Type"  => "application/json",
        ])->post(config('hostinger.url') . "/virtual-machines/{$vmId}/actions/restart");

        return $response->successful();
    }

    /**
     * Get metrics for a virtual machine
     *
     * @param string $vmId
     * @return array
     * @throws \Exception
     */
    public function metrics(string $vmId): array
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer {$this->token}",
            "Content-Type"  => "application/json",
        ])->get(config('hostinger.url') . "/virtual-machines/{$vmId}/metrics");

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception("Failed to fetch metrics for VM {$vmId}: " . $response->body());
    }

    /**
     * Get all public keys attached to a virtual machine
     *
     * @param string $vmId
     * @return array
     * @throws \Exception
     */
    public function getAttachedPublicKeys(string $vmId): array
    {
        $response = Http::withHeaders([
            "Authorization" => "Bearer {$this->token}",
            "Content-Type"  => "application/json",
        ])->get(config('hostinger.url') . "/virtual-machines/{$vmId}/public-keys");

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception("Failed to fetch attached public keys for VM {$vmId}: " . $response->body());
    }
}
