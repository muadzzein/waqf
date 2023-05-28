<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaraidController extends Controller
{
    public function calculateFaraidShares(Request $request)
    {
        // Get the deceased person's assets from the request
        $assets = $request->input('assets');

        // Calculate the total value of the estate
        $totalValue = array_sum($assets);

        // Get the eligible heirs from the request
        $heirs = $request->input('heirs');

        // Calculate the shares for each eligible heir
        $shares = [];
        foreach ($heirs as $heir) {
            switch ($heir['relationship']) {
                case 'parent':
                    $shares[$heir['name']] = $totalValue * (1/6);
                    break;
                case 'spouse':
                    $shares[$heir['name']] = $totalValue * (1/8);
                    break;
                case 'son':
                    $sonCount = count(array_filter($heirs, function($h) { return $h['relationship'] === 'son'; }));
                    if ($sonCount > 1) {
                        $shares[$heir['name']] = $totalValue * (2/3) * (1/($sonCount + 1));
                    } else {
                        $shares[$heir['name']] = $totalValue * (2/3);
                    }
                    break;
                case 'daughter':
                    $daughterCount = count(array_filter($heirs, function($h) { return $h['relationship'] === 'daughter'; }));
                    if ($daughterCount > 1) {
                        $shares[$heir['name']] = $totalValue * (1/3) * (1/($daughterCount + 1));
                    } else {
                        $shares[$heir['name']] = $totalValue * (1/3);
                    }
                    break;
                case 'brother':
                    $brotherCount = count(array_filter($heirs, function($h) { return $h['relationship'] === 'brother'; }));
                    if ($brotherCount > 1) {
                        $shares[$heir['name']] = $totalValue * (1/3) * (1/($brotherCount + 1));
                    } else {
                        $shares[$heir['name']] = $totalValue * (1/3);
                    }
                    break;
            }
        }

        // Deduct any outstanding debts or liabilities from the estate
        $liabilities = $request->input('liabilities');
        $totalLiabilities = array_sum($liabilities);
        $totalValue -= $totalLiabilities;

        // Return the calculated shares to the client
        return response()->json([
            'shares' => $shares,
            'total_value' => $totalValue
        ]);
    }
}
