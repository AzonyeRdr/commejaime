<?php
namespace App\Models;

use CodeIgniter\Model;

class Regime extends Model{
    protected $table = 'regime';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nomPlat','poidsTotalPlat'];

    protected $validationRules = [
        'nomPlat' => 'required',
    ];
}
?>