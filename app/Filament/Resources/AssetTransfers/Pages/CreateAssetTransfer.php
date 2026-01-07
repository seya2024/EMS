<?php

namespace App\Filament\Resources\AssetTransfers\Pages;

use App\Models\AssetTransfer;
use Illuminate\Support\Facades\DB;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\AssetTransfers\AssetTransferResource;
use Illuminate\Database\Eloquent\Model;

class CreateAssetTransfer extends CreateRecord
{
    protected static string $resource = AssetTransferResource::class;


    protected function rules(): array
    {
        return [


            'data.assetable_type' => ['required', 'string'],
            'data.assetable_id'   => [
                'required',
                function ($attr, $value, $fail) {
                    $type = $this->data['assetable_type'] ?? null;
                    if (!$type || !class_exists($type)) {
                        $fail('Invalid asset type.');
                        return;
                    }

                    if (!$type::whereKey($value)->exists()) {
                        $fail('Selected asset does not match the asset type.');
                    }
                },
            ],

        ];
    }


    // Call this when saving transfer
    protected function handleRecordCreation(array $data): Model
    {

        dd('Hi');
        return DB::transaction(
            function () use ($data) {

                // 1. Create transfer
                $transfer = AssetTransfer::create([
                    'assetable_type' => $data['assetable_type'],
                    'assetable_id'   => $data['assetable_id'],
                    'from_branch_id' => $data['from_branch_id'],
                    'to_branch_id'   => $data['to_branch_id'],
                    'action'         => $data['action'],
                    'performed_by'   => $data['performed_by'],
                    'performed_at'   => $data['performed_at'],
                    'remarks'        => $data['remarks'] ?? null,
                ]);

                // 2. Update asset branch
                $assetModel = $data['assetable_type']::findOrFail($data['assetable_id']);
                $assetModel->branch_id = $data['to_branch_id'];
                $assetModel->save();

                return $transfer;
            }
        );
    }

    // protected function messages(): array
    // {
    //     return [
    //         'data.to_branch_id.different'  => 'From Branch and To Branch must be different.',
    //     ];
    // }
}
