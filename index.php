<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php


    /**
     *
     */
    trait ScontoApp
    {
      function sconto_applicabile()
      {
        if ($this -> fascia_qualita == 1) {
           $sconto = $this -> prezzo/10;
        }elseif ($this -> fascia_qualita == 2) {
           $sconto = $this -> prezzo/8;
        }elseif ($this -> fascia_qualita == 3) {
           $sconto = $this -> prezzo/6;
        }
        echo "Ciao! Io sono una trait :) ed ho appena scoperto che sovrascrivo il parent! " . $sconto ."€ <br>";
      }
    }

    class Elettrodomestico {
        public $marca;
        public $fascia_qualita;
        public $prezzo;

        public function __construct($marca,$fascia_qualita,$prezzo){
            $this -> marca = $marca;
            $this -> fascia_qualita = $fascia_qualita;
            $this -> prezzo = $prezzo;
        }
        public function sconto_applicabile(){
          if ($this -> fascia_qualita == 1) {
             $sconto = $this -> prezzo/10;
          }elseif ($this -> fascia_qualita == 2) {
             $sconto = $this -> prezzo/8;
          }elseif ($this -> fascia_qualita == 3) {
             $sconto = $this -> prezzo/6;
          }
          echo "lo sconto massimo applicabile a questo prodotto è " . $sconto ."€ <br>";
        }
    }
     //*****************
     // ereditarietà semplice
     //*****************
    class Frigo extends Elettrodomestico {
        public $modello;
        public $consumo_energia;

        public function __construct($marca,$fascia_qualita,$prezzo,$modello,$consumo_energia){
          parent::__construct($marca,$fascia_qualita,$prezzo);
          $this -> modello = $modello;
          $this -> consumo_energia = $consumo_energia;
        }
    }
    //*****************
    // Polimorfismo
    //*****************
    class Ferro_da_stiro extends Elettrodomestico {
      public $peso;
      public $munizioni;
      public function __construct($marca,$fascia_qualita,$prezzo,$peso,$munizioni){
        parent::__construct($marca,$fascia_qualita,$prezzo);
        $this -> peso = $peso;
        $this -> munizioni = $munizioni;
      }
      public function sconto_applicabile(){
      echo  "lo sconto applicabile per questo oggetto è del 22% <br>";
      }
    }
    //*****************
    // erede di erede
    //*****************
    class Frigo_da_viaggio extends Frigo
    {
      public $compatibilita_auto;
      public function __construct($marca,$fascia_qualita,$prezzo,$modello,$consumo_energia,$compatibilita_auto){
        parent::__construct($marca,$fascia_qualita,$prezzo,$modello,$consumo_energia);
        $this -> compatibilita_auto = $compatibilita_auto;
      }
    }
    //*****************
    // trait
    //*****************
    class Frigo_da_stiro extends Elettrodomestico{
      use ScontoApp;
      public function __construct($marca,$fascia_qualita,$prezzo){
        parent::__construct($marca,$fascia_qualita,$prezzo);
      }
    }


    $frigo_da_stiro = new Frigo_da_stiro("Frigo",2,2569);
    $ferro_da_stiro = new Ferro_da_stiro("ferro",1,5003,"ASSAI","pallettoni");
    $frigo_da_viaggio = new Frigo_da_viaggio("scuollo",2,3785,"bello,molto bello","poco","con tutti");
    $frigo = new Frigo("ariston",1,250,"quello_che_si_raffredda","AAA+");
    $frigo -> sconto_applicabile();
    $frigo_da_viaggio -> sconto_applicabile();
    $ferro_da_stiro -> sconto_applicabile();
    $frigo_da_stiro -> sconto_applicabile();

    var_dump($frigo_da_viaggio);

    ?>
  </body>
</html>
