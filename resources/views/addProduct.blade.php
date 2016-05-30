<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.css">


        <script src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.13.1/lodash.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>


    </head>

    <body>
        
    <style type="text/css">
        .message{
            margin-top: 40px;
        }
    </style>
    </body>

        <div class="container">
            @if (Session::has('correctAddProduct'))
                <div class="row">
                    <div class="col-xs-12">
                        <div class="alert alert-success message" role="alert">
                            {{ Session::get('correctAddProduct') }}
                        </div>
                    </div>
                </div>
            @endif


            <div class="row">
                <div class="col-xs-12">
                    {!! Form::open(array('url' => '/addProductToDatabase')) !!}
        
                    <!-- <div class="modal-body"> -->
                    <div class="row message">
                      <div class="col-xs-6">
                        <div class="form-group">
                            <label for="nazwa">Nazwa</label>
                            <input type="text" class="form-control" name="nazwa" required>
                            {{ $errors->first('nazwa')}}

                        </div>

                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                        <label for="miasto">Miasto</label> <br>
                        {!! Form::select('miasto', $miasta, '', ['class'=> 'form-control', 'required']) !!}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-6">
                            <div class="form-group">
                            <label for="masa">Masa</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="masa" min="1" max="5000" value="10"  required>
                                <div class="input-group-addon">kg</div>
                            </div>                           
                             {{ $errors->first('masa')}}

                            </div>
                      </div>
                      <div class="col-xs-6">
                            <div class="form-group">
                            <label for="objetosc">Objętosć</label>
                            <div class="input-group">
                                    <input type="number" class="form-control" name="objetosc" required min="1" max="5000" value="10">
                                  <div class="input-group-addon">l</div>
                            </div>
                            {{ $errors->first('objetosc')}}

                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                        <label for="wartosc">Wartosć</label>
                        <div class="input-group">
                          <input type="number" class="form-control" min="1" max="5000" value="10" name="wartosc" required>
                          <div class="input-group-addon">zł</div>
                        </div>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                        <label for="lsztuk">Liczba sztuk</label>
                        <div class="input-group">
                          <input type="number" class="form-control" min="1" max="5000" value="10" name="lsztuk" required>
                          <div class="input-group-addon">sztuk</div>
                        </div>
                        </div>
                      </div>
                    </div>
                  <!-- </div> -->
                  <!-- <div class="modal-footer"> -->
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button> -->
                    <div class="pull-right">
                        <a href="/"><button type="button" class="btn btn-default">Wróć</button></a>
                        {!! Form::submit('Dodaj produkt', ['class' => 'btn btn-primary']) !!}
                    </div>
                <!-- </div> -->

                {!! Form::close() !!}
                </div>
            </div>
        </div>

    </body>
</html>
