<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Profile\Resources\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Leandrocfe\FilamentPtbrFormFields\Document;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    protected static ?string $title = 'Documentos';

    protected static ?string $icon =  'fas-id-badge';


    public static function getIcon(Model $ownerRecord, string $pageClass): ?string
    {
        return config('profile.resources.documents.icon', static::$icon);
    }

    public static function getIconPosition(Model $ownerRecord, string $pageClass): IconPosition
    {
        return config('profile.resources.documents.iconPosition', static::$iconPosition);
    }

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return config('profile.resources.documents.badge', static::$badge);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return  config('profile.resources.documents.title',   parent::getTitle($ownerRecord, $pageClass));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('name')
                    ->options(config('profile.resources.documents.options', []))->reactive()
                    ->label(__('profile::profile.forms.document.name.label'))
                    ->placeholder(__('profile::profile.forms.document.name.placeholder'))
                    ->hidden(config('profile.resources.documents.hidden', false))
                    ->required(config('profile.resources.documents.required', true)),
                Document::make('description')
                    ->mask(function (Get $get) {
                        $type = strtolower($get('name'));
                        switch ($type):
                            case 'cpf':
                                return '999.999.999-99';
                                break;
                            case 'cnpj':
                                return '99.999.999/9999-99';
                                break;
                            case 'rg':
                                return '99.999.999-9';
                                break;
                            default:
                                return null;
                                break;
                        endswitch;
                    })
                    ->label(__('profile::profile.forms.document.description.label'))
                    ->placeholder(__('profile::profile.forms.document.description.placeholder'))
                    ->required(config('profile.resources.documents.required', true))
                    ->hidden(config('profile.resources.documents.hidden', false))
                    ->maxLength(config('profile.resources.documents.maxlength', 255)),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modelLabel(__('profile::profile.forms.document.modelLabel'))
            ->pluralModelLabel(__('profile::profile.forms.document.pluralModelLabel'))
            ->recordTitleAttribute(config('profile.resources.documents.title', 'name'))
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters(config('profile.resources.documents.filters', []))
            ->headerActions(config(
                'profile.resources.documents.header_actions',
                [
                    Tables\Actions\CreateAction::make(),
                ]
            ))
            ->actions(config(
                'profile.resources.documents.actions',
                [
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]
            ))
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make(config(
                    'profile.resources.documents.bulk_actions',
                    [
                        Tables\Actions\DeleteBulkAction::make(),
                    ]
                )),
            ])
            ->emptyStateActions(config(
                'profile.resources.documents.emptyState',
                [
                    Tables\Actions\CreateAction::make(),
                ]
            ));
    }
}
