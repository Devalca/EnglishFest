<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <h1
            class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
            Biaya <span class="text-[#7150b5]">Pendaftaran</span>
        </h1>
        <hr>
        <div>
            <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">{{ $homeContent->payment_title }}
                :
                <span class="text-[#7150b5] font-extrabold">{{ $homeContent->payment_number }}</span>
            </p>
            <p class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">A.N
                <span class="text-[#7150b5] font-extrabold">{{ $homeContent->payment_owner }}</span>
            </p>
        </div>
    </div>
    <div>
        <ul role="list" class="mb-8 space-y-4 text-left">
            @foreach ($homeContent->fees as $fee)
                <li class="flex items-center space-x-3">
                    <!-- Icon -->
                    <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>
                        {{ $fee['title'] }}:
                        <strong class="text-[#7150b5] font-extrabold">{{ $fee['price'] }}</strong>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
