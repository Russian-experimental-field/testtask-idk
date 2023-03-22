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
                    <form action="/dashboard/cars/create" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="manuf" class="col-sm-2 col-form-label">Manufacturer</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="manuf" id="manuf"
                                    placeholder="AMERICA" required value="{{ old('manuf') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="model" class="col-sm-2 col-form-label">Model</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="model" id="model"
                                    placeholder="номер 0" required value="{{ old('model') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="engine_vol" class="col-sm-2 col-form-label">Engine volume (in cc)</label>
                            <div class="col-sm-10">
                                <input type="text" name="engine_vol" class="form-control" id="engine_vol"
                                    placeholder="6000" required value="{{ old('engine_vol') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="manuf_date" class="col-sm-2 col-form-label">Manufactured on [Year,
                                month, day]</label>
                            <div class="col-sm-10">
                                <input type="text" name="manuf_date" class="form-control" id="manuf_date"
                                    placeholder="1999 12 01" required value="{{ old('manuf_date') }}">
                            </div>
                        </div>
                        <button style="background: blue" type="submit" class="btn btn-primary">Add car</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
