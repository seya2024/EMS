<x-filament::page>
    <h2 class="text-lg font-bold mb-4">{{ 'List of Closed Maintenance Requests' }}</h2>

    <table class="min-w-full border border-gray-300 text-sm">
        <thead class="bg-gray-50 border-b border-gray-300">
            <tr>
                <th class="px-2 py-1 text-left border-r border-gray-300">ID</th>
                <th class="px-2 py-1 text-left border-r border-gray-300">Asset Type</th>
                <th class="px-2 py-1 text-left border-r border-gray-300">Asset ID</th>
                <th class="px-2 py-1 text-left border-r border-gray-300">Sender Branch</th>
                <th class="px-2 py-1 text-left border-r border-gray-300">Working unit</th>
                <th class="px-2 py-1 text-left border-r border-gray-300">Problem</th>
                <th class="px-2 py-1 text-left border-r border-gray-300">Sent Date</th>
                <th class="px-2 py-1 text-left border-r border-gray-300">Return Date</th>
                <th class="px-2 py-1 text-left border-r border-gray-300">Status</th>
                <th class="px-2 py-1 text-left border-r border-gray-300">User ID</th>
                {{-- <th class="px-2 py-1 text-left border-r border-gray-300">Created At</th>
                <th class="px-2 py-1 text-left border-gray-300">Updated At</th> --}}
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($closedRequests as $request)
                <tr class="border-b border-gray-300">
                     <td class="px-2 py-1 border-r border-gray-300">{{ $loop->iteration }}</td>
                    <td class="px-2 py-1 border-r border-gray-300">{{ class_basename($request->assetable_type) }}</td>
                    <td class="px-2 py-1 border-r border-gray-300">{{ $request->assetable_id }}</td>
                    <td class="px-2 py-1 border-r border-gray-300">{{ $request->branch->name }}</td>
                    <td class="px-2 py-1 border-r border-gray-300">{{ $request->ou?->name }}</td>
                    <td class="px-2 py-1 border-r border-gray-300">{{ $request->problem }}</td>
                    <td class="px-2 py-1 border-r border-gray-300">{{ optional($request->sent_date)->format('Y-m-d') }}</td>
                    <td class="px-2 py-1 border-r border-gray-300">{{ optional($request->return_date)->format('Y-m-d') }}</td>
                    <td class="px-2 py-1 border-r border-gray-300">{{ $request->status }}</td>
                    <td class="px-2 py-1 border-r border-gray-300">{{ $request->user?->full_name}}</td>
                    {{-- <td class="px-2 py-1 border-r border-gray-300">{{ optional($request->created_at)->format('Y-m-d H:i') }}</td>
                    <td class="px-2 py-1 border-gray-300">{{ optional($request->updated_at)->format('Y-m-d H:i') }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</x-filament::page>
