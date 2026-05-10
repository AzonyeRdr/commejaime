<?php

namespace App\Models;

use CodeIgniter\Model;

class IngredientRegime extends Model
{
    protected $table = "v_ingredientRegime";
    protected $allowedFields = ['regimeId', 'ingredient', 'regime', 'pourcentage', 'prixG', 'poidsTotalPlat'];
}
