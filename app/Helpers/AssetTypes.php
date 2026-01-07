<?php

namespace App\Helpers;

use App\Models\ATM;
use App\Models\DOB;
use App\Models\Pos;
use App\Models\Dongle;
use App\Models\Printer;
use App\Models\Scanner;
use App\Models\Computer;
use App\Models\Photocopy;
use App\Models\OtherAsset;
use App\Models\Photocopier;

class AssetTypes
{
    public static function all(): array
    {
        return [
            'Computer'           => Computer::class,
            'ATM'                => ATM::class,
            'Printer'            => Printer::class,
            'Scanner'            => Scanner::class,
            'Dongle'             => Dongle::class,
            'DOB'                => DOB::class,
            'Photocopy'          => Photocopy::class,
            'POS'                => Pos::class,
            'Non-Digital Asset'  => OtherAsset::class,
        ];
    }
}
