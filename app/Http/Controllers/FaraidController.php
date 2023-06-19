<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaraidController extends Controller
{
    public function Index(){
        return view('faraid.calculator');
    }
    public function calculate(Request $request)
    {
        // Get the deceased person's assets from the request
        $assets = $request->input('assets');


        $son = $request->input('son');
        $daughter = $request->input('daughter');
        $father = $request->input('father');
        $mother = $request->input('mother');
        $brother = $request->input('brother');
        $sister = $request->input('sister');
        $spouse = $request->input('spouse');
        $gfather = $request->input('gfather');
        $gmother = $request->input('gmother');
        $gmother_mot = $request->input('gmother_mot');


        // Output doc selector variables
        $son_share_out = null;  // Replace with appropriate selector
        $dau_share_out = null;  // Replace with appropriate selector
        $mother_share_out = null;  // Replace with appropriate selector
        $father_share_out = null;  // Replace with appropriate selector
        $bro_share_out = null;  // Replace with appropriate selector
        $sis_share_out = null;  // Replace with appropriate selector
        $wif_share_out = null;  // Replace with appropriate selector
        $rem_share_out = null;  // Replace with appropriate selector
        $gfather_share_out = null;
        $gmother_share_out = null;
        $gmother_mot_share_out = null;

        // Initialize the shares
        $sons_shares = 0;
        $daughters_shares = 0;
        $mother_share = 0;
        $father_share = 0;
        $brother_share = 0;
        $sister_share = 0;
        $spouse_share = 0;
        $gfather_share = 0;
        $gmother_share = 0;
        $gmother_mot_share = 0;


        $rem_aft_dau_share = 0;
        $rem_aft_wif = 0;
        $rem_share = 0;

            /* PRESCRIBED SHARES COMPUTATION */
            // Determine if there are children's shares
            if ($son > 0) {
                $spouse_share = ($spouse > 0 ? (1 / 8) * $assets : 0);
                $mother_share = ($mother == 1 ? (1 / 6) * $assets : 0);
                $father_share = ($father == 1 ? (1 / 6) * $assets : 0);
                $rem_aft_wif = $assets - $spouse_share - $mother_share - $father_share;

                $sons_shares = $son * (2 * ($rem_aft_wif / (2 * $son + $daughter)));

                $daughters_shares = ($daughter > 0 ? $daughter * ($rem_aft_wif / (2 * $son + $daughter)) : 0);
            }
            else if ($son == 0 && $daughter >= 2) {
                $daughters_shares = 2 * ($assets / 3);

                $rem_aft_dau_share = $assets - $daughters_shares;
                $mother_share = ($mother == 1 ? (1 / 6) * $rem_aft_dau_share : 0);
                $father_share = ($father == 1 ? (1 / 6) * $rem_aft_dau_share : 0);
            }
            else if ($son == 0 && $daughter == 1) {

                $daughters_shares = ($assets / 2);

                $rem_aft_dau_share = $assets - $daughters_shares;
                $mother_share = ($mother == 1 ? (1 / 6) * $rem_aft_dau_share : 0);
                $father_share = ($father == 1 ? (1 / 6) * $rem_aft_dau_share : 0);
            }
            else if ($son == 0 && $daughter == 0 && $father == 1 && $brother == 0 && $sister == 0) {
                $mother_share = ($mother == 1 ? (1 / 3) * $assets : 0);
                $rem_aft_wif = $assets - $mother_share;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $rem_aft_wif : 0);
                $father_share = $assets - ($mother_share + $spouse_share);
            }
            else if ($son == 0 && $daughter == 0 && $father == 0 && $mother == 1 && ($brother + $sister) >= 2) {
                $mother_share = (1 / 6) * $assets;
                $one_third_assets = (1 / 3) * $assets;

                $brother_share = $brother * (2 * ($one_third_assets / (2 * $brother + $sister)));
                $sister_share = $sister * ($one_third_assets / (2 * $brother + $sister));
                $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $half_assets : 0);
                $mother_share += $assets - ($mother_share  + $brother_share + $sister_share + ($spouse_share * $spouse));
            }
            else if ($son == 0 && $daughter == 0 && $father == 0 && $mother == 1 && $brother == 1 && $sister == 0) {
                $mother_share = (1 / 3) * $assets;
                $brother_share = (1 / 6) * $assets;
                $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $half_assets : 0);
                $mother_share += $assets - ($mother_share + $brother_share + ($spouse_share * $spouse));
            }
            else if ($son == 0 && $daughter == 0 && $father == 0 && $mother == 1 && $brother == 0 && $sister == 1) {
                $mother_share = (1 / 3) * $assets;
                $sister_share = (1 / 6) * $assets;
                $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $assets : 0);
                $mother_share += $assets - ($mother_share + $sister_share + ($spouse_share * $spouse));
            }
            else if ($son == 0 && $daughter == 0 && $father == 0 && $mother == 0 && $brother == 0 && $sister == 1) {
                $sister_share = (1 / 2) * $assets;
                $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $half_assets : 0);
            }
            else if ($son == 0 && $daughter == 0 && $father == 0 && $mother == 0 && $brother >= 1 && $sister == 0) {
                $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $half_assets : 0);
                $brother_share = $assets - ($spouse_share * $spouse);
            }
            else if ($son == 0 && $daughter == 0 && $father == 0 && $mother == 0 && $brother == 0 && $sister >= 2) {
                $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $half_assets : 0);
                $rem_aft_wif = $assets - ($spouse_share * $spouse);
                $sister_share = (2 / 3) * $rem_aft_wif;
            }
            else if ($son == 0 && $daughter == 0 && $father == 0 && $mother == 0 && $brother > 0 && $sister > 0) {
                $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $half_assets : 0);
                $rem_aft_wif = $assets - ($spouse_share * $spouse);

                $brother_share = $brother * (2 * ($rem_aft_wif / (2 * $brother + $sister)));
                $sister_share = $sister * ($rem_aft_wif / (2 * $brother + $sister));
            }

            else if ($son == 0 && $daughter == 0 && $father == 0 && $mother == 0 && $brother == 0 && $sister == 0) {
                // $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $assets : 0);
            }
            else if ($son == 0 && $daughter == 0 && $father == 1 && $mother == 1 && ($brother + $sister) >= 2) {
                $mother_share = (1 / 6) * $assets;
                $one_third_assets = (1 / 3) * $assets;
                $brother_share = $brother * (2 * ($one_third_assets / (2 * $brother + $sister)));
                $sister_share = $sister * ($one_third_assets / (2 * $brother + $sister));
                // $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $assets : 0);
                $father_share = $assets - ($mother_share + $brother_share + $sister_share + ($spouse_share * $spouse));
            }
            else if ($son == 0 && $daughter == 0 && $father == 1 && $mother == 1 && $brother == 1 && $sister == 0) {
                $mother_share = (1 / 3) * $assets;
                $brother_share = (1 / 6) * $assets;
                $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $half_assets : 0);
                $father_share = $assets - ($mother_share + $brother_share + ($spouse_share * $spouse));
            }
            else if ($son == 0 && $daughter == 0 && $father == 1 && $mother == 1 && $brother == 0 && $sister == 1) {
                $mother_share = (1 / 3) * $assets;
                $sister_share = (1 / 6) * $assets;
                $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $half_assets : 0);
                $father_share = $assets - ($mother_share + $sister_share + ($spouse_share * $spouse));
            }
            else if ($son == 0 && $daughter == 0 && $father == 1 && $mother == 0 && ($brother + $sister) >= 2) {
                $one_third_assets = (1 / 3) * $assets;
                $brother_share = $brother * (2 * ($one_third_assets / (2 * $brother + $sister)));
                $sister_share = $sister * ($one_third_assets / (2 * $brother + $sister));
                $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $assets : 0);
                $father_share = $assets - ($brother_share + $sister_share + ($spouse_share * $spouse));
            }
            else if ($son == 0 && $daughter == 0 && $father == 1 && $mother == 0 && $brother == 1 && $sister == 0) {
                $brother_share = (1 / 6) * $assets;
                $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $half_assets : 0);
                $father_share = $assets - ($mother_share + $brother_share + ($spouse_share * $spouse));
            }
            else if ($son == 0 && $daughter == 0 && $father == 1 && $mother == 0 && $brother == 0 && $sister == 1) {
                $sister_share = (1 / 6) * $assets;
                $half_assets = $assets / 2;
                $spouse_share = ($spouse > 0 ? (1 / 4) * $half_assets : 0);
                $father_share += $assets - ($sister_share + ($spouse_share * $spouse));
            }
            else if($son == 0 && $daughter == 0 && $father == 0 && $mother == 1 && $brother == 0 && $sister == 0 && $spouse == 0){
                $mother_share = (1/3) * $assets;
            }


        $rem_share = $assets - $sons_shares - $daughters_shares - $mother_share - $father_share - $brother_share - $sister_share - $spouse_share - $gfather_share - $gmother_share - $gmother_mot_share;


        $son_share_out = $sons_shares;
        $dau_share_out = $daughters_shares;
        $mother_share_out = $mother_share;
        $father_share_out = $father_share;
        $bro_share_out = $brother_share;
        $sis_share_out = $sister_share;
        $spo_share_out = $spouse_share;
        $rem_share_out = $rem_share;
        $gfather_share_out = $gfather_share;
        $gmother_share_out = $gmother_share;
        $gmother_mot_share_out = $gmother_mot_share;

        // Return the output shares
        return view('faraid.results',[
            'son_share' => $son_share_out,
            'dau_share' => $dau_share_out,
            'mother_share' => $mother_share_out,
            'father_share' => $father_share_out,
            'bro_share' => $bro_share_out,
            'sis_share' => $sis_share_out,
            'spo_share' => $spo_share_out,
            'gfather_share' => $gfather_share_out,
            'gmother_share' => $gmother_share_out,
            'gmother_mot_share' => $gmother_mot_share_out,
            'rem_share' => $rem_share_out
        ] ) ;
        //return view('faraid.results', compact($mother_share_out, $father_share_out,  $bro_share_out , $sis_share_out, $spo_share_out));
    }




       /* $shares = [];
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
        $assets -= $totalLiabilities;

        // Return the calculated shares to the client
        return response()->json([
            'shares' => $shares,
            'total_value' => $assets,
        ]); */
}
