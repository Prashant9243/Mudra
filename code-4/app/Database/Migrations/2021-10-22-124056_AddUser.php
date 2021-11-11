<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
                        'blog_id'          => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                                'unsigned'       => true,
                                'auto_increment' => true,
                        ],
                        'blog_title'       => [
                                'type'       => 'VARCHAR',
                                'constraint' => '100',
                        ],
                        'blog_description' => [
                                'type' => 'TEXT',
                                'null' => true,
                        ],
                ]);
                $this->forge->addKey('user_id', true);
                $this->forge->createTable('adduser');
    }

    public function down()
    {
        //
    }
}
