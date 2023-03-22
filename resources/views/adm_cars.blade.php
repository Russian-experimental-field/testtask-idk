<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Manufacturer</th>
                                <th scope="col">Model</th>
                                <th scope="col">Engine vol.</th>
                                <th scope="col">Manufactured on [Year, Month]</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($car as $car)
                                <tr>
                                    <th scope="row">{{ $car->id }}</th>
                                    <td>{{ $car->manufacturer }}</td>
                                    <td>{{ $car->model }}</td>
                                    <td>{{ $car->engine_volume }}</td>
                                    <td>{{ date('Y, M', strtotime($car->manufactured_at)) }}</td>
                                    <td><a class="btn btn-primary"
                                            href="{{ route('adm/cars/delete', ['id' => $car->id]) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div style="text-align: center">
                    <a href="/dashboard/cars/create" class="btn btn-primary mb-3">Add cars</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
