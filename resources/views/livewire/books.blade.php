@php
    $title = 'El Astillero - '.__('Books')
@endphp
@section('title', $title)
<div>
    <div class="container mx-auto">
        <h1 class="px-2 py-4 text-xl text-yellow-900 font-bold">Todos los libros</h1>
        <x-separator/>
        <div class="px-6 py-4 grid grid-cols-2 sm:grid-cols-4 gap-2">
            <x-jet-input type="text" wire:model="search" placeholder="Buscar.." class="col-span-4"/>

            <x-select wire:model="sort" class="w-full">
                <option value="" selected disabled>Ordenar por:</option>
                <option value="title">Título</option>
                <option value="summary">Resumen</option>
                <option value="genre">Género</option>
                <option value="author">Autor</option>
                <option value="isbn">ISBN</option>
            </x-select>

            <x-select wire:model="direction" class="w-full">
                <option value="" selected disabled>Ordenar hacia:</option>
                <option value="asc">Ascendente</option>
                <option value="desc">Descendente</option>
            </x-select>

            {{-- <x-jet-dropdown>
                <x-slot name="trigger">
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                            {{ auth()->user()->name }}

                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </x-slot>

                <x-slot name="content">
                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                        {{ __('Profile') }}
                    </x-jet-dropdown-link>
                </x-slot>
            </x-jet-dropdown> --}}
        </div>

        <div class="px-6 py-2 grid grid-rows-1">
            <a wire:click="$set('open_create', true)" class="py-2 px-6 bg-yellow-900 rounded-xl cursor-pointer text-white text-center md:w-24 justify-self-end">Nuevo</a>
        </div>

        <div class="px-6 py-2 md:px-0 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-3 gap-y-4 mb-4">
            @if ($books->count())
                @foreach ($books as $item)
                    <x-card>
                        <x-slot name="source">
                            {{ Storage::url('public/images/books/'.$item->front_image) }}
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

    {{-- modal for create --}}
    <x-jet-dialog-modal wire:model="open_create">
        <x-slot name="title">
            Registrar Libro
        </x-slot>

        <x-slot name="content">
            <div wire:loading wire:target='front_image, back_image' class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Imagen Cargando!</strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen aparezca</span>
            </div>
            @if ($front_image || $back_image)
                @if($front_image)
                    <img src="{{ $front_image->temporaryUrl() }}" class="mb-4">
                @endif

                @if($back_image)
                    <img src="{{ $back_image->temporaryUrl() }}" class="mb-4">
                @endif
            @endif

            <div class="mb-4">
                <x-jet-label value="ISBN"/>
                <x-jet-input type="number" class="w-full" wire:model='isbn'/>
                <x-jet-input-error for="isbn"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Título"/>
                <x-jet-input type="text" class="w-full" wire:model='title'/>
                <x-jet-input-error for="title"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Resúmen"/>
                <textarea rows="7" class="w-full border-gray-300 rounded" wire:model='summary'></textarea>
                <x-jet-input-error for="summary"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Autor"/>
                <x-jet-input type="text" class="w-full" wire:model='author'/>
                <x-jet-input-error for="author"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Género"/>
                <x-jet-input type="text" class="w-full" wire:model='genre'/>
                <x-jet-input-error for="genre"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Editorial"/>
                <x-jet-input type="text" class="w-full" wire:model='publisher'/>
                <x-jet-input-error for="publisher"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Año de Publicación"/>
                <x-jet-input type="text" class="w-full" wire:model='publish_year'/>
                <x-jet-input-error for="publish_year"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Portada"/>
                <input type="file" wire:model='front_image'>
                <x-jet-input-error for="front_image"/>
            </div>

            <div>
                <x-jet-label value="Contra Portada"/>
                <input type="file" wire:model='back_image'>
                <x-jet-input-error for="back_image"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_create', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="create" wire:loading.attr='disabled' wire:target='create, front_image, back_image' class="disabled:opacity-25">
                Registrar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
