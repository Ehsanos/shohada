<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatusEnum;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Item;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Pages\Actions\Action;

class OrderResource extends Resource
{
    protected static ?string $pluralModelLabel = 'الطلبات';


    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-sort-descending';
    protected static ?string $navigationGroup = 'عمليات الشراء';


    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\TextInput::make('order_code')->label('كود الطلب')->disabled(),
                Forms\Components\Select::make('user_id')->relationship('user', 'name')->label('الزبون')->disabled(),
                Forms\Components\Select::make("status")->label('حالة الطلب')->options([
                    OrderStatusEnum::Cancelled->value => OrderStatusEnum::Cancelled->getValue(),
                    OrderStatusEnum::Wait->value => OrderStatusEnum::Wait->getValue(),
                    OrderStatusEnum::Success->value => OrderStatusEnum::Success->getValue(),
                ]),


                Forms\Components\TextInput::make('total')->label('القيمة قبل الحسم')->dehydrated(false)
                    ->extraInputAttributes(['readonly'=>'readonly']),
                Forms\Components\TextInput::make('discount')->label(' %حسم بنسبة')->default(0)->afterStateUpdated(
                    function ($get,$set,$state){
                        $total=$get('total')-($state/100*$get('total'));
                        $set('result',$total);
                    }
                )->reactive(),
                Forms\Components\TextInput::make('result')->label('القيمة بعد الحسم'),
            Forms\Components\Section::make('محتويات الطلب')->schema([
                Forms\Components\Repeater::make('products')->relationship('items')->schema([
                    Forms\Components\TextInput::make('product_name')->label('كود المنتج')->disabled(),
                    Forms\Components\TextInput::make('price')->label('سعر  الواحدة')  ->extraInputAttributes(['readonly'=>'readonly']),
                    Forms\Components\TextInput::make('quantity')->label('عدد القطع')  ->extraInputAttributes(['readonly'=>'readonly']),
                    Forms\Components\TextInput::make('total')->label('السعر')  ->extraInputAttributes(['readonly'=>'readonly']),

                ])->columns(4),
                Forms\Components\Textarea::make('notes')->nullable()->label('ملاحظات')
            ])->columns(1)
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_code')->label('كود الطلب'),
                Tables\Columns\TextColumn::make('user.name')->label('اسم الزبون'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->since()->sortable()->searchable()->label('تاريخ الطلب'),
                Tables\Columns\TextColumn::make('status')->enum([

                    OrderStatusEnum::Cancelled->value => OrderStatusEnum::Cancelled->getValue(),
                    OrderStatusEnum::Wait->value => OrderStatusEnum::Wait->getValue(),
                    OrderStatusEnum::Success->value => OrderStatusEnum::Success->getValue(),


                ])->icon(fn($record) => OrderStatusEnum::tryFrom($record->status)?->getIcon())->color(fn($record) => OrderStatusEnum::tryFrom($record->status)?->getColor())->label('حالة الطلب'),
                Tables\Columns\TextColumn::make('total')->label('السعر قبل الحسم'),
                Tables\Columns\TextColumn::make('discount')->label('حسم%'),
                Tables\Columns\TextColumn::make('result')->label('السعر بعد الحسم'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->button(),
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),

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
            'index' => Pages\ListOrders::route('/'),
//            'create' => Pages\CreateOrder::route('/create'),
//            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewItems::route('/{record}'),

        ];
    }


}
