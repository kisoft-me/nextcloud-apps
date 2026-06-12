<?php

namespace OCA\Tables\Vendor\Psr\Http\Client;

use OCA\Tables\Vendor\Psr\Http\Message\RequestInterface;
use OCA\Tables\Vendor\Psr\Http\Message\ResponseInterface;
/** @internal */
interface ClientInterface
{
    /**
     * Sends a PSR-7 request and returns a PSR-7 response.
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws \Psr\Http\Client\ClientExceptionInterface If an error happens while processing the request.
     */
    public function sendRequest(RequestInterface $request) : ResponseInterface;
}
