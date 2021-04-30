@section('title', __('Books'))
<div>
    <div class="container mx-auto">
        <h1 class="mx-2 my-4 text-xl text-yellow-900 font-bold">Todos los libros</h1>
        <div class="px-6 py-4 flex items-center">
            <x-jet-input type="text" wire:model="search" class="flex-1 mr-4" placeholder="Buscar.."/>
        </div>
        <div class="px-6 py-4 flex items-center">
            <select name="sort" id="sort" class="mr-2" wire:model="sort">
                <option value="" selected disabled>Ordenar por:</option>
                <option value="title">Título</option>
                <option value="summary">Resumen</option>
                <option value="genre">Género</option>
                <option value="author">Autor</option>
                <option value="isbn">ISBN</option>
            </select>

            <select name="dir" id="dir" class="mr-2" wire:model="direction">
                <option value="" selected disabled>Ordenar hacia:</option>
                <option value="asc">Ascendente</option>
                <option value="desc">Descendente</option>
            </select>

        </div>
        <div class="grid grid-cols-4 gap-x-3 gap-y-4 mb-4">
            @if ($books->count())
                @foreach ($books as $item)
                    <x-card>
                        <x-slot name="source">
                            {{ asset('storage/images/'.$item->front_image)}}
                        </x-slot>
                        <x-slot name="title">
                            {{ $item->title }}
                        </x-slot>
                        <x-slot name="summary">
                            {{ $item->summary }}
                        </x-slot>
                        <x-slot name="others">
                            <p>Género: {{ $item->genre }}</p>
                            <p>Autor: {{ $item->author }}</p>
                            <p>ISBN: {{ $item->isbn }}</p>
                            <a href="{{ route('book', $item) }}">Ver</a>
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
