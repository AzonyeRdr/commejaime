<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgrammeSport extends Model
{
    protected $table = "programmeSport";
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['programmeId', 'sportId', 'jour'];
}
