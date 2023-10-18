<?php

namespace App\Services;

use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;

class EvaluationService
{
    protected $evaluationRepository, $orderRepository;

    public function __construct(EvaluationRepositoryInterface $evaluationRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->evaluationRepository = $evaluationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function createNewEvaluation(string $identifyOrder)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->evaluationRepository->getEvaluationsByTenantId($tenant->id);
    }

}
