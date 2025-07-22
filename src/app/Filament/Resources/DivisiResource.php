<?php

namespace App\Filament\Resources;

use App\Models\Divisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource; 
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\DivisiResource\Pages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DivisiResource extends Resource
{
    protected static ?string $model = Divisi::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama_divisi')->required(),
            Forms\Components\TextInput::make('kode_divisi')
                ->required()
                ->unique(ignoreRecord: true, column: 'kode_divisi'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('nama_divisi')->searchable(),
            Tables\Columns\TextColumn::make('kode_divisi'),
            Tables\Columns\TextColumn::make('karyawans_count')
                ->counts('karyawans')
                ->label('Jumlah Karyawan'),
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
            'index' => Pages\ListDivisis::route('/'),
            'create' => Pages\CreateDivisi::route('/create'),
            'edit' => Pages\EditDivisi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount('karyawans');
    }

    // Proteksi: hanya admin yang bisa akses
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
}