<?php

require_once('Delta.php');
require_once('Automato.php');

$palavra = 'abb'; //palavra a ser lida

$empilha = function(Pilha $pilha) {
    $pilha->inserir('X','X');  //novo elemento da pilha (newElemento)
};

$desempilha = function(Pilha $pilha) {
    $pilha->remover(); //desempilha
};

$estados = ['q1', 'q2', 'q3'];
$alfabetoEntrada = ['a', 'b'];
$alfabetoPilha = ['Z', 'X'];
$estadoInicial = 'q1';
$pilhaInicial = 'Z';
$estadosFinais = ['q3'];
$Delta = [  //setar na mão
    'q1' => [
        'a' => [
            'Z' => new Delta('q1', $empilha),
            'X' => new Delta('q1', $empilha),
        ],
        'b' => [
            'X' => new Delta('q2', $desempilha),
        ]
    ], 
    'q2' => [
        'b' => [
            'X' => new Delta('q2', $desempilha),
        ],
        Automato::ESTADO_VAZIO => [
            'Z' => new Delta('q3'),
        ]
    ]
];



$printFinal = ['q3' => 'Aceitou Entrada!'];

$automato = new Automato($estados, $alfabetoEntrada, $alfabetoPilha, $estadoInicial, $pilhaInicial, $estadosFinais, $Delta);



try {
    echo  $printFinal[$automato->getEstadoFinal($palavra)];
} catch (Exception $oEx) {
    echo $oEx->getMessage();
}