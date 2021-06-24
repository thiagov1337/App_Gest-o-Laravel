<?php

use Illuminate\Database\Seeder;
use App\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // instanciando 
        $fornecedor = new Fornecedor();
        $fornecedor->name = 'fornecedor 100';
        $fornecedor->site = '100.com.br';
        $fornecedor->uf = 'SP';
        $fornecedor->email = '100.com.br';
        $fornecedor->save();

        //create -> fillable
        Fornecedor::create([
            'name' => 'fornecedor 200',
            'site' => '200.com.br',
            'uf' => 'SP',
            'email' => '200.com.br'
        ]);
        
        //insert
        DB::table('Fornecedores')->insert([
            'name' => 'fornecedor 300',
            'site' => '300.com.br',
            'uf' => 'SP',
            'email' => '300.com.br'
        ]);
    }
}
