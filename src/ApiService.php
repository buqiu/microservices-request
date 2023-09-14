<?php

namespace Buqiu\MicroservicesRequest;

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiService
{
    protected string $endpoint;
    protected array $headers;

    private function _request(string $method, string $path, mixed $data)
    {
        $response = $this->_getRequest($method, $path, $data);

        if ($response->successful() || $response->clientError()) {
            return $response;
        }

        throw new HttpException($response->status(), $response->body());
    }

    private function _getRequest(string $method, string $path, mixed $data)
    {
        $http = Http::acceptJson();
        $customHeaders = request()->header(default: []);
        unset($customHeaders['content-length'], $customHeaders['content-type']);

        if ('xml' == request()->getContentTypeFormat()) {
            $http->withBody(request()->getContent(), 'application/xml');
        }

        return $http
            ->withHeaders($this->headers + $customHeaders)
            ->$method("{$this->endpoint}/{$path}", $data);
    }

    public function get(string $path, array|string|null $query = null)
    {
        return $this->_request('get', trim($path), $query);
    }

    public function post(string $path, array $data = [])
    {
        return $this->_request('post', trim($path), $data);
    }

    public function patch(string $path, array $data = [])
    {
        return $this->_request('patch', trim($path), $data);
    }

    public function put(string $path, array $data = [])
    {
        return $this->_request('put', trim($path), $data);
    }

    public function delete(string $path, array $data = [])
    {
        return $this->_request('delete', trim($path), $data);
    }
}
