<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class exercicio3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exercicio3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exercicio 3';

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
     * Checa se o ano é bissexto
     *
     * @return bool
     */
    private function ano_bissexto($ano) {
        return ($ano % 4 == 0) && ($ano % 100 != 0 || $ano % 400 == 0);
    }

    /**
     * Conta quantos anos bissextos tiveram entre o dia 1 do no 1 e o ano dado
     *
     * @return bool
     */
    private function conta_bissextos($ano) {
        return ($ano/4) - ($ano/100) + ($ano/400);
    }

    /**
     * Converte a data para segundos
     *
     * @return bool
     */
    private function data_para_segundos($data) {
        /*
         31536000 = número de segundos em um ano de 365 dias
         86400 = número de segundos em um dia (24 horas)
         3600 = número de segundos em 1 hora (60 minutos)
         60 = número de segundos em 1 minuto (60 segundos)
        */

        //anos
        $total = ($data[2] - 1) * 31536000;

        //meses
        $meses = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        for($mes = 1; $mes < $data[1]; $mes++) {
            $total += $meses[$mes-1] * 86400;
        }

        //dias
        $total += $data[0] * 86400;

        //adicionar segundos vindos dos anos bissextos
        $diasExtras = $this->conta_bissextos($data[2] - 1);
        $total += $diasExtras * 86400;

        //se o ano atual passou de fevereiro e é bissexto...
        if($this->ano_bissexto($data[2]) && ($data[1] - 1) >= 2) {
            $total += 86400;
        }

        return $total;
    }

    /**
     * Checa a quantidade de dias que tem em cada mes.
     *
     * @return mixed
     */
    private function dias_mes($data) {
        switch ($data[1]) {
            case 1: //janeiro
                return 31;
            case 2: //fevereiro
                if ($this->ano_bissexto($data[2])) {
                    return 29;
                }
                else {
                    return 28;
                }
            case 3: //março
                return 31;
            case 4: //abril
                return 30;
            case 5: //maio
                return 31;
            case 6: //junho
                return 30;
            case 7: //julho
                return 31;
            case 8: //agosto
                return 31;
            case 9: //setembro
                return 30;
            case 10: //outubro
                return 31;
            case 11: //novembro
                return 30;
            case 12: //dezembro
                return 31;
            default:
                return 0;
        }
    }

    /**
     * Checa se o formato de data é valido.
     *
     * @return mixed
     */
    private function data_valida($data) {
        $formato = explode("/", $data);
        if (count($formato) == 3) {
            if ($formato[0] > 0 && $formato[0] <= $this->dias_mes($formato)) {
                if ($formato[1] > 0 && $formato[1] <= 12) {
                    if ($formato[2] > 0) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Calcula diferença em segundos.
     *
     * @return mixed
     */
    private function calcula_segundos($di, $df) {
        $datai = explode("/", $di);
        $dataf = explode("/", $df);

        $si = $this->data_para_segundos($datai);
        $sf = $this->data_para_segundos($dataf);

        if ($si > $sf) {
            return $si - $sf;
        }
        else if ($si < $sf) {
            return $sf - $si;
        }
        else {
            return 0;
        }
    }

    /**
     * Calcula diferença em dias.
     *
     * @return mixed
     */
    private function calcula_dias($di, $df) {
        $segundos = $this->calcula_segundos($di, $df);

        return $segundos/86400;
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
         * Escreva um algoritmo que calcule o tempo em dias a partir de uma data inicial e final
         * recebidos no formato dd/mm/aaaa. Não deve usar funções de data e hora
         *
         ******************************************************************************************/

        //pegar data inicial
        $di = $this->ask('Qual a data inicial (formato dd/mm/aaaa)?');

        //checar formato de data
        if (!$this->data_valida($di)) {
            $this->error('Informe uma data válida!');
            return 0;
        }

        //pegar data final
        $df = $this->ask('Qual a data final (formato dd/mm/aaaa)?');

        //checar formato de data
        if (!$this->data_valida($df)) {
            $this->error('Informe uma data válida!');
            return 0;
        }

        $dif = (int) $this->calcula_dias($di, $df);

        //mostrar na tela
        $this->info('A DIFERENÇA EM DIAS ENTRE AS DUAS DATAS É: ');
        print_r($dif);

    }
}
