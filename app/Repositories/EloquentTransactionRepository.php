<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentTransactionRepository implements TransactionRepositoryInterface
{
    /**
     * @var Transaction
     */
    protected $model;

    /**
     * @param Transaction $model
     */
    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    /**
     * Get all transactions
     * 
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->get();
    }
}