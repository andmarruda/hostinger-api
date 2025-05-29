<?php
namespace Hostinger\Services;

use Hostinger\Services\Traits\VM;

class Hostinger {
    use VM;

    /**
     * Hostinger token
     * 
     * @var string
     */
    private string $token;

    /**
     * Constructs the class passing the token to the private property
     * 
     * @param string $token
     * @return void
     */
    public function __construct(string $token) {
        $this->token = $token;
    }
}
