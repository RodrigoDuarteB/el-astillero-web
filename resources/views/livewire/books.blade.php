@section('title', __('Books'))
<div>
    <div class="container mx-auto">
        <h1 class="px-2 py-4 text-xl text-yellow-900 font-bold">Todos los libros</h1>
        <div class="px-6 py-4 grid grid-cols-2 sm:grid-cols-4 gap-2">
            <x-jet-input type="text" wire:model="search" placeholder="Buscar.." class="col-span-4"/>

            <select name="sort" id="sort" wire:model="sort" class="w-auto">
                <option value="" selected disabled>Ordenar por:</option>
                <option value="title">Título</option>
                <option value="summary">Resumen</option>
                <option value="genre">Género</option>
                <option value="author">Autor</option>
                <option value="isbn">ISBN</option>
            </select>

            <select name="dir" id="dir" wire:model="direction" class="w-auto">
                <option value="" selected disabled>Ordenar hacia:</option>
                <option value="asc">Ascendente</option>
                <option value="desc">Descendente</option>
            </select>

        </div>
        <div class="px-6 md:px-0 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-3 gap-y-4 mb-4">
            @if ($books->count())
                @foreach ($books as $item)
                    <x-card>
                        <x-slot name="source">
                            {{ asset('storage/images/books/'.$item->front_image)}}
                        </x-slot>
                        <x-slot name="title">
                            {{ $item->title }}
                        </x-slot>
                        <x-slot name="summary">
                            {{ strlen($item->summary) > 120 ? substr($item->summary, 0, 120).'...' : $item->summary }}
                        </x-slot>
                        <x-slot name="others">
                            <p>Género: {{ $item->genre }}</p>
                            <p>Autor: {{ $item->author }}</p>
                            <p>ISBN: {{ $item->isbn }}</p>
                            <a href="{{ route('book', $item) }}" class="mt-3 p-2 rounded bg-yellow-900 text-white block text-center">Ver</a>
                        </x-slot>
                    </x-card>
                @endforeach
            @else
                <p class="px-6 py-4 col-span-4">No hay Libros registrados, o los filtros no coinciden...</p>
            @endif
        </div>
        @if ($books->hasPages())
            <div class="px-6 py-3">
                {{ $books->links() }}
            </div>
        @endif
    </div>
</div>
