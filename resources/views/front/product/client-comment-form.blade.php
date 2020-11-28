<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Floristum.ru - Добавить отзыв</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="{{ asset('assets/front/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/custom.css?v=20190305') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/custom_media.css?v=20190305') }}">

    <style>
        body {
            padding-top: 10px;
        }


    </style>

</head>

<body>

<div class="container">
    <header>
        <a class="navbar-brand logo" href="/"></a>
    </header>
</div>


<div class="container">

    @if(!empty($msg))
        <p class="lead">{!! $msg !!}</p>
    @else

        <div class="row">
            <div class="col-xs-12">

                <div class="media order-total-cost">
                    <div class="media-left">
                        @if(empty($product->single))
                            <img class="media-object img-circle" width="80" height="80" src="{{ asset('/uploads/products/632x632/'.$product->shop->id.'/'.$product->photo) }}" alt="...">
                        @else
                            <img class="media-object img-circle" width="80" height="80" src="{{ asset('/uploads/single/'.$product->photo) }}" alt="...">
                        @endif
                    </div>
                    <div class="media-body">
                        <p class="lead">{{ empty($product->single) ? $product->name : $product->singleProduct->parent->name }}</p>
                    </div>
                </div>

            </div>
        </div>



        <form method="post" action="{{ route('feedback.create', ['key' => $order->key]) }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleFormControlSelect1">Оценка</label>
                <br>
                <label class="radio-inline"><input type="radio" name="rating" value="1">1</label>
                <label class="radio-inline"><input type="radio" name="rating" value="2">2</label>
                <label class="radio-inline"><input type="radio" name="rating" value="3">3</label>
                <label class="radio-inline"><input type="radio" name="rating" value="4">4</label>
                <label class="radio-inline"><input type="radio" name="rating" value="5" checked>5</label>
            </div>
            <div class="form-group">
                <label for="feedback">Ваш отзыв</label>
                <textarea class="form-control" id="feedback" name="feedback" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>

        <br>

        <p class="lead">Напишите отзыв и получите скидку на следующую покупку до 30%! Ваше мнение очень важно для нас.</p>

    @endif

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
