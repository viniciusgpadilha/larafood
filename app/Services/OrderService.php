<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use Illuminate\Http\Request;

class OrderService 
{
    protected $orderRepository, $tenantRepository, $tableRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository) 
    {
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
    }

    public function createNewOrder(array $order)
    {
        $identify = $this->getIdentifyOrder();
        $total = $this->getTotalOrder([]);
        $status = 'open';
        $tenantId = $this->getTenantIdOrder($order['token_company']);
        $clientId = $this->getClientIdOrder();
        $tableId = $this->getTableIdOrder($order['table']);

        $order = $this->orderRepository->createNewOrder(
            $identify,
            $total,
            $status,
            $tenantId,
            $clientId,
            $tableId
        );
        
    }

    private function getIdentifyOrder($qtyCharacters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        // $specialCharacters = str_shuffle('!@#$%*-');

        // $characters = $smallLetters.$numbers.$specialCharacters;
        $characters = $smallLetters.$numbers;

        $identify = substr(str_shuffle($characters), 0, $qtyCharacters);

        if ($this->orderRepository->getOrderByIdentify($identify)) {
            $this->getIdentifyOrder($qtyCharacters + 1);
        }

        return $identify;
    }

    private function getTotalOrder(array $products): float
    {
        return (float) 90;
    }

    private function getTenantIdOrder(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $tenant->id;
    }

    private function getTableIdOrder(string $uuid = '')
    {
        if ($uuid) {
            $table = $this->tableRepository->getTableByUuid($uuid);

            return $table->id;
        }
        
        return '';
    }

    private function getClientIdOrder()
    {
        return auth()->check() ? auth()->user()->id : '';




    }
}