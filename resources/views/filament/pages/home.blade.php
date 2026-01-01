<x-filament-panels::page>
    {{-- Page con --}}


                  <div class="mt-4 space-y-1">
                                  
                    {{-- @foreach($branch->computers->where('isActivated',0) as $computer) --}}
                                        <div class="bg-red-50 border border-red-200 rounded p-2 flex justify-between items-center">
                                            <div>
                                                <span class="font-semibold">Welcome to home page </span>
                                                <span class="text-sm text-gray-600 ml-2">Type: Welcome </span>
                                            </div>
                                            <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded">Not Activated</span>
                                        </div>
                                    {{-- @endforeach --}}
                                    {{-- @if($branch->computers->where('isActivated',0)->isEmpty())
                                        <div class="text-gray-400 text-sm italic"> Login </div>
                                    @endif --}}



                             @if (Route::has('login'))
                            <div class="h-14.5 hidden lg:block"></div>
                              @endif
                                </div>


</x-filament-panels::page>
