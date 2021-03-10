<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class SetupModel extends Model
{
    protected $table = 'setting_nota';
    protected $allowedFields = [
        'logo',
        'watermark',
        'user_id'
    ];
    protected $updatedField = 'updated_at';

    public function findSetupByUser($id)
    {
        $setup = $this            
            ->where(['user_id' => $id])
            ->findAll();

        if (!$setup) {
            return [];
        };

        return $setup;
    }
}