<?php

class Pilha {

    private array $elementosPilha = [];

    public function __construct(string $elementoInicialPilha) {
        $this->inserir($elementoInicialPilha);
    }


    /*
    Empilha
    */
    public function inserir(string $newElemento) 
    {
        $elementosPilha = $this->getElementos();
        $elementosPilha[] = $newElemento;
        $this->setElementos($elementosPilha);
    }

    /*
    Dempilha
    */
    public function remover() {
        if($this->pilhaVazia()) {
            throw new Exception('Erro ao desempilhar!');
        }
        $elementosPilha = $this->getElementos();
        unset($elementosPilha[count($elementosPilha) - 1]);
        $this->setElementos($elementosPilha);
    }




    public function pilhaVazia()
    {
        return $this->getNumeroElementos() === 1;
    }
    public function getTopo() 
    {
        return $this->getElementos()[$this->getNumeroElementos() - 1];  
    }
    
    private function getNumeroElementos() 
    {
        return count($this->getElementos());
    }
    public function getElementos() 
    {
        return $this->elementosPilha;
    }

    private function setElementos(array $elementosPilha)  
    {
        $this->elementosPilha = $elementosPilha;
    }

}