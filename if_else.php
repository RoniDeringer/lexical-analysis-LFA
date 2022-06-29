<?php
include __DIR__ . '/css/style.php';
echo '<h1>Autômato de Pilha</h1>';
echo '<h2> a^n b^m | n > 0 e m = 2*n </h2>';

echo "<hr>";
?>
<form action="" method="post">
    <label>Entrada:</label>
    <input type="text" name="entrada">
    <input type="submit" value="Verificar">
</form>
<?php

if (isset($_POST["entrada"])) {
    $post_user = $_POST["entrada"];

    $conversao_p_array = str_split($post_user);
    $conversao_p_array[] = '';

    echo "<br>Palavra a ser lida: <b><br>";
    echo implode(' ', $conversao_p_array), '</b>';


    $estado_atual;
    $entradas;
    $topo_pilha;
    $novo_estado;
    $nova_pilha;
    $entrada_post;


    $entradas = $conversao_p_array;
    $novo_estado = 'q';
    $topo_pilha = ['Z'];

    echo "<pre>";


    foreach ($entradas as $entrada) {

        $estado_atual = $novo_estado;

        if (($estado_atual == 'q') && ($entrada == 'a') && (end($topo_pilha) == 'Z')) {
            $novo_estado = 'q';
            $nova_pilha = ['B', 'B'];
            printTransicao($estado_atual, $entrada, $topo_pilha, $novo_estado, $nova_pilha);
     
        } else if (($estado_atual == 'q') && ($entrada == 'a') && (end($topo_pilha) == 'B')) {
            $novo_estado = 'q';
            $nova_pilha = ['B', 'B'];
            printTransicao($estado_atual, $entrada, $topo_pilha, $novo_estado, $nova_pilha);
     
        } else if (($estado_atual == 'q') && ($entrada == 'b') && (end($topo_pilha) == 'B')) {
            $novo_estado = 'p';
            printTransicao($estado_atual, $entrada, $topo_pilha, $novo_estado, $nova_pilha);
            array_pop($topo_pilha);

        } else if (($estado_atual == 'p') && ($entrada == 'b') && (end($topo_pilha) == 'B')) {
            $novo_estado = 'p';
            printTransicao($estado_atual, $entrada, $topo_pilha, $novo_estado, $nova_pilha);
            array_pop($topo_pilha);
       
        } else if (($estado_atual == 'p') && ($entrada == '') && (end($topo_pilha) == 'Z')) {
            $novo_estado = 'p';
            printTransicao($estado_atual, $entrada, $topo_pilha, $novo_estado, $nova_pilha);
            array_pop($topo_pilha);
        
        } else {
            break; //pulo do gato, MIAU
        }

        /**
         * caso ja tenha feito o desempilhamento nos deltas, ele nao vai juntar os arrays
         */
        if ($nova_pilha) {
            $topo_pilha = array_merge($topo_pilha, $nova_pilha); //ele recebe vazio se o $nova_pilha for vazio
        }

        $nova_pilha = null;
    } //fim foreach

    echo "</pre>";
    echo "<hr>";
    echo "<pre>";


    if (!$topo_pilha) {
        echo "<b><aceito>Autômato aceito</aceito></b>";
    } else {
        echo "<b><naceito>Autômato NÃO aceito</naceito></b>";
    }
    echo "</pre>";
}


function printTransicao($estado_atual, $entrada, $topo_pilha, $novo_estado, $nova_pilha)
{
    echo "Estado Atual:         <strong>$estado_atual</strong><br>";

    echo "Palavra a ser lida:   <entrada>$entrada</entrada><br>";

    echo "Topo da pilha:        <strong>";
    echo implode(', ', $topo_pilha), '</strong>';

    echo "<br>Novo Estado:          <strong>$novo_estado</strong>";

    if ($nova_pilha) {
        echo "<br>Empilha:              <strong>";
        echo implode(', ', $nova_pilha), '</strong>';
    } else {
        echo "<br>Empilha:              <strong>&</strong>";
    }
    
    echo "<br><br><br>";
}
echo "~Roni Deringer";


/*
 * Estados:                     {q, p}
 * Alfabeto de Entrada:         {a, b}
 * Alfabeto de Pilha:           {B}
 * Estado inicial:              q
 * Conjunto de estado finais:
 *
 * Delta:
    δ = (q, a, Z) = (p, BBZ)
    δ = (q, a, B) = (q, BBB)
    δ = (q, b, B) = (p, &)
    δ = (p, b, B) = (p, &)
    δ = (p, &, Z) = (p, &)
 */