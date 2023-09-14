<?php

namespace Buqiu\MicroservicesRequest;

use Exception;

class MicroservicesHttpService extends ApiService
{
    /**
     * @throws Exception
     */
    public function __construct(string $serviceName = null)
    {
        if (!empty($serviceName)) {
            $this->endpoint = $this->verifyService($serviceName);
        }
    }

    /**
     * @throws Exception
     */
    public function setEndpoint(string $serviceName, array $appendHeaders = []): static
    {
        $this->endpoint = $this->verifyService($serviceName);
        $this->headers = $appendHeaders;

        return $this;
    }

    /**
     * @param string $serviceName
     * @return string
     * @throws Exception
     */
    private function verifyService(string $serviceName): string
    {
        $service = config('microservices.services.'.$serviceName);
        if (is_null($service)) {
            throw new Exception('The specified service was not found.');
        }

        return rtrim($service, '/').'/'.trim(config('microservices.prefix', 'api'), '/');
    }
}