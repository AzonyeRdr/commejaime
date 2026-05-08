<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['email', 'mdp', 'roleId', 'montant'];

    protected $validationRules = [
        'email' => 'required|valid_email|is_unique[users.email]',
        'mdp' => 'required|min_length[8]',
        'roleId' => 'required',
        'montant' => 'greater_than[-1]',
    ];

    protected $validationMessages = [
        'email' =>
        [
            'required' => 'L\' email est obligatoire.',
            'valid_email' => 'L\'email n\'est pas valide.',
            'is_unique' => 'L\'email est déjà utilisé.'
        ],
        'mdp' => 
        [
            'required' => 'Le mot de passe est obligatoire.',
            'min_length' => 'Le mot de passe doit faire au moins 8 caractères.',
        ],
        'montant' => 
        [
            'required' => 'Le montant doit être positif',
        ],
    ];
}
