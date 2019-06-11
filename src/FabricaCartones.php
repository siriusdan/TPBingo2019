<?php

namespace Bingo;

class FabricaCartones {

  public function generarCarton() {
    // Algo de pseudo-código para ayudar con la evaluacion.
        $carton = new Carton($this->intentoCarton());
        if ($this->cartonEsValido($carton)) {
          return $carton;
        }
     }
  protected function cartonEsValido($carton) {
    if ($this->validarUnoANoventa($carton) &&
      $this->validarCincoNumerosPorFila($carton) &&
      $this->validarColumnaNoVacia($carton) &&
      $this->validarColumnaCompleta($carton) &&
      $this->validarTresCeldasIndividuales($carton) &&
      $this->validarNumerosIncrementales($carton) &&
      $this->validarFilasConVaciosUniformes($carton)
    ) {
      return TRUE;
    }
    return FALSE;
  }

  protected function validarUnoANoventa($carton) {
    $bandera=True;
    foreach($carton -> numerosDelCarton() as $numeros){
      if($numeros > 90 || $numeros < 1){
        $bandera=False;
      }
    } 
    return $bandera;
  }

  protected function validarCincoNumerosPorFila($carton) {
    $bandera=True;
    foreach($carton->filas() as $filas){
      $contador = 0;
      foreach($filas as $numeros){
        if($numeros != 0){
          $contador++;
        }
      }
      if($contador!=5){
        $bandera=False;
      }
    }
    return $bandera;
  }

  protected function validarColumnaNoVacia($carton) {
    $bandera=True;
    foreach ($carton -> columnas() as $columnas){
      $band = 0;
      foreach ($columnas as $numeros){
       if($numeros != 0){
         $band = 1;
       }
      }
      if($band != 1){
        $bandera=False;
      }
    }
    return $bandera;
  }

  protected function validarColumnaCompleta($carton) {
    $bandera = True;
    foreach ($carton -> columnas() as $columnas){
      $band = 0;
      foreach ($columnas as $numeros){
       if($numeros != 0){
         $band ++;
       }
      }
      if($band == 3){
        $bandera= False;
      }
    }
    return $bandera;
  }

  protected function validarTresCeldasIndividuales($carton) {
    $bandera = True;    
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
    if($ci != 3){
      $badnera=False;
                }
    return $bandera;
  }

  protected function validarNumerosIncrementales($carton) {
    $bandera= True;
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
      if($min > $max){
        $bandera= False;
                     }
      $max = $min;
    }
    return $bandera;
  }

  protected function validarFilasConVaciosUniformes($carton) {
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
    }
    return $MenosDeDos;
  }


  public function intentoCarton() {
    $contador = 0;

    $carton = [
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0]
    ];
    $numerosCarton = 0;

    while ($numerosCarton < 15) {
      $contador++;
      if ($contador == 50) {
        return $this->intentoCarton();
      }
      $numero = rand (1, 90);

      $columna = floor ($numero / 10);
      if ($columna == 9) { $columna = 8;}
      $huecos = 0;
      for ($i = 0; $i<3; $i++) {
        if ($carton[$columna][$i] == 0) {
          $huecos++;
        }
        if ($carton[$columna][$i] == $numero) {
          $huecos = 0;
          break;
        }
      }
      if ($huecos < 2) {
        continue;
      }

      $fila = 0;
      for ($j=0; $j<3; $j++) {
        $huecos = 0;
        for ($i = 0; $i<9; $i++) {
          if ($carton[$i][$fila] == 0) { $huecos++; }
        }

        if ($huecos < 5 || $carton[$columna][$fila] != 0) {
          $fila++;
        } else{
          break;
        }
      }
      if ($fila == 3) {
        continue;
      }

      $carton[$columna][$fila] = $numero;
      $numerosCarton++;
      $contador = 0;
    }

    for ( $x = 0; $x < 9; $x++) {
      $huecos = 0;
      for ($y =0; $y < 3; $y ++) {
        if ($carton[$x][$y] == 0) { $huecos++;}
      }
      if ($huecos == 3) {
        return $this->intentoCarton();
      }
    }

    return $carton;
  }


}
