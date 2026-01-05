<x-filament-panels::page>
    <div class="mt-4 space-y-4">

        <div x-data="{ open: true }" class="border border-gray-300 rounded">
            {{-- Accordion Header --}}
            <button 
                @click="open = !open" 
                class="w-full text-left px-4 py-2 bg-gray-100 hover:bg-gray-200 font-semibold flex justify-between items-center"
            >
                <span>Quarter Report</span>
                <span x-text="open ? '-' : '+'"></span>
            </button>

            {{-- Accordion Content --}}
            <div x-show="open" x-transition class="p-4 bg-white space-y-2">

                @php
                    // Define quarter start/end dates (example: Q1 2026)
                    $quarterName = 'Quarter I - 2026';
                    $quarterStart = \Carbon\Carbon::create(2026, 1, 1); // Jan 1
                    $quarterEnd = \Carbon\Carbon::create(2026, 3, 31);  // Mar 31
                    $todayGc = \Carbon\Carbon::now()->format('d-m-Y');

                    // Generate all dates in the quarter
                    $quarterDates = [];
                    $current = $quarterStart->copy();
                    while ($current <= $quarterEnd) {
                        $quarterDates[] = $current->format('d-m-Y');
                        $current->addDay();
                    }
                @endphp

                {{-- Quarter Name --}}
                <div class="text-lg font-semibold text-gray-700 mb-2">
                    {{ $quarterName }}
                </div>

                {{-- Uptime formula header --}}
                <div class="text-sm font-medium text-gray-700 mb-2">
                    Uptime = Number of in-service ATMs / Total ATMs * 100
                </div>

                {{-- Table --}}
                <table class="w-full text-center border-collapse">
                    <thead>
                        <tr>
                            <th class="border px-2 py-1">Date (GC)</th>
                            <th class="border px-2 py-1">Morning (%)</th>
                            <th class="border px-2 py-1">Afternoon (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quarterDates as $date)
                            @php
                                $morning = mt_rand(85,100) . '%';
                                $afternoon = mt_rand(85,100) . '%';
                            @endphp
                            <tr class="{{ $date === $todayGc ? 'bg-green-100 font-bold' : '' }}">
                                <td class="border px-2 py-1">{{ $date }}</td>
                                <td class="border px-2 py-1">{{ $morning }}</td>
                                <td class="border px-2 py-1">{{ $afternoon }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</x-filament-panels::page>
