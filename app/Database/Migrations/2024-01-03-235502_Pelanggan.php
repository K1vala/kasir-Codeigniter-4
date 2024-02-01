<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'PelangganID'=> [
                'type'=> 'INT',
                'constraint'=> 11,
                'auto_increment'=> true,
            ],
            'NamaPelanggan'=> [
                'type'=> 'VARCHAR',
                'constraint'=> '255',
            ],
            'Alamat'=> [
                'type'=> 'TEXT'
            ],
            'NomorTelepon'=> [
                'type'=> 'VARCHAR',
                'constraint'=> '15'
            ],
        ]);
        $this->forge->addKey('PelangganID', true);
        $this->forge->createTable('pelanggan');
    }

    public function down()
    {
        //
        $this->forge->dropTable('pelanggan');
    }
}
