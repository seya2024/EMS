<?php

namespace App\Filament\Pages;

use UnitEnum;
use BackedEnum;
use App\Models\District;
use Filament\Pages\Page;
use App\Models\ComputerModel;
use Filament\Support\Icons\Heroicon;

class InventoryReport extends Page
{
    protected static ?string $navigationLabel = 'Inventory Report';
    protected string $view = 'filament.pages.inventory-report';


    protected static string|UnitEnum|null $navigationGroup = 'Reportings';


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronRight;




    public $districts;
    public $selectedDistrict = null;
    public $selectedBranch = null;
    public $computerCounts = [];

    public function mount(): void
    {
        // Eager load branches and computers
        $this->districts = District::with('branches.computers')->get();

        // Get computer counts per model
        $this->computerCounts = ComputerModel::withCount('computers')->get();
    }
    public function selectDistrict($districtId)
    {
        $this->selectedDistrict = $this->districts->firstWhere('id', $districtId);
        $this->selectedBranch = null;
        $this->computerCounts = []; // reset counts
    }

    // public function selectBranch($branchId)
    // {
    //     $this->selectedBranch = $this->selectedDistrict->branches->firstWhere('id', $branchId);
    //     $this->computerCounts = ComputerModel::withCount([
    //         'computers' => function ($query) {
    //             $query->where('branch_id', $this->selectedBranch->id);
    //         }
    //     ])->get();
    // }

    public function selectBranch($branchId)
    {
        $this->selectedBranch = $this->selectedDistrict->branches->firstWhere('id', $branchId);

        // Count computers per model for this branch only
        $this->computerCounts = ComputerModel::withCount([
            'computers as computers_count' => function ($query) {
                $query->where('branch_id', $this->selectedBranch->id);
            }
        ])->get();
    }
}
