<x-filament::page>
    <div class="space-y-4">

        {{-- Districts --}}
        <h3 class="text-2xl font-bold mb-4">Districts</h3>

        @foreach($districts as $district)
            <div x-data="{ openDistrict: false }" class="border rounded shadow-sm">
                
                {{-- District header --}}
                <button @click="openDistrict = !openDistrict" 
                        class="w-full flex justify-between items-center px-4 py-2 bg-purple-50 hover:bg-purple-100 rounded-t">
                    <span class="font-semibold text-lg">{{ $loop->iteration }}. {{ $district->name }}</span>
                    <span class="text-sm text-gray-600">{{ $district->branches->count() }} Branches</span>
                </button>

                {{-- Branches (collapsible) --}}
                <div x-show="openDistrict" x-transition class="bg-white p-4 space-y-2">
                    @foreach($district->branches as $branch)
                        <div x-data="{ openBranch: false }" class="border-l-4 border-green-200 rounded pl-3">

                            {{-- Branch header --}}
                            <button @click="openBranch = !openBranch" 
                                    class="w-full flex justify-between items-center px-2 py-1 hover:bg-green-50 rounded">
                                <span class="font-medium">{{ $loop->iteration }}. {{ $branch->name }}</span>
                                <span class="text-sm text-gray-500">{{ $branch->computers->where('isActivated',0)->count() }} Inactive Computers</span>
                            </button>

                            {{-- Branch stats (placeholders) --}}
                            <div x-show="openBranch" x-transition class="pl-4 mt-2 space-y-2">
                               
                               
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm text-gray-600">
                            @foreach($computerCounts as $model)
                                <div class="flex justify-between border p-2 rounded bg-gray-50">
                                    <span>{{ $model->name }}</span>
                                    <span>{{ $model->computers_count }}</span>
                                </div>
                            @endforeach
                        </div>

                                {{-- Computers (Inactive list) --}}
                                <div class="mt-4 space-y-1">
                                    @foreach($branch->computers->where('isActivated',0) as $computer)
                                        <div class="bg-red-50 border border-red-200 rounded p-2 flex justify-between items-center">
                                            <div>
                                                <span class="font-semibold">{{ $loop->iteration }}. {{ $computer->name }}</span>
                                                <span class="text-sm text-gray-600 ml-2">Type: {{ $computer->type }}</span>
                                            </div>
                                            <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded">Not Activated</span>
                                        </div>
                                    @endforeach
                                    @if($branch->computers->where('isActivated',0)->isEmpty())
                                        <div class="text-gray-400 text-sm italic">No inactive computers</div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>
</x-filament::page>
