<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KaryawanResource\Pages;
use App\Models\Karyawan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')->required(),
            Forms\Components\TextInput::make('nik')->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('jabatan')->required(),
            Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('alamat'),
            Forms\Components\TextInput::make('gaji')->numeric()->required(),
            BelongsToSelect::make('divisi_id')
                ->relationship('divisi', 'nama_divisi')
                ->required()
                ->label('Divisi'),
        ]);
    }

  public static function table(Table $table): Table
{
    $columns = [];

    if (Auth::user()?->isAdmin()) {
        // Jika admin, tampilkan semua kolom
        $columns = [
            Tables\Columns\TextColumn::make('nama')->searchable(),
            Tables\Columns\TextColumn::make('nik'),
            Tables\Columns\TextColumn::make('jabatan'),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('gaji')->label('Gaji (Rp)'),
            Tables\Columns\TextColumn::make('divisi.nama_divisi')->label('Divisi')->sortable(),
        ];
    } else {
        // Jika user biasa, hanya tampilkan nama dan divisi
        $columns = [
            Tables\Columns\TextColumn::make('nama')->searchable(),
            Tables\Columns\TextColumn::make('divisi.nama_divisi')->label('Divisi')->sortable(),
        ];
    }

    return $table
        ->columns($columns)
        ->actions([]) // tidak bisa edit
        ->bulkActions([]); // tidak bisa delete
}

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKaryawans::route('/'),
            'create' => Pages\CreateKaryawan::route('/create'),
            'edit' => Pages\EditKaryawan::route('/{record}/edit'),
        ];
    }


   public static function canViewAny(): bool
{
    return true; // semua user boleh melihat
}

public static function canView(Model $record): bool
{
    return true; // semua user boleh melihat detail
}

public static function canCreate(): bool
{
    return Auth::user()?->isAdmin(); // hanya admin yang bisa create
}

public static function canDelete(Model $record): bool
{
    return Auth::user()?->isAdmin(); // hanya admin yang bisa hapus
}

public static function canEdit(Model $record): bool
{
    return Auth::user()?->isAdmin(); // hanya admin yang bisa edit
}
}