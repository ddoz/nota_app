<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNota extends Migration
{
	public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'terima_dari' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'nominal' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'tanggal' => [
                'type' => 'datetime',
                'null' => false
            ],
            'user_id' => [
                'type' => 'INT',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('nota');
    }

    public function down()
    {
        $this->forge->dropTable('nota');
    }
}
