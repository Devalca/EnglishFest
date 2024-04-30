<x-app>
    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow ">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900 ">
                        Daftar {{ $contests->program_name }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('submitContests') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user() == null ? '' : auth()->user()->id }}">
                    <input type="hidden" name="contest_id" value="{{ $contests->id }}">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="coach_name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                                Pembimbing</label>
                            <input type="text" name="coach_name" id="coach_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="Nama Pembimbing">
                        </div>
                        <div class="col-span-2">
                            <label for="coach_phone" class="block mb-2 text-sm font-medium text-gray-900 ">Nomor
                                Telephone</label>
                            <input type="text" name="coach_phone" id="coach_phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="Nomor Telephone" pattern="[0-9]{10,12}"
                                title="Nomor telepon harus terdiri dari 10 hingga 12 digit angka">

                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Daftar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <section class="py-11 lg:py-0">
    </section>

    <section class="bg-white px-5 lg:px-0 py-5">
        <div class="grid max-w-screen-xl mx-auto lg:gap-8 xl:gap-0 lg:pt-32 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="lg:text-left text-center max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl">
                    {{ $contests->program_name }}</h1>
                <p class="lg:text-left text-center max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">{{ $contests->desc }}
                </p>
                <a href="{{ asset('storage/' . $contests->guidelines) }}"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
                    Unduh Panduan
                </a>
                @if (Auth::user())
                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                        Mendaftar Lomba
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                @else
                    <a href="/user/login"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                        Mendaftar Lomba
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                @endif
                @if (count($compes) > 0)
                    <a href="/user/competitions"
                        class="bg-[#1a9df7] rounded-md text-white hover:text-[#1a9df7] hover:bg-white border hover:border-[#1a9df7] inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center">
                        Daftarkan Peserta
                    </a>
                @endif
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <div class="rounded-lg overflow-hidden border-2 border-gray-300 w-72">
                    <img class="object-cover w-full h-full" src="{{ asset('storage/' . $contests->image) }}"
                        alt="Avatar AAAAAANGGGGG">
                </div>
            </div>
        </div>
    </section>

    <div class="py-2 px-5 lg:px-0">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-4 border-[#1a9df7]">
                    @include('components.htm')
                </div>
            </div>
        </div>
    </div>

    <section class="py-6 mx-auto max-w-screen-xl px-5 lg:px-0">
        <div class="mb-4 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="persyaratan-tab"
                        data-tabs-target="#persyaratan" type="button" role="tab" aria-controls="persyaratan"
                        aria-selected="false">PERSYARATAN</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 "
                        id="ketentuan-tab" data-tabs-target="#ketentuan" type="button" role="tab"
                        aria-controls="ketentuan" aria-selected="false">KETENTUAN DAN TAHAPAN</button>
                </li>
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 "
                        id="penilaian-tab" data-tabs-target="#penilaian" type="button" role="tab"
                        aria-controls="penilaian" aria-selected="false">ASPEK PENILAIAN</button>
                </li>
                <li role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 "
                        id="hadiah-tab" data-tabs-target="#hadiah" type="button" role="tab"
                        aria-controls="hadiah" aria-selected="false">HADIAH DAN PENGHARGAAN</button>
                </li>
            </ul>
        </div>
        <div id="default-tab-content">
            <div class="hidden p-4 rounded-lg bg-gray-50 overflow-auto" id="persyaratan" role="tabpanel"
                aria-labelledby="persyaratan-tab">
                <div class="text-sm text-gray-500">{!! $contests->condition !!}</div>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 overflow-auto" id="ketentuan" role="tabpanel"
                aria-labelledby="ketentuan-tab">
                <div class="text-sm text-gray-500 ">{!! $contests->terms !!}</div>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 overflow-auto" id="penilaian" role="tabpanel"
                aria-labelledby="penilaian-tab">
                <div class="text-sm text-gray-500 ">{!! $contests->assessment !!}</div>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 overflow-auto" id="hadiah" role="tabpanel"
                aria-labelledby="hadiah-tab">
                <div class="text-sm text-gray-500 ">{!! $contests->awards !!}</div>
            </div>
        </div>
    </section>
</x-app>
