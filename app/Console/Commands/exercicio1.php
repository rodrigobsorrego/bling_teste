<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use phpDocumentor\Reflection\Types\Integer;

class exercicio1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exercicio1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exercicio 1';

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
     * Rotacionar o Array para Esquerda.
     *
     * @return array
     */
    private function rotate_left(Array $array, $rot, $el) {
        for ($i = 0; $i < $rot; $i++) {
            $pe = $array[0]; //primeiro elemento
            foreach ($array as $key => $value) {
                if ($key < ($el-1)) {
                    $array[$key] = $array[$key + 1];
                }
                else {
                    $array[$key] = $pe;
                }
            }
        }

        return $array;
    }

    /**
     * Rotacionar o Array para Direita.
     *
     * @return array
     */
    private function rotate_right(Array $array, $rot, $el) {
        for ($i = 0; $i < $rot; $i++) {
            $ue = $array[($el-1)]; //ultimo elemento
            for ($j = ($el-1); $j >= 0; $j--) {
                if ($j > 0) {
                    $array[$j] = $array[$j - 1];
                }
                else {
                    $array[$j] = $ue;
                }
            }
        }

        return $array;
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
         * Escrever um algoritmo que rotacione um array em k posições. Exemplo: o array
         * [1,2,3,4,5,6] se for girado duas posições para a esquerda se torna [3,4,5,6,1,2]. Tente
         * resolver sem usar uma cópia da array.
         *
         ******************************************************************************************/

        //quantos elementos tem o array?
        $el = $this->ask('Quantos elementos vai ter o array?');

        //gerar elementos do array?
        $array = [];
        for ($i = 0; $i < $el; $i++) {
            //perguntar?
            //$array[] = $this->ask('Qual é o '.($i+1).'o. elemento?');

            //gerar automatico?
            //$array[] = rand(1, 99); //se quiser gerar aleatório
            $array[] = $i+1;
        }

        //perguntar quantas posições vai rotacionar?
        $rot = $this->ask('Quantas vezes vai rotacionar?');

        //original:
        //array original foi salvo para fazer as duas rotações,
        //mas nao é utilizado como cópia para a operação de rotação como pede o enunciado
        $original = $array;

        //rotacionar para esquerda
        $array = $this->rotate_left($array, $rot, $el);

        //mostrar na tela
        $this->info('O ARRAY ROTACIONADO PARA ESQUERDA '.$rot.' VEZES FICOU: ');
        print_r($array);

        //recuperar o array original para rotacionar para direita
        $array = $original;

        //rotacionar para direita
        $array = $this->rotate_right($array, $rot, $el);

        //mostrar na tela
        $this->info('O ARRAY ROTACIONADO PARA DIREITA '.$rot.' VEZES FICOU: ');
        print_r($array);

    }
}
