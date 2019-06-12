<?php
namespace Bingo;
/**
 * Este es un Carton. 
 */
class Carton implements CartonInterface {
  protected $numeros_carton = [];
  /**
   * {@inheritdoc}
   */
  public function __construct($carton) {
    $this->numeros_carton=$carton;
  }
  /**
   * {@inheritdoc}
   */
  public function filas() {
    $filas= [];
    $filas[]= [];
    for ($i=0;$i<=2;$i++){
      foreach($this->columnas() as $columnas){
        $filas[$i][]=$columnas[$i];
      }
    }
    return $filas;
  }
  /**
   * {@inheritdoc}
   */
  public function columnas() {
   return $this->numeros_carton;
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
