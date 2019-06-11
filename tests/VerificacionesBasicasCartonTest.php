<?php

namespace Bingo;

use PHPUnit\Framework\TestCase;

/**
 * Quita los ceros de un array dejando solo los valores diferentes a cero.
 *
 * @param array $lista
 *   Una lista de números.
 *
 * @return array
 *   Un array con los valores filtrados donde el cero es eliminado de la lista.
 */
function celdas_ocupadas(array $lista) {
  return array_filter($lista);
}

class VerificacionesBasicasCartonTest extends TestCase {

  /**
   * Verifica que cada carton tenga 15 números.
   */
  public function testQuinceNumerosPorCarton() {
    $carton = new CartonEjemplo;
    $this->assertCount(15, $carton->numerosDelCarton());
  }

  /**
   * Verifica que no haya números repetidos en el carton.
   */
  public function testNumerosNoRepetidos() {
    $carton = new CartonEjemplo;
    $numeros_analizados = [];
    foreach ($carton->filas() as $fila) {
      foreach (celdas_ocupadas($fila) as $celda) {
        $this->assertFalse(in_array($celda, $numeros_analizados));
        $numeros_analizados[] = $celda;
      }
    }
  }
}
