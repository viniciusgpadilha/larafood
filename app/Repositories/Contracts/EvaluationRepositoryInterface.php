<?php

namespace App\Repositories\Contracts;

interface EvaluationRepositoryInterface
{
    public function createNewEvaluation(int $idOrder, int $idClient);
    public function getEvaluationsByOrder(int $idOrder);
    public function getEvaluationsByClient(int $idOrder);
}
