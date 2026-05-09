<?php

namespace App\Models;

use CodeIgniter\Model;

class Programme extends Model
{
    protected $table = "programme";
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nom', 'objId', 'nombreJour', 'poids'];
}
