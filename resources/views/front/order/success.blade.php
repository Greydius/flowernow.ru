@extends('layouts.site')

@section('content')

    <div class="container">
        <br><br><br><br><br><br><br><br><br><br><br>
        <h1 class="h2 text-center">Спасибо за заказ...</h1>
        <br><br><br><br><br><br><br><br><br><br><br>
    </div>

@endsection

@section('footer')

    <script type="text/javascript">
        setTimeout(function () {
                window.location = '/';
        }, 3000);
    </script>
@stop