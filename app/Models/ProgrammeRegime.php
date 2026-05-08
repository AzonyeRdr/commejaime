<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgrammeRegime extends Model
{
    protected $table = "progammeRegime";
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['programmeId', 'regimeId', 'jour'];
}
