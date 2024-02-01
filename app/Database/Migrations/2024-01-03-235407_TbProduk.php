<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbProduk extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'ProdukID'=> [
                'type'=> 'INT',
                'constraint'=> 11,
                'auto_increment'=> true,
                
            ],
            'NamaProduk'=> [
                'type'=> 'VARCHAR',
                'constraint'=> '255',

            ],
            'Harga'=> [
                'type'=> 'DECIMAL',
                'constraint'=> '10,2',

            ],
            'Stok'=> [
                'type'=> 'INT',
                'constraint'=> 11
            ]
        ]);
        $this->forge->addKey('ProdukID',true);
        $this->forge->createTable('produk');
    }

    public function down()
    {
        //
        $this->forge->dropTable('produk');
    }
}
