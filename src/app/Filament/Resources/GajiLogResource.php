<?php

namespace App\Filament\Resources;

use App\Models\GajiLog;
use App\Models\Karyawan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\GajiLogResource\Pages;

class GajiLogResource extends Resource
{
    protected static ?string $model = GajiLog::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    // Hak akses khusus hanya untuk admin
    public static function canViewAny(): bool
    {
        return Auth::user()?->isAdmin();
    }

    public static function canView(Model $record): bool
    {
        return Auth::user()?->isAdmin();
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->isAdmin();
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::user()?->isAdmin();
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()?->isAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('karyawan_id')
                ->label('Karyawan')
                ->relationship('karyawan', 'nama')
                ->searchable()
                ->required(),
            Forms\Components\TextInput::make('bulan')->required(),
            Forms\Components\TextInput::make('gaji_dibayar')->required()->numeric(),
            Forms\Components\Textarea::make('catatan'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('karyawan.nama')
                ->label('Nama Karyawan')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('bulan'),
            Tables\Columns\TextColumn::make('gaji_dibayar')->label('Gaji Dibayar'),
            Tables\Columns\TextColumn::make('catatan')->limit(20),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGajiLogs::route('/'),
            'create' => Pages\CreateGajiLog::route('/create'),
            'edit' => Pages\EditGajiLog::route('/{record}/edit'),
        ];
    }
}
