<x-filament-panels::page>
    <div class="mt-4 space-y-4">

        <div x-data="{ open: true }" class="border border-gray-300 rounded">
            {{-- Accordion Header --}}
            <button 
                @click="open = !open" 
                class="w-full text-left px-4 py-2 bg-gray-100 hover:bg-gray-200 font-semibold flex justify-between items-center"
            >
                <span>Current Month Report</span>
                <span x-text="open ? '-' : '+'"></span>
            </button>

            {{-- Accordion Content --}}
            <div x-show="open" x-transition class="p-4 bg-white space-y-2">
                
                {{-- Current Month Name --}}
                @php
                    $currentMonthName = \Carbon\Carbon::now()->format('F Y'); // e.g., January 2026
                @endphp
                <div class="text-lg font-semibold text-gray-700 mb-2">
                    {{ $currentMonthName }}
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
                        @php
                            $startOfMonth = \Carbon\Carbon::now()->startOfMonth();
                            $endOfMonth = \Carbon\Carbon::now()->endOfMonth();
                            $todayGc = \Carbon\Carbon::now()->format('d-m-Y');

                            $current = $startOfMonth->copy();

                            $monthDates = [];
                            while ($current <= $endOfMonth) {
                                $monthDates[] = $current->format('d-m-Y');
                                $current->addDay();
                            }
                        @endphp

                        @foreach($monthDates as $date)
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
