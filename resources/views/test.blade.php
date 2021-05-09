<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-2">
        {{-- <x-select class="w-auto">
            <div class="cursor-pointer">
                <option value="">1</option>
                <option value="">2</option>
            </div>
        </x-select>
        <a href="{{ route('api.books') }}">Libros Api</a>
        <a href="{{ route('api.book.show', 39) }}">Libro Api</a> --}}
        <x-input type="text" autofocus disabled/>
    </div>
</x-app-layout>
