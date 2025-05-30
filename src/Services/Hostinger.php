<?php

namespace Hostinger\Services;

use Hostinger\Services\Traits\VM;
use Hostinger\Services\Traits\PublicKeys;

/**
 * Hostinger API client
 */
class Hostinger
{
    // Inclui métodos de Virtual Machines e Public Keys
    use VM;
    use PublicKeys;

    /**
     * API token para autenticação
     *
     * @var string
     */
    private string $token;

    /**
     * Construtor: recebe o token de acesso
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }
}
