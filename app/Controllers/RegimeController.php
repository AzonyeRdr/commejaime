<?php

namespace App\Controllers;

use App\Models\IngredientRegime;
use App\Models\Regime;

class RegimeController extends BaseController
{
    public function detail($regimeId = null)
    {
        $regimeModel = new Regime();

        $regime = $regimeModel
            ->where('id', $regimeId)
            ->first();

        if (!$regime) {
            return redirect()->back();
        }

        $viewModel = new IngredientRegime();

        $ingredients = $viewModel
            ->where('regimeId', $regimeId)
            ->findAll();

        $prixTotal = 0;

        foreach ($ingredients as &$ingredient) {

            $poidsIngredient =
                ($ingredient['pourcentage'] / 100)
                * $ingredient['poidsTotalPlat'];

            $cout =
                $poidsIngredient
                * $ingredient['prixG'];

            $ingredient['poidsIngredient'] = $poidsIngredient;
            $ingredient['cout'] = $cout;

            $prixTotal += $cout;
        }

        return view('regime/detail', [
            'regime' => $regime,
            'ingredients' => $ingredients,
            'prixTotal' => $prixTotal
        ]);
    }
}