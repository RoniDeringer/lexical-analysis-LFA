//
/*
AP = ( {0,1,2,3},{a,b},{Z,A}, Delta, 0,Z,3)
Delta =
(0,a,Z)         =   (1, AAZ)
(1,a,A)         =   (1, AAA)
(1,b,A)         =   (2, Epsilon)
(2,b,A)         =   (2, Epsilon)
(1,Epsilon,Z)   =   (3, Z)

*/

delta = { //estado atual : {entrada+topo} : {alfa}}
    0 : {'aZ':{'ESTADO':1,'PILHA':'AAZ'}},
    1 : {'aA':{'ESTADO':1,'PILHA':'AAA'}, 'bA':{'ESTADO' :2, 'PILHA':'Epsilon'}},
    2 : {'bA':{'ESTADO':2,'PILHA':'Epsilon'}, 'EpsilonZ':{'ESTADO':3,'PILHA': 'Epsilon'}}
    }

    finais = {3:3};

    function ap(entrada){
        p = new pilha();
        p.empilha('Z');
        estado = 0.
        console.log("Estado: "+estado+" Pilha: "+p.imprime());
        for(i=0; i<=entrada.length;i++){
            try{
                if(entrada[i] != null){
                    transicao = delta[estado][entrada[i]+p.consulta()];
                }else{
                    transicao = delta[estado]['Epsilon'+p.consulta()];
                estado = transicao.ESTADO;
                valor = transicao.PILHA;
                }
                if(valor == 'Epsilon')
                    p.desempilha();
                else
                    for(j=0;j<valor.length-1;j++)
                        p.empilha(valor[j]);

                console.log("Estado: "+estado+" Pilha: "+p.imprime());
            }catch(e){
                    return false;
                }
            }
            iniais[estado] != null) //aceita pelo estado final
            return true;
                }
                }
            }
        }
    }

    /*
    Classe chamada pilha
        metodos: 
            empilha
            imprime
            consulta
            desempilha

        atributos:
        estado
