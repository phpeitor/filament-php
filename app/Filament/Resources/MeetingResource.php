<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MeetingResource\Pages;
use App\Filament\Resources\MeetingResource\RelationManagers;
use App\Models\Meeting;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MeetingResource extends Resource
{
    protected static ?string $model = Meeting::class;

    protected static ?string $modelLabel = 'reunión';

    protected static ?string $pluralLabel = 'reuniones';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
 
                Select::make('user_id')
                    ->label('Usuario')
                    ->relationship('user', 'name')
                    ->required(),
                DateTimePicker::make('meeting_date')
                    ->label('Fecha de la reunión')
                    ->mindate(now())
                    ->required(),
                Forms\Components\TextInput::make('subject')
                    ->label('Asunto')
                    ->required()
                    ->rules(['string', 'max:255'])
                    ->columnSpan('full'),
                Forms\Components\Textarea::make('details')
                    ->label('Detalles')
                    ->required()
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('url')
                    ->label('URL')
                    ->url()
                    ->required()
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('client_name')
                    ->label('Nombre del cliente')
                    ->required()
                    ->rules(['string', 'max:255'])
                    ->validationAttribute('nombre del cliente'),
                Forms\Components\TextInput::make('client_email')
                    ->label('Correo electrónico del cliente')
                    ->email()
                    ->required()
                    ->rules(['email', 'max:255'])
                    ->validationAttribute('correo electrónico del cliente'),    
                
            ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->emptyStateDescription('Crea una reunión para comenzar.');
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
            'index' => Pages\ListMeetings::route('/'),
            'create' => Pages\CreateMeeting::route('/create'),
            'view' => Pages\ViewMeeting::route('/{record}'),
            'edit' => Pages\EditMeeting::route('/{record}/edit'),
        ];
    }
}
