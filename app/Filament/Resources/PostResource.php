<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Wizard;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;


class PostResource extends Resource
{
    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $model = Post::class;
    protected static ?string $pluralModelLabel = 'المنشورات';
    protected static ?string $navigationGroup = 'الأخبار و المنشورات';




    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('video')->nullable(),
                    SpatieMediaLibraryFileUpload::make('img')->collection('posts')->label('الصورة'),

                ])->columns(2),


                Forms\Components\Section::make('منشور')->schema([
                    Wizard::make()->schema([
                        Wizard\Step::make('AR')->schema([Forms\Components\Card::make()->schema([
                           TinyEditor::make('tilte')->required()->label('عنوان عربي'),
                            TinyEditor::make('body')->required()->label('منشور العربي'),

                        ])
                        ]),
                        Wizard\Step::make('EN')->schema([Forms\Components\Card::make()->schema([
                            TinyEditor::make('tilte_en')->nullable()->label('ENعنوان'),
                            TinyEditor::make('body_en')->nullable()->label('منشورEN'),

                        ])
                        ]),
                        Wizard\Step::make('TR')->schema([Forms\Components\Card::make()->schema([

                            TinyEditor::make('tilte_tr')->nullable()->label('TRعنوان'),
                            TinyEditor::make('body_tr')->nullable()->label('TRمنشور'),
                        ]),
                        ]),


                    ])->skippable()

                ]),

                Forms\Components\CheckboxList::make('section_id')->relationship('section', 'title')->label('قسم'),
                Forms\Components\SpatieTagsInput::make('tags')->type('post'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tilte')->label('عنوان المنشور')->searchable()->html(),
//                Tables\Columns\TextColumn::make('body')->words(5)->label('المنشور')->searchable()->html(),
                SpatieMediaLibraryImageColumn::make('الصورة')->collection('posts')->label('صورة المنشور'),
                Tables\Columns\TagsColumn::make('tags.name')->label('كلمات مفتاحية')->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
