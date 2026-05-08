<?php

namespace App\Models;

use CodeIgniter\Model;

class Objectif extends Model
{
    protected $table = "objectif";
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['lib'];
}
