<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use Closure;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostResource extends Resource
{
  protected static ?string $model = Post::class;

  protected static ?string $navigationIcon = 'heroicon-o-document-text';

  protected static ?string $navigationGroup = 'Content';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\Section::make()
          ->schema([
            Forms\Components\Grid::make(2)
              ->schema([
                Forms\Components\TextInput::make('title')
                  ->required()
                  ->maxLength(2048)
                  ->reactive()
                  ->debounce(700)
                  ->afterStateUpdated(function ($state, $set) {
                    $set('slug', Str::slug($state));
                  }),
                Forms\Components\TextInput::make('slug')
                  ->required()
                  ->maxLength(2048),
              ]),

            Forms\Components\RichEditor::make('body')
              ->required()
              ->columnSpanFull(),
            Forms\Components\TextInput::make('meta_title')
              ->maxLength(255),
            Forms\Components\Textarea::make('meta_description')
              ->maxLength(255),
            Forms\Components\Toggle::make('active')
              ->required(),
            Forms\Components\DateTimePicker::make('published_at'),
          ])->columnSpan(8),

        Forms\Components\Section::make()
          ->schema([
            Forms\Components\FileUpload::make('thumbnail'),
            Forms\Components\Select::make('category_id')
              ->multiple()
              ->relationship('categories', 'title')
              ->required(),
          ])->columnSpan(4)
      ])->columns(12);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\ImageColumn::make('thumbnail'),
        Tables\Columns\TextColumn::make('title')
          ->searchable(),
        Tables\Columns\IconColumn::make('active')
          ->boolean(),
        Tables\Columns\TextColumn::make('published_at')
          ->dateTime()
          ->sortable(),
        // Tables\Columns\TextColumn::make('user.name')
        //   ->numeric()
        //   ->sortable(),
        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable(),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
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
      'index' => Pages\ListPosts::route('/'),
      'create' => Pages\CreatePost::route('/create'),
      'edit' => Pages\EditPost::route('/{record}/edit'),
    ];
  }
}
