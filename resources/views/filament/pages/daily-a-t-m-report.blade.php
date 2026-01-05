<x-filament-panels::page>
    <div class="mt-4 space-y-4">

        @php
            // Generate dates for current week (Monday → Saturday)
            $startOfWeek = \Carbon\Carbon::now()->startOfWeek(); // Monday
            $endOfWeek = $startOfWeek->copy()->addDays(5);       // Saturday
            $todayGc = \Carbon\Carbon::now()->format('d-m-Y');

            $dates = [];
            $current = $startOfWeek->copy();
            while ($current <= $endOfWeek) {
                $dates[] = $current->format('d-m-Y');
                $current->addDay();
            }
        @endphp



        {{-- Accordion for daily report --}}
        <div x-data="{ open: true }" class="border border-gray-300 rounded">
            <button 
                @click="open = !open" 
                class="w-full text-left px-4 py-2 bg-gray-100 hover:bg-gray-200 font-semibold flex justify-between items-center"
            >
                <span>Daily ATM Report</span>
                <span x-text="open ? '-' : '+'"></span>
            </button>

            <div x-show="open" x-transition class="p-4 bg-white">
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
                        @foreach($dates as $date)
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
                <br>
                <hr>


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
                        @foreach($dates as $date)
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

        <br>


        

    </div>
</x-filament-panels::page>
