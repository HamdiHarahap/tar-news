<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\News;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NewsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NewsResource\RelationManagers;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $slug = Str::slug($state);
                        $set('slug', $slug);
                    }),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->readOnly(),
                Textarea::make('body')
                    ->required()
                    ->label('Content'),
                Select::make('category_id')
                    ->label('Category')
                    ->required()
                    ->options(Category::all()->pluck('name', 'id'))
                    ->searchable(),
                FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->columnSpanFull()
                    ->required()
                    ->directory('posts'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->wrap(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->wrap(),
                TextColumn::make('body')
                    ->label('Content')
                    ->limit(150)
                    ->wrap(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color(function (string $state): string {
                        $colors = ['info', 'success', 'warning', 'danger', 'gray'];
                        $index = crc32($state) % count($colors);
                        return $colors[$index];
                    }),
                ImageColumn::make('image')
                    ->columnSpanFull()
                    ->disk('public') 
                    ->url(fn ($record) => (asset('posts/' . $record->gambar))) 
                    ->size(70),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
                    
                ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
