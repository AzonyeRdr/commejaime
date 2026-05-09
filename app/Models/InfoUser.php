<?php
namespace App\Models;
use CodeIgniter\Model;
class InfoUser extends Model
{
    protected $table = "infouser";
    protected $allowedFields = ['userId','prenom','age','poids','taille'];
}
?>