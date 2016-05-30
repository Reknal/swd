<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.13.1/lodash.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

        <script>
            var app = angular.module('app',[], function($interpolateProvider) {
                $interpolateProvider.startSymbol('{[{');
                $interpolateProvider.endSymbol('}]}');
            });

            app.controller('MainController', ['$scope', '$http', function($scope,  $http) {
              $scope.wszystkieProdukty = [];
              $scope.wybraneProdukty = [];
              $scope.produktyDoWziecia = [];
              $scope.maksMasa = 1000;
              $scope.maksObjetosc = 1000;

              $scope.init = function(){
                $http({
                  method: 'GET',
                  url: '/getAllProducts'
                }).then(function successCallback(response) {
                   $scope.wszystkieProdukty = response.data;
                   window._.each($scope.wszystkieProdukty, function(produkt, indeks){
                    $scope.wszystkieProdukty[indeks].wartosc = parseFloat($scope.wszystkieProdukty[indeks].wartosc);
                    $scope.wszystkieProdukty[indeks].masa = parseFloat($scope.wszystkieProdukty[indeks].masa);
                    $scope.wszystkieProdukty[indeks].objetosc = parseFloat($scope.wszystkieProdukty[indeks].objetosc);
                   });
                });
              };

              $scope.dodajProdukt = function(produkt){
                var wybrany = _.filter($scope.wybraneProdukty, function(prod){ return prod.nazwa == produkt.nazwa; });
                if (wybrany.length == 0){
                  var nowyProdukt = window._.clone(produkt);
                  nowyProdukt.liczbaProduktow = 1;
                  $scope.wybraneProdukty.push(nowyProdukt);
                } else {
                  wybrany[0].liczbaProduktow ++;
                }
                window._.each($scope.wszystkieProdukty, function(prod, index){
                  if(prod.nazwa == produkt.nazwa){
                    $scope.wszystkieProdukty[index].liczbaProduktow -= 1;
                  }
                });
              };

              $scope.usunProdukt = function(produkt){
                window._.each($scope.wszystkieProdukty, function(prod, index){
                  if(prod.nazwa == produkt.nazwa){
                    $scope.wszystkieProdukty[index].liczbaProduktow ++;
                  }
                });
                window._.each($scope.wybraneProdukty, function(prod, index){
                  if(prod.nazwa == produkt.nazwa){
                    $scope.wybraneProdukty[index].liczbaProduktow --;
                    if($scope.wybraneProdukty[index].liczbaProduktow == 0){
                      $scope.wybraneProdukty = window._.filter($scope.wybraneProdukty, function(produ) {
                        return produ.nazwa != prod.nazwa;
                      });
                    }
                  }
                });
              };

              $scope.sprawdz = function(){
                $scope.listaWybranych = [];
                var drzewoWezly = [];
                var drzewoKrawedzie  = [];

                $scope.listaWybranych = stworzListeWybranych();

                drzewoWezly = stworzWezly($scope.listaWybranych.length);

                var temp1 = deepObjCopy(drzewoWezly); 

                console.log('stan', temp1);

                drzewoKrawdzenie = stworzKrawedzie(drzewoWezly);

                var temp2 = deepObjCopy(drzewoKrawdzenie);
                console.log('krawedzie', temp2);

                dajProdukty(drzewoKrawdzenie);

              };

              var dajProdukty = function(krawedzie){
                var zapamietaneWartosci = [];
                var iterator = 0;

                for(var i = (krawedzie.length-1); i>=0; i--){
                  var u = _.groupBy(krawedzie[i], function(krawedz){
                    return krawedz.z;
                  });

                  // usuniecie u, ktore przekraczaja maks mase i objetosc
                  if (i == krawedzie.length-1){

                    window._.each(u, function(grupa, indeks){
                      u[indeks] = window._.filter(u[indeks], function(krawedz){
                        return $scope.maksMasa > krawedz.zmianaMasy && $scope.maksObjetosc > krawedz.zmianaObjetosci 
                      });
                    });

                  } else {

                    // usuwamy krawedzie, ktore nie spelniaja ogarniczen

                    window._.each(u, function(grupa, indeks){
                      u[indeks] = window._.filter(u[indeks], function(krawedz){
                        var masaIObjetosc = dajMaseObjetoscWartoscZPoprzednichIteracji(krawedz, zapamietaneWartosci[iterator]);
                        return $scope.maksMasa > (krawedz.zmianaMasy+masaIObjetosc.masa) && $scope.maksObjetosc > (krawedz.zmianaObjetosci+masaIObjetosc.objetosc); 
                      });
                    });


                    // dodawanie wartosci z poprzednich iteracji 

                    window._.each(u, function(grupa, indeks1){
                      window._.each(grupa, function(krawedz, indeks2){
                        var masaObjetoscWartosc = dajMaseObjetoscWartoscZPoprzednichIteracji(krawedz, zapamietaneWartosci[iterator]); 
                        u[indeks1][indeks2].wartosc = u[indeks1][indeks2].wartosc + masaObjetoscWartosc.wartosc;
                        u[indeks1][indeks2].zmianaMasy = u[indeks1][indeks2].zmianaMasy + masaObjetoscWartosc.masa;
                        u[indeks1][indeks2].zmianaObjetosci = u[indeks1][indeks2].zmianaObjetosci + masaObjetoscWartosc.objetosc;
                      });
                    });

                    iterator++;

                  }

                  // daj najwieksza wartosc z kazdej grupy
                  var vx = [];
                  window._.each(u, function(grupa){
                    var najwieksza = deepObjCopy(grupa[0]);
                    window._.each(grupa, function(krawedz){
                      if(najwieksza.wartosc<krawedz.wartosc){
                        najwieksza = deepObjCopy(krawedz);
                      }
                    });
                    vx.push(najwieksza);
                  });



                  zapamietaneWartosci.push(vx);

                  var temp3 = deepObjCopy(zapamietaneWartosci);
                  console.log('vx', temp3);

                }

                var przedmioty = [];
                var iterator = 0;

                $scope.produktyDoWziecia = znajdzElementSciezki(zapamietaneWartosci);

                console.log($scope.produktyDoWziecia);

              };

              var znajdzElementSciezki = function(zapamietaneWartosci){
                var sciezka = [];
                var produkty = [];

                sciezka.push(zapamietaneWartosci[zapamietaneWartosci.length-1][0]);
                for(var i = 1; i<zapamietaneWartosci.length; i++){

                  for(var j =0; j<zapamietaneWartosci[zapamietaneWartosci.length-i-1].length;j++){
                    if(sprawdzCzySaToTeSameWartosci(sciezka[i-1].do, zapamietaneWartosci[zapamietaneWartosci.length-i-1][j].z)){
                      var scie = deepObjCopy(zapamietaneWartosci[zapamietaneWartosci.length-i-1][j]);
                      sciezka.push(scie);
                    }
                  }
                  
                }

                console.log('sciezka', sciezka);

                for (var i =0; i<sciezka.length;i++){
                  if(sciezka[i].decyzja == 1){
                    produkty.push(znajdzRoznice(sciezka[i].z, sciezka[i].do));
                  }
                }

                return produkty;
              };

              var znajdzRoznice = function(z, doo){
                var z = deepObjCopy(z);
                var doo = deepObjCopy(doo);

                window._.each(z, function(id, index){
                  doo.splice(doo.indexOf(id), 1);
                });

                return window._.filter($scope.listaWybranych, function(prod){
                  return prod.id == doo[0];
                })[0];

              };

              var dajMaseObjetoscWartoscZPoprzednichIteracji = function(krawedz1, zapamietane){
                var szukanaKrawedz = null;
                window._.each(zapamietane, function(krawedz2, indeks1){
                    if(sprawdzCzySaToTeSameWartosci(krawedz1.do,krawedz2.z)){
                      szukanaKrawedz = krawedz2;
                    }
                });
                var masaObjetoscWartosc = {
                  wartosc: szukanaKrawedz.wartosc,
                  masa: szukanaKrawedz.zmianaMasy,
                  objetosc: szukanaKrawedz.zmianaObjetosci
                };
                return masaObjetoscWartosc;
              };

              var sprawdzCzySaToTeSameWartosci = function(tablica1, tablica2){
                var ile = 0;
                window._.each(tablica1, function(war1){
                  window._.each(tablica2, function(war2){
                    if(war1 == war2){
                      ile++;
                    }
                  });
                });
                if(ile == tablica1.length){
                  return true;
                } else {
                  return false;
                }
              };

              var stworzListeWybranych = function(){
                $scope.listaWybranych = [];
                var id = 0;
                window._.each($scope.wybraneProdukty, function(prod, index){
                  for(var i = 0; i < prod.liczbaProduktow; i++){
                    var nowyProdukt = window._.clone(prod);
                    delete nowyProdukt.liczbaProduktow;
                    nowyProdukt.id = id;
                    id++;
                    $scope.listaWybranych.push(nowyProdukt);
                  }
                });
                return $scope.listaWybranych;
              };

              var dajMaseWartoscObjetosc = function(z, od){
                var z = deepObjCopy(z);
                var od = deepObjCopy(od);
                window._.each(z, function(id, index){
                  od.splice(od.indexOf(id), 1);
                });
                var produkt = window._.filter($scope.listaWybranych, function(prod){
                  return prod.id == od[0];
                })[0];
                return {
                  wartosc: produkt.wartosc,
                  masa: produkt.masa,
                  objetosc: produkt.objetosc
                };
              };

              var stworzKrawedzie = function(wezly){

                var krawedzie = [];

                var krawedzieDlaEtapu = [];
                window._.each(wezly[1], function(w, index){
                  var masaWartoscObjetosc = dajMaseWartoscObjetosc(wezly[0][0].produkty, w.produkty);
                  krawedzieDlaEtapu.push({
                    z: [],
                    do: w.produkty,
                    wartosc: masaWartoscObjetosc.wartosc,
                    zmianaMasy: masaWartoscObjetosc.masa,
                    zmianaObjetosci: masaWartoscObjetosc.objetosc,
                    decyzja: 1
                  });
                  krawedzieDlaEtapu.push({
                    z: [],
                    do: w.produkty,
                    wartosc: 0,
                    zmianaMasy: 0,
                    zmianaObjetosci: 0,
                    decyzja: 0
                  });
                });

                krawedzie.push(krawedzieDlaEtapu);

                for(var i = 1; i<(wezly.length-1); i++){

                  var krawedzieDlaEtapu = [];

                  for(var j = 0; j<wezly[i].length; j++){

                    var wezlyPolaczone = window._.filter(wezly[i+1], function(wez){
                      return sprawdzCzyWezelJestPolaczony(wezly[i][j], wez);
                    });

                    window._.each(wezlyPolaczone, function(wezlyy, index){
                      var masaWartoscObjetosc = dajMaseWartoscObjetosc(wezly[i][j].produkty, wezlyy.produkty);
                      krawedzieDlaEtapu.push({
                        z: wezly[i][j].produkty,
                        do: wezlyy.produkty,
                        wartosc: masaWartoscObjetosc.wartosc,
                        zmianaMasy: masaWartoscObjetosc.masa,
                        zmianaObjetosci: masaWartoscObjetosc.objetosc,
                        decyzja: 1
                      });
                      krawedzieDlaEtapu.push({
                        z: wezly[i][j].produkty,
                        do: wezlyy.produkty,
                        wartosc: 0,
                        zmianaMasy: 0,
                        zmianaObjetosci: 0,
                        decyzja: 0
                      });
                    });

                  }

                  krawedzie.push(krawedzieDlaEtapu);

                }

                return krawedzie;
              };


              var sprawdzCzyWezelJestPolaczony = function(wez1, wez2){
                var result = true;
                window._.each(wez1.produkty, function(prod1, index){
                  var sprawdzCzyIstnieje = false;
                  window._.each(wez2.produkty, function(prod2, index){
                    if(prod1 == prod2){
                      sprawdzCzyIstnieje = true;
                    }
                  });
                  if(!sprawdzCzyIstnieje){
                    result = false;
                    return result;
                  }
                });
                return result;
              };

              var stworzWezly = function(liczbaProduktow){

                var wezly = [];

                var pierwszyEtap = [{
                  produkty: []
                }];
                wezly.push(pierwszyEtap);
                var drugiEtap = [];
                for(var i = 0; i<liczbaProduktow;i++){
                  drugiEtap.push({
                    produkty: [i]
                  });
                }

                wezly.push(drugiEtap);

                for(var i =1; i<liczbaProduktow; i++){
                  var etap = [];
                  for(var j = 0; j<wezly[i].length; j++){
                     for (var k = 0; k<liczbaProduktow; k++){
                      var klon = deepObjCopy(wezly[i][j]);
                      klon.produkty.push(k);
                      var nowy = {
                        produkty: klon.produkty
                      };
                      if(!sprawdzCzyWezelJestPoprawny(nowy) && sprawdzCzyJestUnikalny(etap, nowy)){
                        etap.push(nowy);
                      }
                     }
                  }
                  wezly.push(etap);
                }

                return wezly;
              };

              var sprawdzCzyWezelJestPoprawny = function(wezel){
                return (new Set(wezel.produkty)).size !== wezel.produkty.length;
              };

              var sprawdzCzyJestUnikalny = function(wezly, wezel){
                var result = true;
                window._.each(wezly, function(wez){
                  var ile = 0;
                  window._.each(wez.produkty, function(prod1){
                    window._.each(wezel.produkty, function(prod2){
                      if(prod1 == prod2){
                        ile++;
                      }
                    });
                  });
                  if(ile == wezel.produkty.length){
                      result = false;
                      return result;
                  }
                });
                return result;
              };

              function deepObjCopy (dupeObj) {
                var retObj = new Object();
                if (typeof(dupeObj) == 'object') {
                  if (typeof(dupeObj.length) != 'undefined')
                    var retObj = new Array();
                  for (var objInd in dupeObj) {
                    if (typeof(dupeObj[objInd]) == 'object') {
                      retObj[objInd] = deepObjCopy(dupeObj[objInd]);
                    } else if (typeof(dupeObj[objInd]) == 'string') {
                      retObj[objInd] = dupeObj[objInd];
                    } else if (typeof(dupeObj[objInd]) == 'number') {
                      retObj[objInd] = dupeObj[objInd];
                    } else if (typeof(dupeObj[objInd]) == 'boolean') {
                      ((dupeObj[objInd] == true) ? retObj[objInd] = true : retObj[objInd] = false);
                    }
                  }
                }
                return retObj;
              }

              $scope.dajSume = function(produkty, para){
                var result = 0;

                window._.each(produkty, function(prod){
                  result+=prod[para];
                });

                return result;
              };

            }]);
        </script>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                font-family: 'Arial';
            }

            .pointer {
              cursor: pointer;
            }

            .container {
              margin-top: 30px;
              margin-bottom: 30px;
            }

        </style>
    </head>
    <body ng-app="app">
        <div class="container" ng-controller="MainController" ng-init="init()">
            <div class="row">
              <div class="form-group col-xs-6">
                    <label for="maskMasa">Maksymalna masa pojazdu</label>
                    <input type="number" class="form-control" id="maskMasa" placeholder="30" ng-model="maksMasa">
              </div>
              <div class="form-group col-xs-6">
                    <label for="maksObjetosc">Maksymalna objetosć pojazdu</label>
                    <input type="number" class="form-control" id="maksObjetosc" placeholder="30" ng-model="maksObjetosc">
              </div>
            </div>
            <!-- <div class="row">
                <div class="form-group col-xs-6">
                  <label for="maskMasa">Nazwa produktu</label>
                  <input type="text" class="form-control" id="maskMasa" placeholder="30" ng-model="maksMasa">
                </div>
            </div> -->
            <div class="row">
                <div class="col-xs-12">
                      <h4>Wybierz produkty</h4>
                      <table class="table">
                        <tr>
                          <th>Akcja</th>
                          <th>Nazwa</th>
                          <th>Liczba sztuk</th>
                          <th>Objetosc</th>
                          <th>Masa</th>
                          <th>Wartosc</th>
                        </tr>
                        <tr ng-repeat="produkt in wszystkieProdukty">
                          <td><span class="pointer" ng-click="dodajProdukt(produkt)" ng-show="produkt.liczbaProduktow != 0">dodaj</span></td>
                          <td>{[{produkt.nazwa}]}</td>
                          <td>{[{produkt.liczbaProduktow}]}</td>
                          <td>{[{produkt.objetosc}]}</td>
                          <td>{[{produkt.masa}]}</td>
                          <td>{[{produkt.wartosc}]}</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>{[{}]}</td>
                          <td>{[{dajSume(wszystkieProdukty, 'liczbaProduktow')}]}</td>
                          <td>{[{dajSume(wszystkieProdukty, 'objetosc')}]}</td>
                          <td>{[{dajSume(wszystkieProdukty, 'masa')}]}</td>
                          <td>{[{dajSume(wszystkieProdukty, 'wartosc')}]}</td>
                        </tr>
                      </table>
                      <h4>Wybrana lista</h4>
                      <table class="table">
                        <tr>
                          <th>Akcja</th>
                          <th>Nazwa</th>
                          <th>Liczba sztuk</th>
                          <th>Objetosc</th>
                          <th>Masa</th>
                          <th>Wartosc</th>
                        </tr>
                        <tr ng-repeat="produkt in wybraneProdukty">
                          <td><span class="pointer" ng-click="usunProdukt(produkt)">usuń</span></td>
                          <td>{[{produkt.nazwa}]}</td>
                          <td>{[{produkt.liczbaProduktow}]}</td>
                          <td>{[{produkt.objetosc}]}</td>
                          <td>{[{produkt.masa}]}</td>
                          <td>{[{produkt.wartosc}]}</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>{[{}]}</td>
                          <td>{[{dajSume(wybraneProdukty, 'liczbaProduktow')}]}</td>
                          <td>{[{dajSume(wybraneProdukty, 'objetosc')}]}</td>
                          <td>{[{dajSume(wybraneProdukty, 'masa')}]}</td>
                          <td>{[{dajSume(wybraneProdukty, 'wartosc')}]}</td>
                        </tr>
                      </table>
                      <h4>Produkty do wziecia</h4>
                      <table class="table">
                        <tr>
                          <th>Nazwa</th>
                          <th>Objetosc</th>
                          <th>Masa</th>
                          <th>Wartosc</th>
                        </tr>
                        <tr ng-repeat="produkt in produktyDoWziecia track by $index">
                          <td>{[{produkt.nazwa}]}</td>
                          <td>{[{produkt.objetosc}]}</td>
                          <td>{[{produkt.masa}]}</td>
                          <td>{[{produkt.wartosc}]}</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>{[{dajSume(produktyDoWziecia, 'objetosc')}]}</td>
                          <td>{[{dajSume(produktyDoWziecia, 'masa')}]}</td>
                          <td>{[{dajSume(produktyDoWziecia, 'wartosc')}]}</td>
                        </tr>
                      </table>
                      <button type="submit" ng-click="sprawdz()" class="btn btn-default">Sprawdz</button>
                </div>
            </div>
        </div>
    </body>
</html>
