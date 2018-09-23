<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * A lista encadeada.
 *
 * @return mixed
 */
class LinkedList {
    private $data;
    private $next;

    private function __construct() {}

    public static function fromArray($array) {
        $head = new LinkedList();
        $head->data = $array[0];
        $previous = $head;
        $array = array_slice($array, 1);
        foreach ($array as $item) {
            $current = new LinkedList();
            $current->data = $item;
            $previous->next = $current;
            $previous = $current;
        }
        return $head;
    }

    public function data() { return $this->data; }

    public function next() { return $this->next; }

    public function iterator() {
        return LinkedListIterator::fromLinkedList($this);
    }
}

/**
 * O iterador.
 *
 * @return mixed
 */
class LinkedListIterator implements \Iterator {
    private $head;
    private $current;
    private $key;

    private function __construct() {}

    public static function fromLinkedList($linkedList) {
        $lli = new LinkedListIterator();
        $lli->head = $linkedList;
        $lli->current = $linkedList;
        $lli->key = 0;
        return $lli;
    }

    public function current() {
        return $this->current->data();
    }

    public function key() {
        return $this->key;
    }

    public function next() {
        $this->current = $this->current->next();
        $this->key += 1;
    }

    public function rewind() {
        $this->current = $this->head;
        $this->key = 0;
    }

    public function valid() {
        return $this->current !== null;
    }
}

class exercicio8 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exercicio8';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exercicio 8';

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
         * Orientação a objetos e design patterns
         * Implementar um padrão iterator no modelo abaixo. Apresentar o dIagrama de classes e
         * pseudocódigo.
         *
         ******************************************************************************************/

        $array = [1, 2, 3, 4];

        $r = LinkedList::fromArray($array);
        $ri = $r->iterator();

        foreach ($ri as $i) {
            $this->info($i);
        }

        $this->info('O diagrama de classes se encontra na raiz do projeto.');
        
    }
}
