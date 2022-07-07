<?php

class Delta {

    private string $estado;
    private Closure $closure;

    public function __construct(string $estado, Closure $fnOperacao = null) {
        $this->setEstado($estado);
        $this->setOperacao($fnOperacao);
    }
    private function setOperacao(Closure | null $fnOperacao) 
    {
        $this->fnOperacao = $fnOperacao ?: function(Pilha $pilha) {};
    }

    private function setEstado(string $estado)
    {
        $this->estado = $estado;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getOperacao()  
    {
        return $this->closure;
    }

}