<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface TransactionRepositoryInterface
{
    public function all(): Collection;
}