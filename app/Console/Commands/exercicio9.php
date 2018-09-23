<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class exercicio9 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exercicio9';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exercício 9';

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        /******************************************************************************************
         *
         * - Definir as cardinalidades máximas e mínimas
         * - Criar o esquema do banco e apresentar o DDL utilizado
         * - Apresentar o SQL para as seguintes consultas
         * - Atores do filme com título “XYZ”
         * - Filmes que o ator de nome “FULANO” participou
         * - Listar os filmes do ano 2015 ordenados pelo quantidade de atores participantes e
         *   pelo título em ordem alfabética.
         * - Listar os atores que trabalharam em filmes cujo diretor foi “SPIELBERG”
         *
         ******************************************************************************************/

        //cardinalidade maxima e minima
        $this->info('Cardinalidades Máxima e Mínima:');
        $this->info('Diretores: Ator 1:1 Flime');
        $this->info('Atores_Filmes: Ator N:N Flime');

        //esquema do banco e DDL
        //(usei raw ao invés do eloquent porque acho que era isso que o enunciado queria)
        $this->info('Esquema do Banco e DDL:');

        //tabela atores
        $this->info('Tabela Atores:');
        $this->info("CREATE TABLE `atores` (
                                `id` INT(255) UNSIGNED NOT NULL AUTO_INCREMENT,
                                `nome` VARCHAR(255) NOT NULL DEFAULT \'0\',
                                PRIMARY KEY (`id`),
                                INDEX `id` (`id`)
                            )
                            ENGINE=InnoDB
                            ;");

        //tabela filmes
        $this->info('Tabela Filmes:');
        $this->info("CREATE TABLE `filmes` (
                                `id` INT(255) UNSIGNED NOT NULL AUTO_INCREMENT,
                                `titulo` VARCHAR(255) NOT NULL DEFAULT '0',
                                `ano` INT(255) UNSIGNED NOT NULL DEFAULT '0',
                                PRIMARY KEY (`id`),
                                INDEX `id` (`id`)
                            )
                            ENGINE=InnoDB
                            ;
                            ");

        //tabela atores_filmes
        $this->info('Tabela Atores_Filmes:');
        $this->info("CREATE TABLE `atores_filmes` (
                                `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                `ator` INT(10) UNSIGNED NOT NULL DEFAULT '0',
                                `filme` INT(10) UNSIGNED NOT NULL DEFAULT '0',
                                PRIMARY KEY (`id`),
                                INDEX `id` (`id`),
                                INDEX `FK_atores_filmes_atores` (`ator`),
                                INDEX `FK_atores_filmes_filmes` (`filme`),
                                CONSTRAINT `FK_atores_filmes_atores` FOREIGN KEY (`ator`) REFERENCES `atores` (`id`),
                                CONSTRAINT `FK_atores_filmes_filmes` FOREIGN KEY (`filme`) REFERENCES `filmes` (`id`)
                            )
                            ENGINE=InnoDB
                            ;
                            ");

        //tabela diretores
        $this->info('Tabela Diretores:');
        $this->info("CREATE TABLE `diretores` (
                                `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                                `ator` INT(10) UNSIGNED NOT NULL DEFAULT '0',
                                `flime` INT(10) UNSIGNED NOT NULL DEFAULT '0',
                                PRIMARY KEY (`id`),
                                INDEX `id` (`id`),
                                INDEX `FK_diretores_atores` (`ator`),
                                INDEX `FK_diretores_filmes` (`flime`),
                                CONSTRAINT `FK_diretores_atores` FOREIGN KEY (`ator`) REFERENCES `atores` (`id`),
                                CONSTRAINT `FK_diretores_filmes` FOREIGN KEY (`flime`) REFERENCES `filmes` (`id`)
                            )
                            COLLATE='latin1_swedish_ci'
                            ENGINE=InnoDB
                            ;
                            ");
        
        //consultas SQL, em ordem:
        //Atores do filme com título “XYZ”
        $this->info('Atores do filme com título “XYZ”:');
        $this->info("SELECT * FROM atores
                            INNER JOIN filmes
                            ON atores.id = filmes.ator
                            WHERE filmes.titulo = 'XYZ'; ");

        //Filmes que o ator de nome “FULANO” participou
        $this->info('Filmes que o ator de nome “FULANO” participou:');
        $this->info("SELECT * FROM filmes
                            INNER JOIN atores
                            ON filmes.ator = atores.id
                            WHERE atores.nome = 'FULANO'; ");

        //Listar os filmes do ano 2015 ordenados pelo quantidade de atores participantes e pelo título em ordem alfabética.
        $this->info('Listar os filmes do ano 2015 ordenados pelo quantidade de atores participantes e pelo título em ordem alfabética:');
        $this->info("SELECT DISTINCT id, filme, ator, 
                            COUNT(ator) AS Num_atores
                            FROM atores_filmes
                            INNER JOIN filmes
                            ON atores_filmes.filme = filmes.id 
                            WHERE filmes.ano = '2015'
                            GROUP BY Num_atores
                            ORDER BY Num_atores DESC, filmes.titulo DESC;");

        //Listar os atores que trabalharam em filmes cujo diretor foi “SPIELBERG”
        $this->info('Listar os atores que trabalharam em filmes cujo diretor foi “SPIELBERG”:');
        $this->info("SELECT * FROM atores
                            INNER JOIN filmes
                            ON atores.id = filmes.ator
                            INNER JOIN diretores
                            ON filmes.id = diretores.filme
                            LEFT OUTER JOIN atores atores_diretores
                            ON diretores.ator = atores_diretores.id
                            WHERE atores_diretores.nome = 'SPIELBERG'; ");

    }
}
