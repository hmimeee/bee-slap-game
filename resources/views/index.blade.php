<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bee Slap Game</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="container-md mt-5">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    @if ($bee)
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <h5 class="card-title">{{ $bee->name }}</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Current Points: {{ $bee->points }}</li>
                                <li class="list-group-item">Deduction: {{ $deductions[$bee->type] }}</li>
                            </ul>
                            <a href="{{ route('hit', $bee->id) }}" class="btn btn-primary">Hit This Bee</a>
                            <a href="{{ route('reset') }}" class="btn btn-danger">Reset All</a>
                        </div>
                    @else
                        <div class="card-body">
                            <div class="alert alert-danger">Game over, no bees are alive</div>
                            <a href="{{ route('reset') }}" class="btn btn-danger">Reset Again</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bees as $bee)
                                    <tr>
                                        <td>{{ $bee->name }}</td>
                                        <td>{{ $bee->points <= 0 ? 'Dead' : 'Alive' }}</td>
                                        <td>{{ $bee->points }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
