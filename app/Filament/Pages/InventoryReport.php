<?php

namespace App\Filament\Pages;

use UnitEnum;
use BackedEnum;
use App\Models\District;
use Filament\Pages\Page;
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

    public function mount(): void
    {
        // Eager load branches and computers
        $this->districts = District::with('branches.computers')->get();
    }

    public function selectDistrict($districtId)
    {
        $this->selectedDistrict = $this->districts->firstWhere('id', $districtId);
        $this->selectedBranch = null; // reset branch selection
    }

    public function selectBranch($branchId)
    {
        $this->selectedBranch = $this->selectedDistrict->branches->firstWhere('id', $branchId);
    }
}
