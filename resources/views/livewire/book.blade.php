@php
    $title = 'El Astillero - '.$book->title
@endphp
@section('title', $title)
<div>
    <div class="container mx-auto mb-4">
        <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <h2 class="text-yellow-900 text-2xl">{{ $book->title.' - '.$book->isbn13 }}</h2>

            <div class="justify-self-end">
                <a wire:click="$set('open_edit', true)" class="py-2 px-6 bg-green-400 rounded-xl cursor-pointer">Editar</a>

                <a wire:click="$set('open_delete', true)" class="py-2 px-6 bg-red-400 rounded-xl cursor-pointer">Eliminar</a>

                <a wire:click="$set('openApi', true)" class="py-2 px-6 bg-yellow-900 rounded-xl cursor-pointer text-white">API</a>
            </div>
        </div>
        <!-- images --->
        <div class="p-4 grid grid-cols-1 gap-3 md:grid-cols-2">
            <div class="justify-self-center">
                <x-image src="{{ Storage::url('public/images/books/'.$book->cover) }}"/>
            </div>
            <div class="justify-self-center">
                <x-image src="{{ $book->back ? Storage::url('public/images/books/'.$book->back) : Storage::url('public/images/no_image.png') }}"/>
            </div>
        </div>
        {{-- content --}}
        <x-separator class="mt-4 mx-3 sm:mx-0"/>
        <h2 class="text-yellow-900 text-2xl p-4">Información</h2>
        <div class="px-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-card-content class="row-start-2 self-start md:row-start-1">
                <p><span class="font-bold text-yellow-900">Autor: </span> {{ $book->author }}</p>
                <p><span class="font-bold text-yellow-900">Género: </span> {{ $book->subject }}</p>
                <p><span class="font-bold text-yellow-900">Año de Publicación: </span> {{ $book->date_published }}</p>
                <p><span class="font-bold text-yellow-900">Editorial: </span> {{ $book->publisher }}</p>
            </x-card-content>

            <x-card-content class="row-start-1">
                <h2 class="font-bold text-yellow-900">Resumen</h2>
                <p>{{ $book->synopsys }}</p>
            </x-card-content>
        </div>
    </div>

    {{-- modal for edit --}}
    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Editar libro {{ $book->id }} ({{ $book->isbn }})
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
            @else
                <img src="{{ Storage::url('public/images/books/'.$book->front_image) }}" class="mb-4">
                <img src="{{ Storage::url('public/images/books/'.$book->back_image) }}" class="mb-4">
            @endif

            <div class="mb-4">
                <x-jet-label value="ISBN"/>
                <x-jet-input type="number" class="w-full" wire:model='book.isbn' disabled/>
                <x-jet-input-error for="book.isbn"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Título"/>
                <x-jet-input type="text" class="w-full" wire:model='book.title'/>
                <x-jet-input-error for="book.title"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Resúmen"/>
                <textarea rows="7" class="w-full border-gray-300 rounded" wire:model='book.summary'></textarea>
                <x-jet-input-error for="book.summary"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Autor"/>
                <x-jet-input type="text" class="w-full" wire:model='book.author'/>
                <x-jet-input-error for="book.author"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Género"/>
                <x-jet-input type="text" class="w-full" wire:model='book.genre'/>
                <x-jet-input-error for="book.genre"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Editorial"/>
                <x-jet-input type="text" class="w-full" wire:model='book.publisher'/>
                <x-jet-input-error for="book.publisher"/>
            </div>

            <div class="mb-4">
                <x-jet-label value="Año de Publicación"/>
                <x-jet-input type="text" class="w-full" wire:model='book.publish_year'/>
                <x-jet-input-error for="book.publish_year"/>
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
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update" wire:loading.attr='disabled' wire:target='update, front_image, back_image' class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- modal for delete --}}
    <x-jet-dialog-modal wire:model="open_delete">
        <x-slot name="title">
            Eliminar libro {{ $book->id.' - isbn: '.$book->isbn}}
        </x-slot>

        <x-slot name="content">
            <p>¿Está Seguro que desea eliminar el libro? <span class="font-extrabold">La acción es irreversible</span></p>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_delete', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="delete" wire:loading.attr='disabled' wire:target='delete' class="disabled:opacity-25">
                Eliminar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- modal for API TEST --}}
    <x-jet-dialog-modal wire:model="openApi">
        <x-slot name="title">
            Prueba API {{ $isbn }}
        </x-slot>

        <x-slot name="content">
            @php
                $n = $message ? '2' : '1'
            @endphp
            {{-- Search by isbn --}}
            <div class="grid grid-rows-{{ $n }} gap-2">
                <div class="mb-4">
                    <x-jet-label value="ISBN"/>
                    <x-input type="number" class="w-full" autofocus wire:model='isbn'/>
                    <x-jet-input-error for="isbn"/>
                </div>
                <p class="text-red-500">{{ $message }}</p>
            </div>

            {{-- Search by title --}}
            @if ($message)
                <div class="grid grid-cols-3 gap-2">
                    <div class="mb-4 col-span-2">
                        <x-jet-label value="Título"/>
                        <x-jet-input type="text" class="w-full" wire:model='title'/>
                        <x-jet-input-error for="title"/>
                    </div>

                    <x-jet-danger-button wire:click="getByTitle" wire:loading.attr='disabled' wire:target='getByIsbn, getByTitle' class="disabled:opacity-25 self-center">
                        Buscar
                    </x-jet-danger-button>
                </div>
            @endif

            @if ($api)
                @if (isset($api->image))
                    <img src="{{ $api->image }}" class="mb-4">
                @endif
                <div class="mb-4">
                    <x-jet-label value="Título"/>
                    <x-jet-input type="text" class="w-full" value="{{ isset($api->title) ? $api->title : '' }}"/>
                    {{-- <x-jet-input-error for="apiBook.title"/> --}}
                </div>

                <div class="mb-4">
                    <x-jet-label value="Edición"/>
                    <x-jet-input type="text" class="w-full" value="{{ isset($api->edition) ? $api->edition : '' }}"/>
                    {{-- <x-jet-input-error for="apiBook.title"/> --}}
                </div>

                <div class="mb-4">
                    <x-jet-label value="Páginas"/>
                    <x-jet-input type="text" class="w-full" value="{{ isset($api->pages) ? $api->pages : '' }}"/>
                    {{-- <x-jet-input-error for="apiBook.title"/> --}}
                </div>

                <div class="mb-4">
                    <x-jet-label value="Author"/>
                    <x-jet-input type="text" class="w-full" value="{{ isset($api->authors) ? $api->authors[0] : '' }}"/>
                    {{-- <x-jet-input-error for="apiBook.title"/> --}}
                </div>

                <div class="mb-4">
                    <x-jet-label value="isbn 10"/>
                    <x-jet-input type="text" class="w-full" value="{{ isset($api->isbn) ? $api->isbn : '' }}"/>
                    {{-- <x-jet-input-error for="apiBook.title"/> --}}
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openApi', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update" wire:loading.attr='disabled' wire:target='update, front_image, back_image' class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
