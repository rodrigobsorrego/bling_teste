<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class exercicio6 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exercicio6';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exercício 6';

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
     * Checa se retângulos se sobrepõem
     * (retorna verdadeiro se ocorre sobreposição)
     *
     * @return mixed
     */
    private function tem_sobreposicao($x1i, $y1i, $x1f, $y1f, $x2i, $y2i, $x2f, $y2f) {
        if (($x1i > $x2f) || ($x2i > $x1f)) {
            return false;
        }

        if (($y1i < $y2f) || ($y2i < $y1f)) {
            return false;
        }

        return true;
    }

    /**
     * Calcula área da sobreposição
     *
     * @return mixed
     */
    private function calcula_area($x1i, $y1i, $x1f, $y1f, $x2i, $y2i, $x2f, $y2f) {
        $base = $x1f - $x2i;
        $altura = $y1i - $y2f;

        if ($base < 0) { $base = $base * -1; }
        if ($altura < 0) { $altura = $altura * -1; }

        return ($base * $altura);
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
         * Criar um algoritmo que teste se dois retângulos se sobrepõem em um plano cartesiano e
         * calcule a área do retângulo criado pela sobreposição. Deve receber como entrada dois
         * retângulos formados por pontos, ex: (0,0),(2,2),(2,0),(0,2),(1,0),(1,2),(6,0),(6,2) e gerar uma
         * saída informando a área calculada ou zero se não ocorrer sobreposição.
         *
         ******************************************************************************************/

        //coordenada
        //perguntando
        $x1i = $this->ask('Coordenada Xi (retangulo 1): ');
        //randomico
        //$x1i = rand(0,9);

        //coordenada
        //perguntando
        $y1i = $this->ask('Coordenada Yi (retangulo 1): ');
        //randomico
        //$y1i = rand(0,9);

        //coordenada
        //perguntando
        $x1f = $this->ask('Coordenada Xf (retangulo 1): ');
        //randomico
        //$x1f = rand(0,9);

        //coordenada
        //perguntando
        $y1f = $this->ask('Coordenada Yf (retangulo 1): ');
        //randomico
        //$y1f = rand(0,9);

        //coordenada
        //perguntando
        $x2i = $this->ask('Coordenada Xi (retangulo 2): ');
        //randomico
        //$x2i = rand(0,9);

        //coordenada
        //perguntando
        $y2i = $this->ask('Coordenada Yi (retangulo 2): ');
        //randomico
        //$y2i = rand(0,9);

        //coordenada
        //perguntando
        $x2f = $this->ask('Coordenada Xf (retangulo 2): ');
        //randomico
        //$x2f = rand(0,9);

        //coordenada
        //perguntando
        $y2f = $this->ask('Coordenada Yf (retangulo 2): ');
        //randomico
        //$y2f = rand(0,9);

        if ($this->tem_sobreposicao($x1i, $y1i, $x1f, $y1f, $x2i, $y2i, $x2f, $y2f)) {
            $area = $this->calcula_area($x1i, $y1i, $x1f, $y1f, $x2i, $y2i, $x2f, $y2f);

            //mostrar na tela
            $this->info('Ocorreu sobreposição e a área dela é: '.$area);
        }
        else {
            //mostrar na tela
            $this->info('Não ocorreu sobreposição.');
        }

    }
}
