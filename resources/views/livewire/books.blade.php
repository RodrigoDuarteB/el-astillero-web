@php
    $title = 'El Astillero - '.__('Books')
@endphp
@section('title', $title)
<div>
    <div class="container mx-auto">
        <h1 class="px-3 py-4 text-xl text-yellow-900 font-bold">Todos los libros</h1>
        <x-separator class="mx-3 sm:mx-0"/>
        <div class="px-6 py-4 grid grid-cols-2 sm:grid-cols-4 gap-2">
            <x-jet-input type="text" wire:model="search" placeholder="Buscar.." class="col-span-4"/>

            <x-select wire:model="sort" class="w-full">
                <option value="" selected disabled>Ordenar por:</option>
                <option value="title">Título</option>
                <option value="synopsys">Resumen</option>
                <option value="subject">Género</option>
                <option value="author">Autor</option>
                <option value="isbn13">ISBN</option>
            </x-select>

            <x-select wire:model="direction" class="w-full">
                <option value="" selected disabled>Ordenar hacia:</option>
                <option value="asc">Ascendente</option>
                <option value="desc">Descendente</option>
            </x-select>
        </div>

        <div class="px-6 py-2 grid grid-rows-1 gap-2 sm:grid-cols-2">
            <div class="flex items-center">
                <span class="mr-2">Mostrar</span>
                <x-select wire:model='records' class="w-auto text-center">
                    <option value="8">8</option>
                    <option value="12">12</option>
                    <option value="24">24</option>
                    <option value="36">36</option>
                    <option value="{{ $totalRecords }}">Todos</option>
                </x-select>
            </div>
            <a wire:click="$set('openCreate', true)" class="py-2 px-6 bg-yellow-900 rounded-xl cursor-pointer text-white text-center md:w-24 justify-self-end">Nuevo</a>
        </div>

        <div class="px-6 py-2 md:px-0 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-3 gap-y-4 mb-4">
            @if ($books->count())
                @foreach ($books as $item)
                    <x-card>
                        <x-slot name="source">
                            {{ Storage::url('public/images/books/'.$item->cover) }}
                        </x-slot>
                        <x-slot name="title">
                            {{ $item->title }}
                        </x-slot>
                        <x-slot name="summary">
                            {{ strlen($item->synopsys) > 120 ? substr($item->synopsys, 0, 120).'...' : $item->synopsys }}
                        </x-slot>
                        <x-slot name="others">
                            <p>Género: {{ $item->subject }}</p>
                            <p>Autor: {{ $item->author }}</p>
                            <p>Lenguaje: {{ $item->language }}</p>
                            <p>Páginas: {{ $item->pages }}</p>
                            <p>ISBN 13: {{ $item->isbn13 }}</p>
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
    <x-jet-dialog-modal wire:model="openCreate">
        <x-slot name="title">
            Registrar Libro
        </x-slot>

        <x-slot name="content">
            {{-- Alert for cover and back charging --}}
            <div wire:loading wire:target='cover, back' class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Imagen Cargando!</strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen aparezca</span>
            </div>

            {{-- Alert for isbn search --}}
            <div wire:loading wire:target='isbn13' class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 w-full" role="alert">
                <strong class="font-bold">Buscando Libro!</strong>
                <span class="block sm:inline">Espere un momento a la respuesta!</span>
            </div>
            @if ($apiBook && isset($apiBook["image"]))
                <img src="{{ $apiBook["image"] }}" class="mb-4">
                @if($back)
                    <img src="{{ $back->temporaryUrl() }}" class="mb-4">
                @endif
            @else
                @if ($cover || $back)
                    @if($cover)
                        <img src="{{ $cover->temporaryUrl() }}" class="mb-4">
                    @endif

                    @if($back)
                        <img src="{{ $back->temporaryUrl() }}" class="mb-4">
                    @endif
                @endif
            @endif


            <div class="mb-4">
                <x-jet-label value="ISBN"/>
                <x-jet-input type="number" class="w-full" wire:model='isbn13'/>
                <x-jet-input-error for="isbn13"/>
            </div>
            <p class="text-red-500 mb-4">{{ $message }}</p>
            @if ($apiBook)
                <div class="mb-4">
                    <x-jet-label value="ISBN 10"/>
                    <x-jet-input type="number" class="w-full" wire:model.defer='isbn'/>
                    <x-jet-input-error for="isbn"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Título"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='title'/>
                    <x-jet-input-error for="title"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Título Largo"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='title_long'/>
                    <x-jet-input-error for="title_long"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Clasificación"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='dewey_decimal'/>
                    <x-jet-input-error for="dewey_decimal"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Encuadernado"/>
                    <x-text-area class="w-full" rows="7" wire:model.defer='binding'/>
                    <x-jet-input-error for="binding"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Editorial"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='publisher'/>
                    <x-jet-input-error for="publisher"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Idioma"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='language'/>
                    <x-jet-input-error for="language"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Fecha de Publicación"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='date_published'/>
                    <x-jet-input-error for="date_published"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Edición"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='edition'/>
                    <x-jet-input-error for="edition"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Número de Páginas"/>
                    <x-jet-input type="number" class="w-full" wire:model.defer='pages'/>
                    <x-jet-input-error for="pages"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Dimensiones"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='dimensions'/>
                    <x-jet-input-error for="dimensions"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Resumen"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='overview'/>
                    <x-jet-input-error for="overview"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Pasaje"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='excerpt'/>
                    <x-jet-input-error for="excerpt"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Sinopsis"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='synopsys'/>
                    <x-jet-input-error for="synopsys"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Autor"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='author'/>
                    <x-jet-input-error for="author"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Género"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer='subject'/>
                    <x-jet-input-error for="subject"/>
                </div>

                <div class="mb-4">
                    <x-jet-label value="Stock"/>
                    <x-jet-input type="number" min="0" class="w-full" wire:model.defer='stock'/>
                    <x-jet-input-error for="stock"/>
                </div>

                @if (!isset($apiBook["image"]))
                    <div class="mb-4">
                        <x-jet-label value="Portada"/>
                        <input type="file" wire:model='cover' required/>
                        <x-jet-input-error for="cover"/>
                    </div>
                @endif

                <div>
                    <x-jet-label value="Contra Portada"/>
                    <input type="file" wire:model='back'>
                    <x-jet-input-error for="back"/>
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('openCreate', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="create" wire:loading.attr='disabled' wire:target='create, cover, back' class="disabled:opacity-25">
                Registrar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
