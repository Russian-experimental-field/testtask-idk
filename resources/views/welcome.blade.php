@extends('layouts/root')

@section('title', 'Welcome, mf!')

@section('content')
    <div class="container">
        <h1>
            Welcome, MF!
        </h1>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-6">
                <p>Your reservations</p>
                @if (!$userHasEmail)
                    <div>
                        <form action="/userEmail" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="input-data" class="form-label">Ваш email:</label>
                                <input type="text" class="form-control" id="input-data" name="useremail"
                                    placeholder="email">
                            </div>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </form>
                    </div>
                @endif

                @if ($userHasEmail)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Starts at</th>
                                <th scope="col">Ends at</th>
                                <th scope="col">Car</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservation as $res)
                                <tr>
                                    <th scope="row">{{ $res->id }}</th>
                                    <td>{{ $res->created_at }}</td>
                                    <td>{{ $res->starts_at }}</td>
                                    <td>{{ $res->ends_at }}</td>
                                    <td>
                                        @if ($res->car === null)
                                            Тачки нет, сорян
                                        @else
                                            {{ $res->car->manufacturer }} {{ $res->car->model }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div>
                        <h2>
                            Кажется, вы не создавали никаких резерваций, вы можете сделать это с помощью списка
                            автомобилей
                            справа
                        </h2>
                    </div>
                @endif
            </div>
            <div class="col-6">
                <p>Avalible cars</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Manufacturer</th>
                            <th scope="col">Model</th>
                            <th scope="col">Engine volume</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                            <tr>
                                <th scope="row"> {{ $car->id }}</th>
                                <td>{{ $car->manufacturer }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->engine_volume }}</td>
                                <td><a href="/reservation?id={{ $car->id }}" target="_blank"
                                        class="btn btn-primary">Резерв</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @parent
@endsection
