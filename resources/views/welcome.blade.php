<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        
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

              $scope.init = function(){
                $http({
                  method: 'GET',
                  url: '/getAllProducts'
                }).then(function successCallback(response) {
                   $scope.wszystkieProdukty = response.data;
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

                $scope.listaWybranych = stworzListeWybranych();

                drzewoWezly = stworzDrzewo($scope.listaWybranych.length); 

                console.log(drzewoWezly);
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

              var stworzDrzewo = function(liczbaProduktow){

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

            }]);
        </script>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                font-family: 'Lato';
            }

        </style>
    </head>
    <body ng-app="app">
        <div class="container" ng-controller="MainController" ng-init="init()">
            <div class="row">
                <div class="col-xs-12">
                    <form>
                      <div class="form-group">
                        <label for="wielkopscBagaznika">Wybierz wielkosc bagaznika</label>
                        <input type="number" class="form-control" id="wielkopscBagaznika" placeholder="30">
                      </div>
                      <div class="form-group">
                        <label for="maskMasa">Maksymalna masa pojazdu</label>
                        <input type="number" class="form-control" id="maskMasa" placeholder="30">
                      </div>
                      <div class="form-group">
                        <label for="maksObjetosc">Maksymalna objetosć pojazdu</label>
                        <input type="number" class="form-control" id="maksObjetosc" placeholder="30">
                      </div>
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
                          <td><span ng-click="dodajProdukt(produkt)" ng-show="produkt.liczbaProduktow != 0">dodaj</span></td>
                          <td>{[{produkt.nazwa}]}</td>
                          <td>{[{produkt.liczbaProduktow}]}</td>
                          <td>{[{produkt.objetosc}]}</td>
                          <td>{[{produkt.masa}]}</td>
                          <td>{[{produkt.wartosc}]}</td>
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
                          <td><span ng-click="usunProdukt(produkt)">usuń</span></td>
                          <td>{[{produkt.nazwa}]}</td>
                          <td>{[{produkt.liczbaProduktow}]}</td>
                          <td>{[{produkt.objetosc}]}</td>
                          <td>{[{produkt.masa}]}</td>
                          <td>{[{produkt.wartosc}]}</td>
                        </tr>
                      </table>
                      <button type="submit" ng-click="sprawdz()" class="btn btn-default">Sprawdz</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
