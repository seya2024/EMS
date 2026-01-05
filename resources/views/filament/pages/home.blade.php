<x-filament-panels::page>
    {{-- Page con --}}


                  <div class="mt-4 space-y-1">
                                  
                    {{-- @foreach($branch->computers->where('isActivated',0) as $computer) --}}
                                        <div class="bg-red-50 border border-red-200 rounded p-2 flex justify-between items-center">
                                            <div>
                                                <span class="font-semibold">ATM Uptime status Report </span>
                                                <span class="text-sm text-gray-600 ml-2">: All districts  </span>
                                            </div>
                                            <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded"> 
                                                
                                       <p>Gregorian: {{ $gcDate }}
                                     </p><p>Ethiopian: {{ $ecDate }}</p>
                                       </span>
                                        </div>
                                    {{-- @endforeach --}}
                                    {{-- @if($branch->computers->where('isActivated',0)->isEmpty())
                                        <div class="text-gray-400 text-sm italic"> Login </div>
                                    @endif --}}

<br>

<div class="mt-4 space-y-1">

        <div class="bg-red-50 border border-red-200 rounded p-2 flex flex-col gap-2">

            {{-- <div>
                <span class="font-semibold">Welcome to home page</span>
                <span class="text-sm text-gray-600 ml-2">Type: Welcome</span>
            </div> --}}

            {{-- Uptime formula header --}}
            <div class="mt-2 mb-2 text-sm font-medium text-gray-700">
                Uptime = Number of in-service ATMs / Total ATMs * 100
            </div>

            @php
                $dates = \App\Helpers\CalendarHelper::getCurrentWeekEcDates(); // Mon → Sat
                $todayEc = \App\Helpers\CalendarHelper::gcToEc(\Carbon\Carbon::now());

                // Function to generate random uptime between 85-100%
                function randomUptime() {
                    return mt_rand(85,100) . '%';
                }
            @endphp

            <table class="w-full text-center border-collapse mt-2">
                <thead>
                    <tr>
                        <th class="border px-2 py-1">Date (EC)</th>
                        <th class="border px-2 py-1">Morning (%)</th>
                        <th class="border px-2 py-1">Afternoon (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dates as $date)
                        <tr class="{{ $date === $todayEc ? 'bg-green-100 font-bold' : '' }}">
                            <td class="border px-2 py-1">{{ $date }}</td>
                            <td class="border px-2 py-1">{{ randomUptime() }}</td>
                            <td class="border px-2 py-1">{{ randomUptime() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>





    </div>

    
                             @if (Route::has('login'))
                            <div class="h-14.5 hidden lg:block"></div>
                              @endif
    </div>


     <div class="mt-4 space-y-4">

        {{-- First Accordion --}}
        <div x-data="{ open: false }" class="border border-gray-300 rounded">
            <button 
                @click="open = !open" 
                class="w-full text-left px-4 py-2 bg-gray-100 hover:bg-gray-200 font-semibold flex justify-between items-center"
            >
                <span>Jimma District </span>
                <span x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition class="p-4 bg-white">
                      <table class="w-full text-center border-collapse mt-2">
                <thead>
                    <tr>
                        <th class="border px-2 py-1">Date (EC)</th>
                        <th class="border px-2 py-1">Morning (%)</th>
                        <th class="border px-2 py-1">Afternoon (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dates as $date)
                        <tr class="{{ $date === $todayEc ? 'bg-green-100 font-bold' : '' }}">
                            <td class="border px-2 py-1">{{ $date }}</td>
                            <td class="border px-2 py-1">{{ randomUptime() }}</td>
                            <td class="border px-2 py-1">{{ randomUptime() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            </div>
        </div>

        {{-- Second Accordion --}}
        <div x-data="{ open: false }" class="border border-gray-300 rounded">
            <button 
                @click="open = !open" 
                class="w-full text-left px-4 py-2 bg-gray-100 hover:bg-gray-200 font-semibold flex justify-between items-center"
            >
                <span> South West District</span>
                <span x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition class="p-4 bg-white">
                      <table class="w-full text-center border-collapse mt-2">
                <thead>
                    <tr>
                        <th class="border px-2 py-1">Date (EC)</th>
                        <th class="border px-2 py-1">Morning (%)</th>
                        <th class="border px-2 py-1">Afternoon (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dates as $date)
                        <tr class="{{ $date === $todayEc ? 'bg-green-100 font-bold' : '' }}">
                            <td class="border px-2 py-1">{{ $date }}</td>
                            <td class="border px-2 py-1">{{ randomUptime() }}</td>
                            <td class="border px-2 py-1">{{ randomUptime() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            </div>
        </div>

    </div>


                                


</x-filament-panels::page>
