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
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;


class MeetingResource extends Resource
{
    protected static ?string $model = Meeting::class;

    protected static ?string $modelLabel = 'reunión';

    protected static ?string $pluralLabel = 'reuniones';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([
            Section::make('Información de la reunión')
            ->columns(3)
            ->schema([
                    TextEntry::make('user.name')
                        ->label('Usuario'),
                    TextEntry::make('meeting_date')
                        ->label('Fecha de la reunión'),
                    TextEntry::make('meeting_status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'requested' => 'primary',
                            'accepted' => 'success',
                            'finished' => 'info',
                            'cancelled' => 'danger',
                            default => 'gray',
                        })
                        ->formatStateUsing(fn (string $state): string => match ($state) {
                                'requested' => 'Solicitada',
                                'accepted' => 'Aceptada',
                                'finished' => 'Finalizada',
                                'cancelled' => 'Cancelada',
                                default => '-',
                        })
                        ->label('Estado'),
                    TextEntry::make('subject')
                        ->label('Asunto')
                        ->columnSpan('full'),
                    TextEntry::make('details')
                        ->label('Detalles')
                        ->columnSpan('full'),
                    TextEntry::make('url')
                        ->label('URL de la reunión')
                        ->columnSpan('full'),
                    TextEntry::make('client_name')
                        ->label('Nombre del cliente'),
                    TextEntry::make('client_email')
                        ->label('Correo electrónico del cliente'), 
            ])
        ]);
    }

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
                    ->rules(['string', 'max:255']),
                Select::make('meeting_status')
                    ->label('Estado')
                    ->options([
                        'requested' => 'Solicitada',
                        'accepted' => 'Aceptada',
                        'finished' => 'Finalizada',
                        'cancelled' => 'Cancelada',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('details')
                    ->label('Detalles')
                    ->required()
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('url')
                    ->label('URL de la reunión')
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
                TextColumn::make('meeting_date')
                    ->label('Fecha de la reunión'),
                TextColumn::make('subject')
                    ->label('Asunto')
                    ->wrap(),
                TextColumn::make('client_name')
                    ->label('Nombre del cliente')
                    ->wrap(),
                TextColumn::make('user.name')
                    ->label('Usuario'),
                TextColumn::make('meeting_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'requested' => 'primary',
                        'accepted' => 'success',
                        'finished' => 'info',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                            'requested' => 'Solicitada',
                            'accepted' => 'Aceptada',
                            'finished' => 'Finalizada',
                            'cancelled' => 'Cancelada',
                            default => '-',
                    })
                    ->label('Estado'),
            ])
            ->filters([
                SelectFilter::make('user_id')
                ->label('Usuario')
                ->relationship('user', 'name'),
                SelectFilter::make('meeting_status')
                    ->label('Estado')
                    ->options([
                        'requested' => 'Solicitada',
                        'accepted' => 'Aceptada',
                        'finished' => 'Finalizada',
                        'cancelled' => 'Cancelada',
                    ]),
                Filter::make('meeting_date')
                ->label('Fecha de la reunión')
                ->form([
                    Forms\Components\DatePicker::make('from')->label('Desde'),
                    Forms\Components\DatePicker::make('to')->label('Hasta'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when($data['from'] ?? null, fn ($query, $date) => $query->whereDate('meeting_date', '>=', $date))
                        ->when($data['to'] ?? null, fn ($query, $date) => $query->whereDate('meeting_date', '<=', $date));
                }),
            
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                
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
