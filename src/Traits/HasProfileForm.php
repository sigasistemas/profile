<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Callcocam\Profile\Traits;

use Filament\Forms;

trait HasProfileForm
{

    public function getFormASchemaAddress()
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label(__('profile::profile.forms.address.name.label'))
                ->placeholder(__('profile::profile.forms.address.name.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.name.columnSpan', 5),
                ])
                ->hidden(config('profile.resources.address.name.hidden', false))
                ->required(config('profile.resources.address.name.required', true))
                ->maxLength(config('profile.resources.address.name.maxLength', 255)),
            \Leandrocfe\FilamentPtbrFormFields\Cep::make('zip')
                ->label(__('profile::profile.forms.address.zip.label'))
                ->placeholder(__('profile::profile.forms.address.zip.placeholder'))
                ->hidden(config('profile.resources.address.zip.hidden', false))
                ->viaCep(
                    mode: 'suffix', // Determines whether the action should be appended to (suffix) or prepended to (prefix) the cep field, or not included at all (none).
                    errorMessage: 'CEP inválido.', // Error message to display if the CEP is invalid.

                    /**
                     * Other form fields that can be filled by ViaCep.
                     * The key is the name of the Filament input, and the value is the ViaCep attribute that corresponds to it.
                     * More information: https://viacep.com.br/
                     */
                    setFields: [
                        'street' => 'logradouro',
                        'number' => 'numero',
                        'complement' => 'complemento',
                        'district' => 'bairro',
                        'city' => 'localidade',
                        'state' => 'uf'
                    ]
                )
                ->columnSpan([
                    'md' => config('profile.resources.address.zip.columnSpan', 3),
                ])
                ->required(config('profile.resources.address.zip.required', true))
                ->maxLength(config('profile.resources.address.zip.maxLength', 255)),
            Forms\Components\TextInput::make('street')
                ->label(__('profile::profile.forms.address.street.label'))
                ->placeholder(__('profile::profile.forms.address.street.placeholder'))
                ->hidden(config('profile.resources.address.street.hidden', false))
                ->columnSpan([
                    'md' => config('profile.resources.address.street.columnSpan', 4),
                ])
                ->required(config('profile.resources.address.street.required', true))
                ->maxLength(config('profile.resources.address.street.maxLength', 255)),
            Forms\Components\TextInput::make('number')
                ->label(__('profile::profile.forms.address.number.label'))
                ->placeholder(__('profile::profile.forms.address.number.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.number.columnSpan', 4),
                ])
                ->required(config('profile.resources.address.number.required', true))
                ->maxLength(config('profile.resources.address.number.maxLength', 255)),
            Forms\Components\TextInput::make('complement')
                ->label(__('profile::profile.forms.address.complement.label'))
                ->placeholder(__('profile::profile.forms.address.complement.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.complement.columnSpan', 8),
                ])
                ->required(config('profile.resources.address.complement.required', false))
                ->maxLength(config('profile.resources.address.complement.maxLength', 255)),
            Forms\Components\TextInput::make('district')
                ->label(__('profile::profile.forms.address.district.label'))
                ->placeholder(__('profile::profile.forms.address.district.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.district.columnSpan', 4),
                ])
                ->required(config('profile.resources.address.district.required', true))
                ->maxLength(config('profile.resources.address.district.maxLength', 255)),
            Forms\Components\TextInput::make('city')
                ->label(__('profile::profile.forms.address.city.label'))
                ->placeholder(__('profile::profile.forms.address.city.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.city.columnSpan', 5),
                ])
                ->required(config('profile.resources.address.city.required', true))
                ->maxLength(config('profile.resources.address.city.maxLength', 255)),
            Forms\Components\Select::make('state')
                ->options(config('profile.resources.address.options.state', []))
                ->label(__('profile::profile.forms.address.state.label'))
                ->placeholder(__('profile::profile.forms.address.state.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.state.columnSpan', 3)
                ])
                ->required(),
            Forms\Components\TextInput::make('country')
                ->label(__('profile::profile.forms.address.country.label'))
                ->placeholder(__('profile::profile.forms.address.country.placeholder'))
                ->default('Brasil')
                ->columnSpan([
                    'md' => config('profile.resources.address.country.columnSpan', 4),
                ])
                ->required(config('profile.resources.address.country.required', false))
                ->maxLength(config('profile.resources.address.country.maxLength', 255)),
            Forms\Components\TextInput::make('latitude')
                ->label(__('profile::profile.forms.address.latitude.label'))
                ->placeholder(__('profile::profile.forms.address.latitude.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.latitude.columnSpan', 4)
                ])
                ->required(config('profile.resources.address.latitude.required', false))
                ->maxLength(config('profile.resources.address.latitude.maxLength', 255)),
            Forms\Components\TextInput::make('longitude')
                ->label(__('profile::profile.forms.address.longitude.label'))
                ->placeholder(__('profile::profile.forms.address.longitude.placeholder'))
                ->columnSpan([
                    'md' => config('profile.resources.address.longitude.columnSpan', 4)
                ])
                ->required(config('profile.resources.address.longitude.required', false))
                ->maxLength(config('profile.resources.address.longitude.maxLength', 255)),
            Forms\Components\Radio::make('status')
                ->label(__('profile::profile.forms.address.status.label'))
                ->inline()
                ->options([
                    'draft' => 'Rascunho',
                    'published' => 'Publicado',
                ])
                ->columnSpanFull()
                ->required(config('profile.resources.address.status.required', false)),
        ];
    }
}
