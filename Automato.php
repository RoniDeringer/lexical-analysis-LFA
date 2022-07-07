<?php

require_once('Pilha.php');

class Automato {

    const ESTADO_VAZIO = 'VAZIO';

    private Pilha $pilha;
    private array $estados;
    private array $alfabetoEntrada;
    private array $alfabetoPilha;
    private array $estadosFinais;
    private array $Delta;

    public function __construct(
        array $estados,
        array $alfabetoEntrada,
        array $alfabetoPilha,
        string $estadoInicial,
        string $pilhaInicial,
        array $estadosFinais,
        array $Delta
    ) {
        $this->setEstados($estados);
        $this->setAlfabetoEntrada($alfabetoEntrada);
        $this->setAlfabetoPilha($alfabetoPilha);
        $this->setEstadoInicial($estadoInicial);
        $this->setPilha(new Pilha($pilhaInicial));
        $this->setEstadosFinais($estadosFinais);
        $this->setTransicoes($Delta);
    }



    public function getEstadoFinal(string $palavra)  
    {
        $valoresEntrada = str_split($palavra);
        $valoresEntrada[] = self::ESTADO_VAZIO;
        $estadoAtual = $this->getEstadoInicial();
        $pilha = $this->getPilha();

        foreach ($valoresEntrada as $valorEntrada) {
            $regraDelta = $this->getTransicao($estadoAtual, $valorEntrada, $pilha->getTopo());
            $estadoAtual = $regraDelta->getEstado();
            call_user_func($regraDelta->getOperacao(), $pilha);
        }

        if(!$pilha->pilhaVazia()) {
           throw new Exception("Palavra lida, mas Pilha cheia.");
        }

        if(!in_array($estadoAtual, $this->getEstadosFinais())) {
            throw new Exception("O estado {$estadoAtual} não é o estado final.");
        }
        return $estadoAtual;
    } //fim Estado Final



    private function getTransicao(string $estadoAtual, string $valorEntrada, string $topoDaPilha)  
    {

        $transicoesDelta = $this->getTransicoes();

        if(!isset($transicoesDelta[$estadoAtual][$valorEntrada])) {
            throw new Exception("A palavra '{$valorEntrada}' não possui transição para o atual estado");
        }
        if(!isset($transicoesDelta[$estadoAtual])) {
            throw new Exception("Estado {$estadoAtual} não foi declarado.");
        }
        if(!isset($transicoesDelta[$estadoAtual][$valorEntrada][$topoDaPilha])) {
            throw new Exception("Topo da pilha inválido");
        }

        return $transicoesDelta[$estadoAtual][$valorEntrada][$topoDaPilha];
    }






    private function setPilha(Pilha $pilha) 
    {
        $this->pilha = $pilha;
    }
    
    private function setEstados(array $estados)  
    {
        $this->estados = $estados;
    }
    
    private function setAlfabetoEntrada(array $alfabetoEntrada)
    {
        $this->alfabetoEntrada = $alfabetoEntrada;
    }
    
    private function setAlfabetoPilha(array $alfabetoPilha) 
    {
        $this->alfabetoPilha = $alfabetoPilha;
    }
    
    private function setEstadoInicial(string $estadoInicial)  
    {
        $this->estadoInicial = $estadoInicial;
    }
    
    private function setEstadosFinais(array $estadosFinais)  
    {
        $this->estadosFinais = $estadosFinais;
    }

    private function setTransicoes(array $Delta )
    {
        $this->Delta  = $Delta ;
    }


    private function getPilha()
    {
        return $this->pilha;
    }
    
    private function getEstados() 
    {
        return $this->estados;
    }

    private function getAlfabetoEntrada() 
    {
        return $this->alfabetoEntrada;
    }

    private function getAlfabetoPilha() 
    {
        return $this->alfabetoPilha;
    }

    private function getEstadoInicial() 
    {
        return $this->estadoInicial;
    }

    private function getEstadosFinais() 
    {
        return $this->estadosFinais;
    }

    private function getTransicoes() 
    {
        return $this->Delta ;
    }
}


