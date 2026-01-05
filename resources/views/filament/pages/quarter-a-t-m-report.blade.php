<x-filament-panels::page>
    <div class="mt-4 space-y-4">

        @php
            // Call the helper function to get current quarter dates
            $quarter = \App\Helpers\CalendarHelper::getCurrentQuarterDates();
            $quarterName = $quarter['quarterName'];
            $quarterDates = $quarter['dates'];
            $todayGc = \Carbon\Carbon::now()->format('d-m-Y');
        @endphp

        {{-- Accordion for quarter --}}
        <div x-data="{ open: true }" class="border border-gray-300 rounded">
            <button 
                @click="open = !open" 
                class="w-full text-left px-4 py-2 bg-gray-100 hover:bg-gray-200 font-semibold flex justify-between items-center"
            >
                <span>{{ $quarterName }}</span>
                <span x-text="open ? '-' : '+'"></span>
            </button>

            <div x-show="open" x-transition class="p-4 bg-white space-y-2">
                <div class="text-sm font-medium text-gray-700 mb-2">
                    Uptime = Number of in-service ATMs / Total ATMs * 100
                </div>

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
