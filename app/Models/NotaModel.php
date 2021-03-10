<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class NotaModel extends Model
{
    protected $table = 'nota';
    protected $allowedFields = [
        'judul',
        'terima_dari',
        'nominal',
        'keterangan',
        'tanggal',
        'user_id'
    ];
    protected $updatedField = 'updated_at';

    public function findNotaByUser($id)
    {
        $nota = $this            
            ->where(['user_id' => $id])
            ->findAll();

        if (!$nota) {
            return [];
        };

        return $nota;
    }

    public function findNotaById($id)
    {
        $nota = $this            
            ->where(['id' => $id])
            ->first();

        if (!$nota) {
            return [];
        };

        return $nota;
    }
}