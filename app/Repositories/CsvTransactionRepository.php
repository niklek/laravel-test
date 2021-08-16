<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use InvalidArgumentException;

class CsvTransactionRepository implements TransactionRepositoryInterface
{
    protected const SOURCE_FILENAME_DEFAULT = 'transactions.csv';

    protected const CSV_DELIMITER_DEFAULT = ',';

    /**
     * @var Transaction
     */
    protected $model;

    protected $filename;

    protected $delimiter;

    /**
     * @param Transaction $model
     * @param string $filename optional filename in storage/app folder, if empty default will be used
     * @param string $delimiter optional, if empty default will be used
     */
    public function __construct(Transaction $model, string $filename = null, string $delimiter = null)
    {
        $this->model = $model;
        $this->filename = $filename ?? static::SOURCE_FILENAME_DEFAULT;
        $this->delimiter = $delimiter ?? static::CSV_DELIMITER_DEFAULT;
    }

    /**
     * Returns all transactions from the source CSV file
     * Note: there is no pagination atm
     * 
     * @return Collection
     * @throws \InvalidArgumentException
     */
    public function all(): Collection
    {
        /**
         * @todo to optimise file read performance we can put raw data into memory
         * - check if the data is in a cache
         * - if not then read from file and put into the cache
         */
        $data = $this->readAllFromFile($this->filename, $this->delimiter);

        return Transaction::hydrate($data);
    }

    /**
     * Reads data from csv file and returns an assoc array
     * 
     * @return array $data
     * @throws \InvalidArgumentException
     */
    protected function readAllFromFile(string $filename, string $delimiter): array
    {
        $filename = storage_path('app/' . $filename);

        if (!file_exists($filename) || !is_readable($filename)) {
            throw new InvalidArgumentException('File not found or not readable');
        }

        $data = [];
        $header = null;
        $fd = fopen($filename, 'r');
        while (($row = fgetcsv($fd, 600, $delimiter)) !== false) {
            if (is_null($header)) {
                $header = $row;
            } else {
                $data[] = array_combine($header, $row);
            }
        }
        fclose($fd);

        return $data;
    }
}