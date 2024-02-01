<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailPenjualan extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'DetailID'=> [
                'type'=> 'INT',
                'constraint'=> 11,
                'auto_increment'=> true,

            ],
            'PenjualanID'=> [
                'type'=> 'INT',
                'constraint'=> 11,
                
            ],
            'ProdukID'=> [
                'type'=> 'INT',
                'constraint'=> 11,
            ],
            'JumlahProduk'=> [
                'type'=> 'INT',
                'constraint'=> 11,
            ],
            'Subtotal'=> [
                'type'=> 'DECIMAL',
                'constraint'=> '10,2',
            ]
        ]);
        $this->forge->addKey('DetailID', true);
        $this->forge->createTable('detailpenjualan');
    }

    public function down()
    {
        //
        $this->forge->dropTable('detailpenjualan');
    }
}
