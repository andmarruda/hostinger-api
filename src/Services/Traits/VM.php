<?php

namespace Hostinger\Services\Traits;
use Illuminate\Support\Facades\Http;

trait VM {
    /**
     * Returns a list of virtual machines
     * 
     * @return array
     */
    public function list(): array
    {
        $request = Http::withHeaders([
            "Authorization" => "Bearer {$this->token}",
            "Content-Type" => "application/json"
        ])->get(config('hostinger.url') . "/virtual-machines");

        if ($request->successful()) {
            return $request->json();
        }

        throw new \Exception("Failed to fetch virtual machines: " . $request->body());
    }
}
