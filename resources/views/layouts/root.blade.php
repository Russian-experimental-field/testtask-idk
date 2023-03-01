<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/css/lib/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        h2 {
            border: 3px solid color: red;
        }
    </style>
    <!-- integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC">-->
    <title>Cars reservation @yield('title')</title>
</head>

<body>
    @section('content')
        <div class="container">
            @include('components.links')
        </div>
    @show
</body>

</html>
