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
                    <p>Your reservations</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Starts at</th>
                                <th scope="col">Ends at</th>
                                <th scope="col">Car</th>
                                <th scope="col"></th>
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
                                    <td><a class="btn btn-primary"
                                            href="{{ route('adm/reservations/cancel', ['id' => $res->id]) }}">Cancel</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
