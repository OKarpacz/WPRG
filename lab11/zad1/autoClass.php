<?php

class NoweAuto {
    protected $model;
    protected $cenaEuro;
    protected $kursEuroPLN;

    public function __construct($model, $cenaEuro, $kursEuroPLN) {
        $this->model = $model;
        $this->cenaEuro = $cenaEuro;
        $this->kursEuroPLN = $kursEuroPLN;
    }

    public function obliczCene() {
        return $this->cenaEuro * $this->kursEuroPLN;
    }
}

class AutoZDodatkami extends NoweAuto {
    protected $alarm;
    protected $radio;
    protected $klimatyzacja;

    public function __construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja) {
        parent::__construct($model, $cenaEuro, $kursEuroPLN);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klimatyzacja = $klimatyzacja;
    }

    public function obliczCene() {
        $cenaSamochodu = parent::obliczCene();
        return $cenaSamochodu + $this->alarm + $this->radio + $this->klimatyzacja;
    }
}

class Ubezpieczenie extends AutoZDodatkami {
    protected $procentowaWartoscUbezpieczenia;
    protected $liczbaLatPosiadania;

    public function __construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja, $procentowaWartoscUbezpieczenia, $liczbaLatPosiadania) {
        parent::__construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja);
        $this->procentowaWartoscUbezpieczenia = $procentowaWartoscUbezpieczenia;
        $this->liczbaLatPosiadania = $liczbaLatPosiadania;
    }

    public function obliczCene() {
        $cenaSamochoduZDodatkami = parent::obliczCene();
        $wartoscUbezpieczenia = $this->procentowaWartoscUbezpieczenia * ($cenaSamochoduZDodatkami * ((100 - $this->liczbaLatPosiadania) / 100));
        return $wartoscUbezpieczenia;
    }
}

?>
