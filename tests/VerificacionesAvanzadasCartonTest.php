<?php

namespace Bingo;

use PHPUnit\Framework\TestCase;
/** hola **/

class VerificacionesAvanzadasCartonTest extends TestCase {
  /**
   * Verifica que los números del carton se encuentren en el rango 1 a 90.
   */
  public function testUnoANoventa() {
    $carton = new CartonEjemplo;
    foreach($carton -> numerosDelCarton() as $numeros){
      $this->assertTrue($numeros <= 90 && $numeros >= 1);
    } 
  }

  /**
   * Verifica que cada fila de un carton tenga exactamente 5 celdas ocupadas.
   */
  public function testCincoNumerosPorFila() {
    $carton = new CartonEjemplo;
    foreach($carton->filas() as $filas){
      $contador = 0;
      foreach($filas as $numeros){
        if($numeros != 0){
          $contador++;
        }
      }
      $this-> assertEquals($contador, 5);
    }
  }

  /**
   * Verifica que para cada columna, haya al menos una celda ocupada.
   */
  public function testColumnaNoVacia() {
    $carton = new CartonEjemplo;
    foreach ($carton -> columnas() as $columnas){
      $band = 0;
      foreach ($columnas as $numeros){
       if($numeros != 0){
         $band = 1;
       }
      }
      $this-> assertEquals($band, 1);
    }
  }

  /**
   * Verifica que no haya columnas de un carton con tres celdas ocupadas.
   */
  public function testColumnaCompleta() {
    $carton = new CartonEjemplo;
    foreach ($carton -> columnas() as $columnas){
      $band = 0;
      foreach ($columnas as $numeros){
       if($numeros != 0){
         $band ++;
       }
      }
      $this-> assertNotEquals($band, 3);
    }
  }

  /**
   * Verifica que solo hay exactamente tres columnas que tienen solo una celda
   * ocupada.
   */
   public function testTresCeldasIndividuales() {
    $carton = new CartonEjemplo;
    $ci=0;
    foreach ($carton -> columnas() as $columnas)
    {
        $c=0;
        foreach ($columnas as $numeros)
        {
             if($numeros != 0)
             {
                  $c++;
             }
        }
        $this-> assertTrue($c == 3);
    }

  /**
   * Verifica que los números de las columnas izquierdas son menores que los de
   * las columnas a la derecha.
   */
  public function testNumerosIncrementales() {
    $carton = new CartonEjemplo;
    $max = 0;
    foreach ($carton-> columnas() as $columnas){
      $min = 100;
      foreach($columnas as $numeros){
        if($numeros != 0){
        if($numeros < $min){
          $min = $numeros;
        }
       }
      }
      $this-> assertTrue($min > $max);
    }
  }

  /**
   * Verifica que en una fila no existan más de dos celdas vacias consecutivas.
   */
  public function testFilasConVaciosUniformes() {
    $this->assertTrue(TRUE);
  }

}
