<?php

namespace App\Filament\Resources\DataVPNS\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;

use Filament\Tables\Columns\TextColumn;

class DataVPNSTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('serviceNo')
                    ->label('Service Number')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('lANIp')
                    ->label('LAN IP')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('wanIp')
                    ->label('WAN IP')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('account')
                    ->label('Account')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('branch')
                    ->label('Branch')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('media')
                    ->label('Media')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('linkType')
                    ->label('Link Type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('vlan')
                    ->label('VLAN')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('remark')
                    ->label('Remark')
                    ->limit(50), // show first 50 chars

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(), //->button()->outlined(),
                EditAction::make(), //->button()->outlined(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ])
            ])->defaultSort('id', 'desc');
    }
}
