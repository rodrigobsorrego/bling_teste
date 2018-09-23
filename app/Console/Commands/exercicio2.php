<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class exercicio2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exercicio2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exercicio 2';

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
     * Bubble Sort.
     *
     * @return array
     */
    private function bubblesort(Array $array, $el) {
        for ($i = 0; $i < ($el - 1); $i++) {
            for ($j = 0; $j < ($el - 1); $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    $aux = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $aux;
                }
            }
        }

        return $array;
    }

    /**
     * Checa se número é ímpar.
     *
     * @return bool
     */
    private function impar($val) {
        if(($val % 2) == 0){
            return false;
        }
        return true;
    }

    /**
     * Move valor do array pra uma posição.
     *
     * @return bool
     */
    private function shift_to_position($array, $key, $pos) {
        for ($j = $key; $j < $pos; $j++) {
            $aux = $array[$j];
            $array[$j] = $array[$j + 1];
            $array[$j + 1] = $aux;
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
         * Criar um algoritmo que leia um vetor de números e reordene este vetor contendo no início os
         * números pares de forma crescente e depois, os ímpares de forma decrescente.
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
            $array[] = rand(1, 99); //se quiser gerar aleatório
            //$array[] = $i+1;
        }

        //mostrar na tela
        $this->info('O ARRAY ANTES DE REORDENAR É: ');
        print_r($array);

        //ordenar array em ordem crescente
        $array = $this->bubblesort($array, $el);

        //jogar os numeros ímpares para o final do array
        $pos = ($el - 1); //pega ultima posição do array
        for ($key = 0; $key < ($el - 1); $key++) {
            if ($this->impar($array[$key]) && $pos >= 0) {
                $array = $this->shift_to_position($array, $key, $pos);
                $pos--; //saber em que posição do array vai ser colocado o numero ímpar
                $key = -1; //fazer o for voltar pro começo do array
            }
        }

        //mostrar na tela
        $this->info('O ARRAY REORDENADO FICOU: ');
        print_r($array);

    }
}
