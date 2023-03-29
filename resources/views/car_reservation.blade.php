@extends('layouts/root')

@section('title', 'Welcome, mf!')

@section('content')
    <div class="container">
        <div>
            <h1>Резервация Автомобиля</h1>
        </div>
        <h2 style="border: 4px solid blue">
            {{ $car->manufacturer }} {{ $car->model }}
        </h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div>
            <form action="/reservation" method="POST">
                @csrf
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" name="car_id" value="{{ $car->id }}" />
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Время начала</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="starts_at" id="starts_at"
                            placeholder="01.12.2000 12:00" required value="{{ old('starts_at') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Время начала</label>
                    <div class="col-sm-10">
                        <select name="duration" class="form-select form-select mb-3" aria-label=".form-select-lg example"
                            required>
                            <option selected disabled>Длительность</option>
                            <option value="1">15 минут</option>
                            <option value="2">30 минут</option>
                            <option value="3">45 минут</option>
                            <option value="4">1 час</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail3"
                            placeholder="youremail@example.com" required value="{{ old('email') }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Создать резервацию</button>
            </form>
        </div>
    </div>
    @parent
@endsection
