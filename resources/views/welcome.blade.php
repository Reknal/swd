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
                      <button type="submit" class="btn btn-default">Sprawdz</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
