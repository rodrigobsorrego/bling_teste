<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class exercicio4 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exercicio4';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exercício 4';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Calcula se o triângulo é possível.
     *
     * @return mixed
     */
    private function triangulo_possivel($a, $b, $c) {
        /******************************************************************************************
         * CONDIÇÃO PARA EXISTÊNCIA DE UM TRIÂNGULO
         * | b - c | < a < b + c
         * | a - c | < b < a + c
         * | a - b | < c < a + b
         ******************************************************************************************/

        $bmenosc = $b - $c;
        $amenosc = $a - $c;
        $amenosb = $a - $b;
        $bmaisc = $b + $c;
        $amaisc = $a + $c;
        $amaisb = $a + $b;

        if (($bmenosc < $a) && ($a < $bmaisc) &&
            ($amenosc < $b) && ($b < $amaisc) &&
            ($amenosb < $c) && ($c < $amaisb)) {
            return true;
        }
        else {
            return false;
        }

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /******************************************************************************************
         *
         * 4. Receba 6 números representando medidas a,b,c,d,e e f e relacionar quantos e quais
         * triângulos é possível formar usando estas medidas. Exemplo [abc], [abd] ....
         *
         ******************************************************************************************/

        //pegar lados
        $medidas = [];
        for($i = 0; $i <= 5; $i++) {
            //escolhendo
            //$medidas[] = $this->ask('Digite a '.($i+1).'a. medida: ');
            //randomico
            $medidas[] = rand(0, 9);
        }

        //mostrar na tela
        $this->info('AS MEDIDAS SELECIONADAS FORAM: ');
        print_r($medidas);

        for ($i = 0; $i <= 5; $i++) {
            for ($j = 0; $j <= 5; $j++) {
                for ($k = 0; $k <= 5; $k++) {
                    if (($i != $j) && ($i != $k) && ($j != $k)) {
                        if($this->triangulo_possivel($i, $j, $k)) {
                            //mostrar na tela
                            $this->info('ESTE TRIÂNGULO É POSSÍVEL: ['.$i.$j.$k.']');
                        }
                    }
                }
            }
        }

    }
}
