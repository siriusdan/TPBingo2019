<?php

namespace Bingo;

/**
 * Este es un Carton de generado con
 * https://github.com/vicmagv/bingo-card-generator/blob/master/generar_carton.js
 */
class CartonJs implements CartonInterface {

  protected $numeros_carton = [];

  public function __construct() {
    $this->numeros_carton = [
      [4,0,24,31,40,0,0,72,0],
      [0,13,0,39,48,0,66,0,80],
      [1,0,27,0,0,50,0,73,86],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function filas() {
    return $this->numeros_carton;
  }
 
  /**
   * {@inheritdoc}
   */
  public function columnas() {
    $columnas = [];
    $columnas[] = [];
    for($i=0;$i<9;$i++){
      foreach($this-> filas() as $filas){
        $columnas[$i][]= $filas[$i];
      }
    }
    return $columnas;
  }
 
  /**
   * {@inheritdoc}
   */
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

  /**
   * {@inheritdoc}
   */
  public function tieneNumero(int $numero) {
    return in_array($numero, $this->numeros_carton);
  }

}
