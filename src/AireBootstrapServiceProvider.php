<?php

namespace Galahad\AireBootstrap;

use Galahad\Aire\Elements\Attributes\ClassNames;
use Galahad\Aire\Elements\Checkbox;
use Galahad\Aire\Elements\Input;
use Galahad\Aire\Support\Facades\Aire;
use Illuminate\Support\ServiceProvider;

class AireBootstrapServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(dirname(__DIR__) . '/views', 'aire-bootstrap');

        $this->publishes([
            dirname(__DIR__).'/views' => $this->app->resourcePath('views/vendor/aire-bootstrap'),
        ], 'aire-bootstrap-views');

        Aire::setTheme('aire-bootstrap', null, [
            'default_classes' => [
                'group' => 'form-group',
                'group_input_group' => 'input-group',
                'group_prepend' => 'input-group-prepend',
                'group_append' => 'input-group-append',
                'group_help_text' => 'form-text text-muted',
                'group_errors' => '',
                'label' => 'form-label',
                'input' => 'form-control',

                'checkbox' => 'form-check-input',
                'checkbox_label' => 'form-check-label',
                'checkbox_wrapper' => 'custom-control custom-checkbox',

                'checkbox_group' => 'custom-control-input',
                'checkbox_group_label' => 'custom-control-label',
                'checkbox_group_label_wrapper' => 'custom-control custom-checkbox',

                'radio_group' => 'custom-control-input',
                'radio_group_label' => 'custom-control-label',
                'radio_group_label_wrapper' => 'custom-control custom-radio',
                'summary' => 'alert alert-warning',
                'button' => 'btn btn-primary',
                'select' => 'form-control',
                'textarea' => 'form-control',
            ],
            'validation_classes' => [
                'valid' => [
                    'label' => 'is-valid',
                    'checkbox' => 'is-valid',
                    'radio' => 'is-valid',
                    'checkbox-group' => 'is-valid',
                    'radio-group' => 'is-valid',
                    'input' => 'is-valid',
                    'select' => 'is-valid',
                    'textarea' => 'is-valid',
                    'errors' => 'valid-feedback d-block',
                    'group_errors' => 'valid-feedback d-block',
                    'group_help_text' => 'valid-feedback d-block',
                ],
                'invalid' => [
                    'label' => 'is-invalid',
                    'checkbox' => 'is-invalid',
                    'checkbox-group' => 'is-invalid',
                    'radio-group' => 'is-invalid',
                    'radio' => 'is-invalid',
                    'input' => 'is-invalid',
                    'select' => 'is-invalid',
                    'textarea' => 'is-invalid',
                    'errors' => 'invalid-feedback d-block',
                    'group_errors' => 'invalid-feedback d-block',
                    'group_help_text' => 'invalid-feedback d-block',
                ],
            ],
            'variant_classes' => [
                'input' => [
                    'default' => 'form-control',
                    'sm' => 'form-control-sm',
                    'lg' => 'form-control-lg',
                ],
                'group_input_group' => [
                    'default' => 'input-group',
                    'sm' => 'input-group-sm',
                    'lg' => 'input-group-lg',
                ],
                'group_input_range' => [
                    'default' => [
                        'display' => 'range-default'
                    ]
                ],
                'select' => [
                    'default' => [
                        'display' => 'custom-select',
                        'size' => '',
                        'color' => '',
                    ],
                    'sm' => 'custom-select-sm',
                    'lg' => 'custom-select-lg',
                ],
                'button' => [
                    'default' => [
                        'display' => 'btn',
                        'size' => '',
                        'color' => 'btn-primary',
                    ],
                    'sm' => [
                        'size' => 'btn-sm',
                    ],
                    'lg' => [
                        'size' => 'btn-sm',
                    ],
                    'primary' => [
                        'color' => 'btn-primary'
                    ],
                    'secondary' => [
                        'color' => 'btn-secondary'
                    ],
                    'success' => [
                        'color' => 'btn-success'
                    ],
                    'danger' => [
                        'color' => 'btn-danger'
                    ],
                    'warning' => [
                        'color' => 'btn-warning'
                    ],
                    'info' => [
                        'color' => 'btn-info'
                    ],
                    'light' => [
                        'color' => 'btn-light'
                    ],
                    'dark' => [
                        'color' => 'btn-dark'
                    ],
                ]
            ]
        ]);

        Checkbox::registerElementMutator(function (Checkbox $checkbox) {
            $checkbox->group->addClass('custom-control custom-checkbox');
        });

        Input::registerElementMutator(function (Input $input) {

            $input->attributes->registerMutator('class', function (ClassNames $classNames) use ($input) {

                if ('file' === $input->attributes->get('type')) {
                    $input
                        ->groupAddClass('custom-file')
                        ->groupRemoveClass('form-group');

                    $input->group->label
                        ->addClass('custom-file-label')
                        ->removeClass('cursor-pointer');
                }

                if ('range' === $input->attributes->get('type')) {
                    $classNames
                        ->remove('form-control')
                        ->add('form-control-range');
                }

                return $classNames;
            });
        });

    }
}
