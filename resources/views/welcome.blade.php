<x-app>

    <div id="home" class="lg:pb-28 pb-8">
        <section id="header" class="bg-white">
            <div
                class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 text-center lg:text-left">
                <div class="lg:mr-auto mt-20 place-self-center lg:col-span-6">
                    <p class="max-w-2xl mb-4">Selamat Datang di</p>
                    <h1
                        class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl ">
                        English Fest <span class="text-[#1a9df7] font-extrabold">2024</span></h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">Englsih Fest adalah
                        program kerja tahunan dari English Club Nusa Putra
                        University yang diadakan sebagai wadah minat dan bakat siswa/i di seluruh Indonesia dalam
                        berbahasa Inggris.</p>
                    <a href="/user/login"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-[#1a9df7] border border-[#1a9df7] hover:text-white hover:bg-[#1a9df7] rounded-full">
                        START EXPLORING
                    </a>
                </div>
                <div class="hidden lg:mt-20 lg:col-span-6 lg:flex lg:px-0">
                    <img src="{{ asset('assets/img/team.png') }}" alt="English Fest">
                </div>
            </div>
        </section>
    </div>

    <section class="bg-[#f9fafb]">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            {{-- <h1 class="text-center mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl lg:text-6xl">
                We support the potential of all students</h1> --}}
            <figure class="max-w-screen-md mx-auto text-center">
                <svg class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                    <path
                        d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z" />
                </svg>
                <blockquote>
                    <p class="text-2xl italic font-medium text-gray-900 dark:text-white">"Set Your Dream Alight, Let
                        Your Imagination Take Flight."</p>
                </blockquote>
            </figure>
            {{-- <p class="text-center mb-6 text-lg font-normal lg:text-xl sm:px-16 xl:px-48">
                Kegiatan ini terbuka untuk seluruh siswa/i di Indonesia tanpa terkecuali, dengan timeline pelaksanaan
                tertera pada paduan perlombaan.</p> --}}
            <div class="inline-flex items-center justify-center w-full">
                <hr class="w-64 h-1 my-8 bg-gray-200 border-0 rounded ">
                <div class="absolute px-4 -translate-x-1/2 bg-[#f9fafb] left-1/2 ">
                    <svg aria-hidden="true" class="w-5 h-5" viewBox="0 0 24 27" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                            fill="currentColor" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <div id="compe">
        <section class="bg-white">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
                <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">Bidang
                        Kompetisi</h2>
                    <p class="font-light text-gray-500 lg:mb-16 sm:text-xl">Pilihlah bidang kompetisi
                        yang sesuai untuk kalian</p>
                </div>
                @foreach ($contests as $item)
                    <h4 class="mb-5 text-3xl font-extrabold text-gray-900 text-center lg:text-left">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r to-[#7150b5] from-sky-400">
                            {{ $item->program_name }}
                        </span>
                    </h4>
                    <div class="grid gap-4 md:grid-cols-2" style="height: 220px">
                        @foreach ($programs->where('parent_id', $item->id) as $prog)
                            <div class="grid grid-rows-2 grid-flow-col gap-2">
                                <a href="{{ route('home.contestDetail', ['contest' => $prog]) }}"
                                    class="overflow-hidden transition duration-300 transform hover:-translate-y-1">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 relative">
                                            <div class="rounded-lg overflow-hidden border-2 border-gray-300 w-36 h-36">
                                                <img class="object-cover w-full h-full"
                                                    src="{{ asset('storage/' . $prog->image) }}"
                                                    alt="Avatar AAAAAANGGGGG">
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-xl font-semibold text-[#1a9df7]">{{ $prog->program_name }}
                                            </div>
                                            <p class="line-clamp-2 py-2">{{ $prog->desc }}</p>
                                            <div class="flex">
                                                <span
                                                    class="bg-green-200 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-green-400">
                                                    {{ \Carbon\Carbon::parse($prog->time_start)->format('d - m - Y') }}
                                                </span>
                                                <span
                                                    class="bg-red-200 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-red-400">
                                                    {{ \Carbon\Carbon::parse($prog->time_end)->format('d - m - Y') }}
                                                </span>
                                            </div>
                                            <hr class="mt-2">
                                        </div>
                                    </div>
                                </a>
                                <div class="my-2">
                                    <a href="{{ asset('storage/' . $prog->guidelines) }}"
                                        class="py-2.5 px-5 text-sm font-medium text-[#39bcf7] hover:bg-[#39bcf7] rounded-lg border border-[#39bcf7] hover:text-white"
                                        download>Unduh Panduan</a>
                                </div>
                            </div>
                            {{-- <div class="items-center bg-[#1a9df7] rounded-lg shadow sm:flex ">
                                <img class="ml-2 w-36 border rounded-lg" src="{{ asset('storage/' . $prog->image) }}"
                                    alt="Bonnie Avatar">
                                <div class="p-5">
                                    <h3 class="text-xl font-bold tracking-tight text-white">
                                        {{ $prog->program_name }}
                                    </h3>
                                    <div class="my-5">
                                        <a href="{{ asset('storage/' . $prog->guidelines) }}"
                                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
                                            download>Unduh Panduan</a>
                                    </div>
                                </div>
                            </div> --}}
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <div id="contact">
        <section class="bg-[#f9fafb] py-14 px-8">
            <p class="text-center mb-6 text-lg font-normal lg:text-xl sm:px-16 xl:px-48">
                English Fest merupakan hasil rancangan English Club Nusa Putra University, dibantu oleh pihak kampus
                sebagai
                support utama dalam pembinaan kegiatan ini. Klik tombol dibawah ini untuk gabung di group whatsapp </p>
            <p class="text-center mb-6 text-lg font-normal lg:text-xl sm:px-16 xl:px-48">
                Semua cabang lomba tersebut diperuntukkan untuk siswa/i tingkat SMA/SMK/Sederajat.</p>

            <div class="flex flex-wrap justify-center">
                <!-- Card 1: WhatsApp -->
                <a href="https://api.whatsapp.com/send?phone=6285720978940" target="_blank"
                    class="border border-green-500 max-w-sm w-full mx-4 my-4 bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center px-6 py-4">
                        <div class="flex-shrink-0">
                            <svg class=" w-16 h-16 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z"
                                    clip-rule="evenodd" />
                                <path fill="currentColor"
                                    d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <div class="text-xl font-semibold text-green-500">WhatsApp</div>
                            <div class="mt-2 text-gray-600">Kirim pesan WhatsApp</div>
                            <div class="mt-2">
                                <span class="text-green-500 hover:underline">Klik di sini</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Card 2: Email -->
                <a href="mailto:englishclub@nusaputra.ac.id" target="_blank"
                    class="border border-[#1a9df7] max-w-sm w-full mx-4 my-4 bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center px-6 py-4">
                        <div class="flex-shrink-0">
                            <svg class="w-16 h-16 text-[#1a9df7]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M2.038 5.61A2.01 2.01 0 0 0 2 6v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6c0-.12-.01-.238-.03-.352l-.866.65-7.89 6.032a2 2 0 0 1-2.429 0L2.884 6.288l-.846-.677Z" />
                                <path
                                    d="M20.677 4.117A1.996 1.996 0 0 0 20 4H4c-.225 0-.44.037-.642.105l.758.607L12 10.742 19.9 4.7l.777-.583Z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <div class="text-xl font-semibold text-[#1a9df7]">Email</div>
                            <div class="mt-2 text-gray-600">Kirim email</div>
                            <div class="mt-2">
                                <span class="text-[#1a9df7] hover:underline">Klik di sini</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Card 3: Instagram -->
                <a href="https://www.instagram.com/englishfest_nsp/" target="_blank"
                    class="border border-pink-500 max-w-sm w-full mx-4 my-4 bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center px-6 py-4">
                        <div class="flex-shrink-0">
                            <svg class="w-16 h-16 text-pink-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <div class="text-xl font-semibold text-pink-500">Instagram</div>
                            <div class="mt-2 text-gray-600">Kunjungi profil Instagram kami</div>
                            <div class="mt-2">
                                <span class="text-pink-500 hover:underline">Klik di sini</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="py-2">
                <div class="px-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                        <div class="p-6 bg-white border-4 border-[#1a9df7]">
                            @include('components.htm')
                        </div>
                    </div>
                </div>
            </div>

            <div class="inline-flex items-center justify-center w-full">
                <hr class="w-64 h-1 my-8 bg-gray-200 border-0 rounded">
                <div class="absolute px-4 -translate-x-1/2 bg-[#f9fafb] left-1/2">
                    <svg aria-hidden="true" class="w-5 h-5" viewBox="0 0 24 27" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                            fill="currentColor" />
                    </svg>
                </div>
            </div>
        </section>
    </div>

    <div id="about" class="lg:py-16">
        <section class="mx-auto max-w-screen-xl px-5 lg:px-0 pb-16">
            <h1 class="text-4xl font-bold text-center mb-8">Tentang Kami</h1>
            <div class="flex flex-col md:flex-row items-center justify-center gap-8">
                <div class="max-w-md">
                    <img src="{{ asset('assets/img/kampus.jpg') }}" alt="MockUp"
                        class="w-full rounded-lg shadow-md">
                </div>
                <div class="max-w-md">
                    <p class="text-lg text-gray-800 leading-relaxed">
                        English Club yang berada di Universitas Nusa Putra adalah sebuah kelompok atau organisasi di
                        kampus tersebut di mana mahasiswa dan mungkin juga staf akademik berkumpul untuk belajar,
                        berlatih, dan meningkatkan kemampuan berbahasa Inggris mereka secara bersama-sama. Klub ini
                        terbuka untuk siapa saja yang terdaftar di universitas tersebut dan tertarik untuk meningkatkan
                        kemampuan berbahasa Inggris mereka.
                    </p>
                    <br>
                    <p class="text-lg text-gray-800 leading-relaxed">
                        English Club Universitas Nusa Putra bertujuan untuk menciptakan lingkungan yang mendukung dan
                        menyenangkan bagi anggotanya dalam usaha mereka untuk meningkatkan kemampuan bahasa Inggris dan
                        memahami budaya berbahasa Inggris.
                    </p>
                </div>
            </div>
        </section>
    </div>

</x-app>
