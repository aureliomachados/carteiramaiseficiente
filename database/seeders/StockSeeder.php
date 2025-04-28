<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stocks = [
            ['codigo' => 'ALOS3', 'nome' => 'ALLOS'],
            ['codigo' => 'ALPA4', 'nome' => 'ALPARGATAS'],
            ['codigo' => 'ABEV3', 'nome' => 'AMBEV S/A'],
            ['codigo' => 'ASAI3', 'nome' => 'ASSAI'],
            ['codigo' => 'AURE3', 'nome' => 'AUREN'],
            ['codigo' => 'AZUL4', 'nome' => 'AZUL'],
            ['codigo' => 'AZZA3', 'nome' => 'AZZAS 2154'],
            ['codigo' => 'B3SA3', 'nome' => 'B3'],
            ['codigo' => 'BBSE3', 'nome' => 'BBSEGURIDADE'],
            ['codigo' => 'BBDC3', 'nome' => 'BRADESCO'],
            ['codigo' => 'BBDC4', 'nome' => 'BRADESCO'],
            ['codigo' => 'BRAP4', 'nome' => 'BRADESPAR'],
            ['codigo' => 'BBAS3', 'nome' => 'BRASIL'],
            ['codigo' => 'BRKM5', 'nome' => 'BRASKEM'],
            ['codigo' => 'BRAV3', 'nome' => 'BRAVA'],
            ['codigo' => 'BRFS3', 'nome' => 'BRF SA'],
            ['codigo' => 'BPAC11', 'nome' => 'BTGP BANCO'],
            ['codigo' => 'CXSE3', 'nome' => 'CAIXA SEGURI'],
            ['codigo' => 'CRFB3', 'nome' => 'CARREFOUR BR'],
            ['codigo' => 'CCRO3', 'nome' => 'CCR SA'],
            ['codigo' => 'CMIG4', 'nome' => 'CEMIG'],
            ['codigo' => 'COGN3', 'nome' => 'COGNA ON'],
            ['codigo' => 'CPLE6', 'nome' => 'COPEL'],
            ['codigo' => 'CSAN3', 'nome' => 'COSAN'],
            ['codigo' => 'CPFE3', 'nome' => 'CPFL ENERGIA'],
            ['codigo' => 'CMIN3', 'nome' => 'CSNMINERACAO'],
            ['codigo' => 'CVCB3', 'nome' => 'CVC BRASIL'],
            ['codigo' => 'CYRE3', 'nome' => 'CYRELA REALT'],
            ['codigo' => 'ELET3', 'nome' => 'ELETROBRAS'],
            ['codigo' => 'ELET6', 'nome' => 'ELETROBRAS'],
            ['codigo' => 'EMBR3', 'nome' => 'EMBRAER'],
            ['codigo' => 'ENGI11', 'nome' => 'ENERGISA'],
            ['codigo' => 'ENEV3', 'nome' => 'ENEVA'],
            ['codigo' => 'EGIE3', 'nome' => 'ENGIE BRASIL'],
            ['codigo' => 'EQTL3', 'nome' => 'EQUATORIAL'],
            ['codigo' => 'EZTC3', 'nome' => 'EZTEC'],
            ['codigo' => 'FLRY3', 'nome' => 'FLEURY'],
            ['codigo' => 'GGBR4', 'nome' => 'GERDAU'],
            ['codigo' => 'GOAU4', 'nome' => 'GERDAU MET'],
            ['codigo' => 'NTCO3', 'nome' => 'GRUPO NATURA'],
            ['codigo' => 'HAPV3', 'nome' => 'HAPVIDA'],
            ['codigo' => 'HYPE3', 'nome' => 'HYPERA'],
            ['codigo' => 'IGTI11', 'nome' => 'IGUATEMI S.A'],
            ['codigo' => 'IRBR3', 'nome' => 'IRBBRASIL RE'],
            ['codigo' => 'ITSA4', 'nome' => 'ITAUSA'],
            ['codigo' => 'ITUB4', 'nome' => 'ITAUUNIBANCO'],
            ['codigo' => 'JBSS3', 'nome' => 'JBS'],
            ['codigo' => 'KLBN11', 'nome' => 'KLABIN S/A'],
            ['codigo' => 'RENT3', 'nome' => 'LOCALIZA'],
            ['codigo' => 'LREN3', 'nome' => 'LOJAS RENNER'],
            ['codigo' => 'LWSA3', 'nome' => 'LWSA'],
            ['codigo' => 'MGLU3', 'nome' => 'MAGAZ LUIZA'],
            ['codigo' => 'MRFG3', 'nome' => 'MARFRIG'],
            ['codigo' => 'BEEF3', 'nome' => 'MINERVA'],
            ['codigo' => 'MRVE3', 'nome' => 'MRV'],
            ['codigo' => 'MULT3', 'nome' => 'MULTIPLAN'],
            ['codigo' => 'PCAR3', 'nome' => 'P.ACUCAR-CBD'],
            ['codigo' => 'PETR3', 'nome' => 'PETROBRAS'],
            ['codigo' => 'PETR4', 'nome' => 'PETROBRAS'],
            ['codigo' => 'RECV3', 'nome' => 'PETRORECSA'],
            ['codigo' => 'PRIO3', 'nome' => 'PETRORIO'],
            ['codigo' => 'PETZ3', 'nome' => 'PETZ'],
            ['codigo' => 'RADL3', 'nome' => 'RAIADROGASIL'],
            ['codigo' => 'RAIZ4', 'nome' => 'RAIZEN'],
            ['codigo' => 'RDOR3', 'nome' => 'REDE D OR'],
            ['codigo' => 'RAIL3', 'nome' => 'RUMO S.A.'],
            ['codigo' => 'SBSP3', 'nome' => 'SABESP'],
            ['codigo' => 'SANB11', 'nome' => 'SANTANDER BR'],
            ['codigo' => 'STBP3', 'nome' => 'SANTOS BRP'],
            ['codigo' => 'SMTO3', 'nome' => 'SAO MARTINHO'],
            ['codigo' => 'CSNA3', 'nome' => 'SID NACIONAL'],
            ['codigo' => 'SLCE3', 'nome' => 'SLC AGRICOLA'],
            ['codigo' => 'SUZB3', 'nome' => 'SUZANO S.A.'],
            ['codigo' => 'TAEE11', 'nome' => 'TAESA'],
            ['codigo' => 'VIVT3', 'nome' => 'TELEF BRASIL'],
            ['codigo' => 'TIMS3', 'nome' => 'TIM'],
            ['codigo' => 'TOTS3', 'nome' => 'TOTVS'],
            ['codigo' => 'TRPL4', 'nome' => 'TRAN PAULIST'],
            ['codigo' => 'UGPA3', 'nome' => 'ULTRAPAR'],
            ['codigo' => 'USIM5', 'nome' => 'USIMINAS'],
            ['codigo' => 'VALE3', 'nome' => 'VALE'],
            ['codigo' => 'VAMO3', 'nome' => 'VAMOS'],
            ['codigo' => 'VBBR3', 'nome' => 'VIBRA'],
            ['codigo' => 'VIVA3', 'nome' => 'VIVARA S.A.'],
            ['codigo' => 'WEGE3', 'nome' => 'WEG'],
            ['codigo' => 'YDUQ3', 'nome' => 'YDUQS PART'],
        ];

        DB::table('stocks')->insert($stocks);
    }
}