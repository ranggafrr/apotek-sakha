<?php

namespace App\Http\Controllers;

use App\Services\AprioriService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AprioriController extends Controller
{
    public function analyze(Request $request)
    {
        $apriori = new AprioriService(0.3, 0.6); // bisa disesuaikan
        $frequentItemsets = $apriori->generateFrequentItemsets();
        $groupedItemsets = $apriori->groupItemsetsBySize($frequentItemsets);
        $associationRules = $apriori->generateAssociationRules($frequentItemsets);

        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Apriori', 'url' => null],
        ];
        return view('apps.apriori.view-data', [
            "menu" => "Apriori",
            "page" => 'Apriori',
            'itemset1' => $groupedItemsets[1] ?? [],
            'itemset2' => collect($groupedItemsets)->except(1)->flatten(1)->values(),
            'rules' => $associationRules,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
