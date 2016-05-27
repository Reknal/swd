<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

        <script>
            var app = angular.module('app',[]);

            app.controller('MainController', ['$scope', '$http', function($scope,  $http) {
              $scope.init = function(){
                $http({
                  method: 'GET',
                  url: '/getAllProducts'
                }).then(function successCallback(response) {
                   console.log(data);
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
                width: 100%;
                display: table;
                font-weight: 100;
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
                        <label for="wielkopscPlecaka">Wybierz wielkosc plecaka</label>
                        <input type="number" class="form-control" id="wielkopscPlecaka" placeholder="30">
                      </div>
                      <div class="form-group">
                        <label for="wielkopscPlecaka">Maksymalna masa pojazdu</label>
                        <input type="number" class="form-control" id="wielkopscPlecaka" placeholder="30">
                      </div>
                      <div class="form-group">
                        <label for="wielkopscPlecaka">Maksymalna objetosć pojazdu</label>
                        <input type="number" class="form-control" id="wielkopscPlecaka" placeholder="30">
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Komputer 5kg 30m^3
                        </label>
                      </div>
                      <button type="submit" class="btn btn-default">Sprawdz</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
