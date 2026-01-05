<x-filament::page>
@foreach($this->districts as $district)
        <x-filament::card class="mb-4">
            <h2 class="text-lg font-bold">{{ $district->name }}</h2>
            @if($district->activityReports->isEmpty())
                <p class="text-sm text-gray-500">No activities</p>
            @else
                <ul class="mt-2 list-disc list-inside">
                    @foreach($district->activityReports as $report)
                        <li>
                            <strong>{{ $report->task->name ?? 'No Task' }}</strong>
                            - Status: {{ $report->status }}
                            - Date: {{ $report->report_date }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </x-filament::card>
    @endforeach
</x-filament::page>

      
