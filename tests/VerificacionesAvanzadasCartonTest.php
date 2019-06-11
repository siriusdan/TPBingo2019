<?php

namespace Bingo;

use PHPUnit\Framework\TestCase;

class VerificacionesAvanzadasCartonTest extends TestCase {
  /**
   * Verifica que los números del carton se encuentren en el rango 1 a 90.
   * @dataProvider cartonProvider
   */
  public function testUnoANoventa(CartonInterface $carton) {
    foreach($this -> numerosDelCarton() as $numeros){
      $this->assertTrue($numeros <= 90 && $numeros >= 1);
    } 
  }

  /**
   * Verifica que cada fila de un carton tenga exactamente 5 celdas ocupadas.
   * @dataProvider cartonProvider
   */
  public function testCincoNumerosPorFila(CartonInterface $carton) {
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
   * @dataProvider cartonProvider
   */
  public function testColumnaNoVacia(CartonInterface $carton) {
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
   * @dataProvider cartonProvider
   */
  public function testColumnaCompleta(CartonInterface $carton) {
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
   * @dataProvider cartonProvider
   */
  public function testTresCeldasIndividuales(CartonInterface $carton) {
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
            if ($c==1)
            {
                  $ci++;
            }
        }
        $this-> assertTrue($ci == 3);        
   }
  
  /**
   * Verifica que los números de las columnas izquierdas son menores que los de
   * las columnas a la derecha.
   * @dataProvider cartonProvider
   */  
  public function testNumerosIncrementales(CartonInterface $carton) {
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
      $max = $min;
    }
  }

  /**
   * Verifica que en una fila no existan más de dos celdas vacias consecutivas.
   * @dataProvider cartonProvider
   */
  public function testFilasConVaciosUniformes(CartonInterface $carton) {
    $MenosDeDos = True;
    foreach ($carton->filas() as $filas){
      $contador = 0;
      foreach($filas as $numeros){
        if($numeros==0){
          $contador++; 
        }
        else{
          $contador = 0; 
        }
        if($contador==3){
           $MenosDeDos = False;
        }
      }
      $this-> assertTrue($MenosDeDos);
    }
  }
  
  public static function cartonProvider()
  {
    return [ [new CartonEjemplo] , [new CartonJs] , [new Carton((new FabricaCartones)->generarCarton())] ]; 
  }
}
