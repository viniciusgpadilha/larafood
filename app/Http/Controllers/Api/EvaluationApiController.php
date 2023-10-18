<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EvaluationService;
use App\Http\Requests\Api\StoreEvaluationOrderRequest;
use App\Http\Resources\EvaluationResource;
use Illuminate\Http\Request;

class EvaluationApiController extends Controller
{
    protected $evaluationService;

    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    public function store(StoreEvaluationOrderRequest $request)
    {
        $data = $request->only('stars', 'comment');

        $evaluation = $this->evaluationService->createNewEvaluation($request->identifyOrder, $data);

        return new EvaluationResource($evaluation);
    }
}
