<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class exercicio7 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exercicio7';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exercício 7';

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
     * Encontrar todos os caminhos no grafo.
     *
     * @return array
     */
    private function encontrar_todos_caminhos($grafo, $inicio, $fim, $caminho = []) {
        //coloca inicio no caminho
        $caminho[] = $inicio;

        //se inicio = fim, fim de todos os caminhos
        if (strcmp($inicio, $fim) == 0) {
            return $caminho;
        }

        //se inicio nao faz parte do grafo
        $found = 0;
        foreach($grafo as $key => $value) {
            if (strcmp($key, $inicio) == 0) {
                $found = 1;
                break;
            }
        }
        //nao tem caminho
        if ($found == 0) {
            return [];
        }

        //cria array de caminhos
        $caminhos = [];

        //começa a busca por caminhos a partir de $inicio
        foreach ($grafo[$inicio] as $node => $value) {

            //se $node ainda nao ta em $caminho
            $found = 0;
            foreach ($caminho as $nodec => $valuec) {
                //dump($valuec, $node);
                if (strcmp($node, $valuec) == 0) {
                    $found = 1;
                    break;
                }
            }
            //procura caminho
            if ($found == 0) {
                //dump($caminho);
                $novosCaminhos = $this->encontrar_todos_caminhos($grafo, $node, $fim, $caminho);
                foreach ($novosCaminhos as $novoCaminho => $valuen) {
                    $caminhos[] = $valuen;
                }
            }
        }

        return $caminhos;
    }

    /**
     * Funçãozinha extra só pra deixar a leitura da saída mais agradável de se ver.
     *
     * @return array
     */
    private function formatar_saida($caminhos) {
        $resultado = "";
        foreach ($caminhos as $key => $node) {
            $resultado = $resultado.$node;
            if (strcmp("E", $node) == 0) {
                $resultado = $resultado."-";
            }
        }
        $resultado = explode("-", $resultado);
        $caminhos = [];
        foreach ($resultado as $key => $c) {
            if (strlen($c) > 0) {
                $caminhos[] = $c;
            }
        }
        return $caminhos;
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
         *  Um algoritmo deve armazenar o mapa abaixo e listar os caminhos entre os pontos A e E.
         *
         ******************************************************************************************/

        //o grafo
        $grafo = [
            'A' => ['B' => 7, 'D' => 5],
            'B' => ['A' => 7, 'C' => 8, 'D' => 9, 'E' => 7],
            'C' => ['B' => 8, 'E' => 5],
            'D' => ['A' => 5, 'B' => 9, 'E' => 15, 'F' => 6],
            'E' => ['B' => 7, 'C' => 5, 'D' => 15, 'F' => 8, 'G' => 9],
            'F' => ['D' => 6, 'E' => 8, 'G' => 11],
            'G' => ['E' => 9, 'F' => 11],
        ];

        //encontrar todos os caminhos
        $caminhos = $this->encontrar_todos_caminhos($grafo, 'A', 'E');

        //formatar saida
        $caminhos = $this->formatar_saida($caminhos);

        //mostrar na tela
        $this->info('TODOS OS CAMINHOS ENTRE A E E SÃO: ');
        print_r($caminhos);

    }
}
