<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'L5 Swagger UI',
            ],
            'routes' => [
                /*
                 * Route for accessing api documentation interface
                */
                'api' => 'api/documentation',
            ],
            'info' => [
                /**
                 * @OA\Info(
                 *     title="My First API",
                 *     version="1.0.0",
                 *     description="API description",
                 *     @OA\Contact(
                 *         name="API Support",
                 *         email="support@example.com",
                 *         url="https://example.com/support"
                 *     ),
                 *     @OA\License(
                 *         name="Apache 2.0",
                 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
                 *     )
                 * )
                 */
            ],
            'paths' => [
                /*
                 * Edit to include full URL in ui for assets
                */
                'use_absolute_path' => env('L5_SWAGGER_USE_ABSOLUTE_PATH', true),

                /*
                 * File name of the generated json documentation file
                */
                'docs_json' => 'api-docs.json',

                /*
                 * File name of the generated YAML documentation file
                */
                'docs_yaml' => 'api-docs.yaml',

                /*
                * Set this to `json` or `yaml` to determine which documentation file to use in UI
                */
                'format_to_use_for_docs' => env('L5_FORMAT_TO_USE_FOR_DOCS', 'json'),

                /*
                 * Absolute paths to directory containing the swagger annotations are stored.
                */
                'annotations' => [
                    base_path('app'),
                ],
            ],
            'securityDefinitions' => [
                'securitySchemes' => [
                    'bearer_token' => [
                        'type' => 'apiKey',
                        'description' => 'Enter token in format (Bearer <token>)',
                        'name' => 'Authorization',
                        'in' => 'header',
                    ],
                ],
                'security' => [
                    [
                        'bearer_token' => [],
                    ],
                ],
            ],
            'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', false),
            'generate_yaml_copy' => env('L5_SWAGGER_GENERATE_YAML_COPY', false),
            'proxy' => false,
            'additional_config_url' => null,
            'operations_sort' => env('L5_SWAGGER_OPERATIONS_SORT', null),
            'validator_url' => null,
            'ui' => [
                'display' => [
                    'doc_expansion' => env('L5_SWAGGER_UI_DOC_EXPANSION', 'none'),
                    'filter' => env('L5_SWAGGER_UI_FILTERS', true),
                ],
                'authorization' => [
                    'persist_authorization' => env('L5_SWAGGER_UI_PERSIST_AUTHORIZATION', false),
                    'oauth2' => [
                        'use_pkce_with_authorization_code_grant' => false,
                    ],
                ],
            ],
            'constants' => [
                'L5_SWAGGER_CONST_HOST' => env('L5_SWAGGER_CONST_HOST', 'http://my-default-host.com'),
            ],
        ],
    ],
];
