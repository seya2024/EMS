<?php

namespace App\Filament\Resources\AssetTransfers\Pages;

use App\Models\AssetTransfer;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\DB;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\AssetTransfers\AssetTransferResource;

class EditAssetTransfer extends EditRecord
{
    protected static string $resource = AssetTransferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }


    // Call this when saving transfer
    public static function edit(array $data)
    {



        return DB::transaction(function () use ($data) {
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

            $assetModel = $data['assetable_type']::find($data['assetable_id']);
            if ($assetModel) {
                $assetModel->update([
                    'branch_id' => $data['to_branch_id'],
                ]);
            }


            return $transfer;
        });
    }


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



    // protected function messages(): array
    // {
    //     return [
    //         'data.to_branch_id.different'  => 'From Branch and To Branch must be different.',
    //     ];
    // }
}
