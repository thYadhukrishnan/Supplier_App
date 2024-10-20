
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Supplier_app</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .w-a{
            width: auto;
        }
    </style>

</head>
<body>

    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('listPurchaseOrder')}}">Purchase Order</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('listItem')}}">Items</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('listSupplier')}}">Suppliers</a>
            </li>
          </ul>
        </div>
      </nav>

    @yield('content')
</body>
</html>