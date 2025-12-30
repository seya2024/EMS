<x-filament::page>
    <div class="grid grid-cols-3 gap-4">
        <x-filament::card>
            <h3>Total Users</h3>
            <p class="text-2xl font-bold">{{ $usersCount }}</p>
        </x-filament::card>

        <x-filament::card>
            <h3>Tasks This Week</h3>
            <p class="text-2xl font-bold">{{ $tasksThisWeek }}</p>
        </x-filament::card>

        <x-filament::card>
            <h3>Weekly Transactions</h3>
            <p class="text-2xl font-bold">{{ number_format($transactionsTotal, 2) }}</p>
        </x-filament::card>
    </div>
</x-filament::page>
