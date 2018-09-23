<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class exercicio5 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exercicio5';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exercício 5';

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
     * Busca pela substring dentro da string
     *
     * @return mixed
     */
    private function busca_string($substr, $string) {
        $i = strlen($substr);
        $M = strlen($substr);
        $j = strlen($string);
        $N = strlen($string);

        for ($i = 0; $i <= ($N - $M); $i++) {
            for ($j = 0; $j < $M; $j++) {
                if (strcmp($string[$i+$j], $substr[$j])) {
                    break;
                }
            }
            if ($j == $M) {
                return $i+1;
            }
        }
        return 0;
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
         * 5. Um algoritmo deve buscar um sub-texto dentro de um texto fornecido. (Não usar funções de
         * busca em string).
         *
         ******************************************************************************************/

        //pegar texto original
        $string = $this->ask('Digite um texto: ');

        //pegar texto a ser buscado
        $substr = $this->ask('Digite o que quer ser buscado no texto: ');

        //resultado da busca
        $res = $this->busca_string($substr, $string);

        //mostrar na tela
        if ($res) {
            //mostrar na tela
            $this->info('O texto '.$substr.' foi encontrado na posição '.$res.' em '.$string);
        }
        else {
            $this->error('Texto não encontrado');
        }

    }
}
