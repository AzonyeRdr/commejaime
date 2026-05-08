<?php 
namespace App\Models;

use CodeIgniter\Database\TableName;
use CodeIgniter\Model;
class Sport extends Model{
    protected $table = 'sport';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['exercices'];
}
?>