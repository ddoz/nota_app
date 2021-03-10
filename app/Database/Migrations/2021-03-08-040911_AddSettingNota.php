<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSettingNota extends Migration
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
            'logo' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'watermark' => [
                'type' => 'TEXT',
                'null' => true
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
        $this->forge->createTable('setting_nota');
    }

    public function down()
    {
        $this->forge->dropTable('setting_nota');
    }
}
