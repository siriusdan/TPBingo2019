<?php
namespace Bingo;

class Carton implements CartonInterface {
  protected $numeros_carton = [];

  public function __construct(array $carton) {
    $this->numeros_carton = $carton;
  }

  public function filas() {
    $filas= [];
    $columnas = $this -> numeros_carton;
    for ($i=0;$i<=2;$i++){
       $filas[$i]=array(
         $columnas  [0] [$i] , $columnas  [1] [$i] , $columnas [2] [$i],
         $columnas  [3] [$i], $columnas  [4] [$i], $columnas [5] [$i] ,
         $columnas  [6] [$i]  , $columnas  [7] [$i], $columnas [8] [$i]
         );
    }
    return $filas;
  }

  public function columnas() {
   return $this->numeros_carton;
  }

  public function numerosDelCarton() {
    $numeros = [];
    foreach ($this->filas() as $fila) {
      foreach ($fila as $celda) {
        if ($celda != 0) {
          $numeros[] = $celda;
        }
      }
    }
    return $numeros;
  }

  public function tieneNumero(int $numero) {
    return in_array($numero, $this->numerosDelCarton());
  }
}
