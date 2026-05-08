<?php
namespace App\Models;
use CodeIgniter\Model;
class InscriptionProgramme extends Model{
    protected $table = 'inscriptionProgramme';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['userId','programmeId','dateInscription'];
}
?>