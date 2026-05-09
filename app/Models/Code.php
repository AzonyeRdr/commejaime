<?php

namespace App\Models;

use CodeIgniter\Model;

class Code extends Model
{
    protected $table = "code";
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['lib', 'status', 'userId', 'montant'];
}
