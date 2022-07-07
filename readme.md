# Implementação de Autômato de Pilha:
>>Automato de pilha:

     Estados:                     {q1, q2, q3}
     Alfabeto de Entrada:         {a, b}
     Alfabeto de Pilha:           {Z, X}
     Estado inicial:              q1
     Conjunto de estado finais:   q3
    
     Delta:
        δ = (q1, a, Z) = (q1, XXZ)
        δ = (q1, a, X) = (q1, XXX)
        δ = (q1, b, X) = (q2, &)
        δ = (q2, b, X) = (q2, &)
        δ = (q2, &, Z) = (q3, &)  
    
___
## EXEMPLO:

>> Entrada: `abb`

    PASSO 1
    Estado atual:           q1
    Palavra a ser lida:     a
    Topo da Pilha:          Z
    Novo estado:            q1
    Empilhamento:           Z X X
    PILHA:                  [Z, X, X]
    palavra:                [b, b]

    PASSO 2
    Estado atual:           q1
    Palavra a ser lida:     b
    Topo da Pilha:          X
    Novo estado:            q2
    Empilhamento:           &
    PILHA:                  [Z, X]
    palavra:                [b]

    PASSO 3
    Estado atual:           q2
    Palavra a ser lida:     b
    Topo da Pilha:          X
    Novo estado:            q2
    Empilhamento:           &
    PILHA:                  [Z]
    palavra:                []

    PASSO 4
    Estado atual:           q2
    Palavra a ser lida:     
    Topo da Pilha:          Z
    Novo estado:            q3
    Empilhamento:           &
    PILHA:                  []
    palavra:                []