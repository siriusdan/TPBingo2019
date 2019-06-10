<?php

namespace Bingo;

/**
 * Este es un Carton de Ejemplo. 
 */
class CartonEjemplo implements CartonInterface {

  protected $numeros_carton = [];

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->numeros_carton = [
      [0, 16, 0, 38, 47, 0, 67, 77, 0],
      [9, 0, 28, 35, 0, 55, 0, 0, 84],
      [0, 12, 26, 0, 45, 0, 61, 0, 89],
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
        columnas[$i][]= $filas[$i];
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
    return in_array($numero, $this->numerosDelCarton());
  }

}
