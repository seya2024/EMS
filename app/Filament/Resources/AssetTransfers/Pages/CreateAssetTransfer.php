<?php

namespace App\Filament\Resources\AssetTransfers\Pages;

use App\Filament\Resources\AssetTransfers\AssetTransferResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAssetTransfer extends CreateRecord
{
    protected static string $resource = AssetTransferResource::class;

    protected function rules(): array
    {
        return [
            'data.from_branch_id' => ['required'],
            'data.to_branch_id'   => ['required', 'different:data.from_branch_id'],


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

    protected function messages(): array
    {
        return [
            'data.to_branch_id.different'  => 'From Branch and To Branch must be different.',
        ];
    }
}
