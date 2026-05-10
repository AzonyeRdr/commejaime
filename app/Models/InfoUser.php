<?php

namespace App\Models;

use CodeIgniter\Model;

class InfoUser extends Model
{
    protected $table = "infoUser";
    protected $primaryKey = 'id';
    protected $foreignKey = 'userId';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['userId', 'prenom', 'age', 'poids', 'taille'];

    protected $validationRules = [
        'userId' => 'required|is_not_unique[user.id]',
        'prenom' => 'required',
        'age' => 'required|greater_than[12]',
        'poids' => 'required|greater_than[20]',
        'taille' => 'greater_than[99]',
    ];

    protected $validationMessages = [
        'userId' => [
            'required' => 'L\'utilisateur est obligatoire.',
            'is_not_unique' => 'Cet utilisateur n\'existe pas.',
        ],
        'prenom' => [
            'required' => 'Le prénom est obligatoire.',
        ],
        'age' => [
            'required' => 'L\'âge est obligatoire.',
            'greater_than' => 'L\'âge doit être supérieur à 12 ans.',
        ],
        'poids' => [
            'required' => 'Le poids est obligatoire.',
            'greater_than' => 'Le poids doit être supérieur à 20 kg.',
        ],
        'taille' => [
            'greater_than' => 'La taille doit être supérieure à 99 cm.',
        ],
    ];
}
