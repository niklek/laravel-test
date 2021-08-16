<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use App\Repositories\TransactionRepositoryInterface;

class TransactionService
{
    protected $transactionRepository;

    /**
     * @param $transactionRepository
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Get all transactions
     * 
     * @return Collection
     * @throws \InvalidArgumentException
     */
    public function getAll()
    {
        return $this->transactionRepository->all();
    }
}