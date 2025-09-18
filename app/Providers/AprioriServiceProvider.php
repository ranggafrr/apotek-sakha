<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AprioriService
{
    protected float $minSupport;
    protected float $minConfidence;
    protected Collection $transactions;
    protected int $transactionCount;

    public function __construct(float $minSupport = 0.5, float $minConfidence = 0.6)
    {
        $this->minSupport = $minSupport;
        $this->minConfidence = $minConfidence;
        $this->transactions = $this->fetchTransactions();
        $this->transactionCount = $this->transactions->count();
    }

    /**
     * Ambil transaksi dan item yang dibeli dalam setiap transaksi
     */
    protected function fetchTransactions(): Collection
    {
        $raw = DB::table('penjualan_barang')
            ->join('transaksi_penjualan', 'transaksi_penjualan.kode_transaksi', '=', 'penjualan_barang.kode_transaksi')
            ->join('master_barang', 'master_barang.kode_barang', '=', 'penjualan_barang.kode_barang')
            ->select('penjualan_barang.kode_transaksi as transaction_id', 'master_barang.nama_barang as item_name')
            ->get()
            ->groupBy('transaction_id');

        //  Ambil hanya array nama barang tiap transaksi
        return $raw->map(fn($items) => $items->pluck('item_name')->unique()->values());
    }

    /**
     * Hitung support count untuk sebuah itemset
     */
    protected function getSupportCount(array $itemset): int
    {
        $count = 0;
        foreach ($this->transactions as $transaction) {
            if (collect($itemset)->diff($transaction)->isEmpty()) {
                $count++;
            }
        }
        return $count;
    }

    /**
     * Buat kombinasi item sebanyak panjang tertentu (tanpa method Collection::combinations)
     */
    protected function generateCombinations($items, $length)
    {
        $results = [];

        $recurse = function ($items, $length, $start = 0, $prefix = []) use (&$results, &$recurse) {
            if ($length === 0) {
                $results[] = $prefix;
                return;
            }

            for ($i = $start; $i <= count($items) - $length; $i++) {
                $recurse($items, $length - 1, $i + 1, array_merge($prefix, [$items[$i]]));
            }
        };

        $recurse(array_values($items->toArray()), $length);
        return $results;
    }

    /**
     * Proses mining frequent itemsets berdasarkan minimum support
     */
    public function generateFrequentItemsets(): array
    {
        $itemsetSize = 1;
        $frequentItemsets = [];

        $allItems = $this->transactions->flatten()->unique()->values();

        do {
            $candidates = $this->generateCombinations($allItems, $itemsetSize);
            $frequents = [];

            foreach ($candidates as $itemset) {
                $support = $this->getSupportCount($itemset) / $this->transactionCount;
                if ($support >= $this->minSupport) {
                    $frequents[] = [
                        'itemset' => $itemset,
                        'support' => round($support, 4)
                    ];
                }
            }

            if (!empty($frequents)) {
                $frequentItemsets = array_merge($frequentItemsets, $frequents);
            }

            $itemsetSize++;
        } while (!empty($frequents));

        return $frequentItemsets;
    }

    /**
     * Generate association rules dari frequent itemsets
     */
     public function generateAssociationRules(): array
     {
         $frequentItemsets = $this->groupFrequentItemsetsBySize($this->generateFrequentItemsets());
         $rules = [];

        //   Mulai dari itemset size 2 ke atas
         for ($k = 2; $k <= count($frequentItemsets); $k++) {
             if (!isset($frequentItemsets[$k])) continue;

             foreach ($frequentItemsets[$k] as $itemsetData) {
                 $itemset = $itemsetData['itemset'];
                 $support = $itemsetData['support'];

                 $subsets = $this->getAllNonEmptySubsets($itemset);

                 foreach ($subsets as $antecedent) {
                     $consequent = array_values(array_diff($itemset, $antecedent));
                     if (empty($consequent)) continue;

                     $antecedentSupport = $this->findSupport($frequentItemsets, $antecedent);
                     $consequentSupport = $this->findSupport($frequentItemsets, $consequent);

                     if ($antecedentSupport > 0 && $consequentSupport > 0) {
                         $confidence = $support / $antecedentSupport;
                         $lift = $confidence / $consequentSupport;

                         if ($confidence >= $this->minConfidence) {
                             $rules[] = [
                                 'rule' => implode(', ', $antecedent) . ' → ' . implode(', ', $consequent),
                                 'support' => round($support, 4),
                                 'confidence' => round($confidence, 4),
                                 'lift' => round($lift, 4),
                             ];
                         }
                     }
                 }
             }
         }

         return $rules;
     }
     protected function getAllNonEmptySubsets(array $itemset): array
     {
         $n = count($itemset);
         $subsets = [];

        //   Loop semua kombinasi dari 1 hingga 2^n - 2 (semua subset non-kosong, dan bukan keseluruhan)
         for ($i = 1; $i < (1 << $n) - 1; $i++) {
             $subset = [];
             for ($j = 0; $j < $n; $j++) {
                 if ($i & (1 << $j)) {
                     $subset[] = $itemset[$j];
                 }
             }
             $subsets[] = $subset;
         }

         return $subsets;
     }

    protected function groupFrequentItemsetsBySize(array $itemsets): array
    {
        return collect($itemsets)
            ->groupBy(fn($set) => count($set['itemset']))
            ->map(fn($group) => $group->values()->all())
            ->toArray();
    }
    protected function findSupport(array $frequentItemsets, array $target): float
    {
        $size = count($target);
        if (!isset($frequentItemsets[$size])) return 0;

        foreach ($frequentItemsets[$size] as $item) {
            if (empty(array_diff($item['itemset'], $target)) && empty(array_diff($target, $item['itemset']))) {
                return $item['support'];
            }
        }

        return 0;
    }


    /**
     * Group itemsets berdasarkan ukuran (untuk tampilan tabel)
     */
    public function groupItemsetsBySize(array $itemsets): array
    {
        return collect($itemsets)
            ->groupBy(fn($set) => count($set['itemset']))
            ->toArray();
    }
}
