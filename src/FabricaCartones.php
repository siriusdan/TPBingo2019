<?php

namespace Bingo;

class FabricaCartones {
  
  protected $randomCarton = [];
  
  public function generarCarton() {
    // Algo de pseudo-código para ayudar con la evaluacion.
    while(1){
      $this->randomCarton = $this->intentoCarton();
      if(!($this->cartonEsValido())){
        return $this->randomCarton;
      }
    }
  }
  
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

  public function columnas() {
   return $this->randomCarton;
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
 
  protected function cartonEsValido() {
    if ($this->validarUnoANoventa() &&
      $this->validarCincoNumerosPorFila() &&
      $this->validarColumnaNoVacia() &&
      $this->validarColumnaCompleta() &&
      $this->validarTresCeldasIndividuales() &&
      $this->validarNumerosIncrementales() &&
      $this->validarFilasConVaciosUniformes()
    ) {
      return TRUE;
    }
    return FALSE;
  }

  protected function validarUnoANoventa() {
    $bandera=True;
    foreach($this -> numerosDelCarton() as $numeros){
      if($numeros > 90 || $numeros < 1){
        $bandera=False;
      }
    } 
    return $bandera;
  }

  protected function validarCincoNumerosPorFila() {
    $bandera=True;
    foreach($this->filas() as $filas){
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

  protected function validarColumnaNoVacia() {
    $bandera=True;
    foreach ($this -> columnas() as $columnas){
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

  protected function validarColumnaCompleta() {
    $bandera = True;
    foreach ($this -> columnas() as $columnas){
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

  protected function validarTresCeldasIndividuales() {
    $bandera = True;    
    $ci=0;
        foreach ($this -> columnas() as $columnas)
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

  protected function validarNumerosIncrementales() {
    $bandera= True;
    $max = 0;
    foreach ($this-> columnas() as $columnas){
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

  protected function validarFilasConVaciosUniformes() {
    $MenosDeDos = True;
    foreach ($this->filas() as $filas){
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
