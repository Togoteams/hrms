<?php

namespace App\Services\ApiKey;

use App\Repositories\ApiKey\ApiKeyRepository;

class ApiKeyService
{
    /**
     * @var ApiKeyRepository
     */
    protected $apiKeyRepository;

    /**
     * ApiKey constructor
     */
    public function __construct(ApiKeyRepository $apiKeyRepository)
    {
        $this->apiKeyRepository = $apiKeyRepository;
    }
    public function listApiKeys(array $filterConditions, string $orderBy = 'id', $sortBy = 'asc', $limit = null, $inRandomOrder = false)
    {
        return $this->apiKeyRepository->listApiKeys($filterConditions, $orderBy, $sortBy, $limit);
    }

    public function findApiKeyById($id)
    {
        return $this->apiKeyRepository->find($id);
    }

    public function createOrUpdateApiKey(array $attributes, $id = null)
    {
        // return $attributes;
        if (is_null($id)) {
            return $this->apiKeyRepository->createApiKey($attributes);
        } else {
            return $this->apiKeyRepository->updateApiKey($attributes, $id);
        }
    }
    public function updateApiKeystatus($attributes, $id)
    {
        $attributes['status'] = $attributes['value'] == '1' ? 1 : 0;
        return $this->apiKeyRepository->update($attributes, $id);
    }

    public function deleteApiKey(int $id)
    {
        return $this->apiKeyRepository->deleteApiKey($id);
    }
}
