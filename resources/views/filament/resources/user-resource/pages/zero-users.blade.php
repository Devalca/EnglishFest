<x-filament-panels::page>
    @php
        $cek = $this->record;
    @endphp
    @if (auth()->user()->is_admin == true)
        @if ($cek->email == 'saepul.rahman@nusaputra.ac.id')
            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                    <div class="mx-auto max-w-screen-sm text-center">
                        <h1
                            class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">
                            404</h1>
                        <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">
                            Something's
                            missing.</p>
                        <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Sorry, we can't find that
                            page.
                            You'll find lots to explore on the home page. </p>
                    </div>
                </div>
            </section>
        @else
            <x-filament-panels::form wire:submit="save">
                {{ $this->form }}

                <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
            </x-filament-panels::form>

            @if (count($relationManagers = $this->getRelationManagers()))
                <x-filament-panels::resources.relation-managers :active-manager="$this->activeRelationManager" :managers="$relationManagers" :owner-record="$record"
                    :page-class="static::class" />
            @endif
        @endif
    @else
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-sm text-center">
                    <h1
                        class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">
                        404</h1>
                    <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">
                        Something's
                        missing.</p>
                    <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Sorry, we can't find that page.
                        You'll find lots to explore on the home page. </p>
                </div>
            </div>
        </section>
    @endif
</x-filament-panels::page>
