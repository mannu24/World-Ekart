<?php
         return [
             [
                 'key'    => 'sales.paymentmethods.cashfree',
                 'name'   => 'Cashfree',
                 'sort'   => 7,
                 'fields' => [
                     [
                         'name'          => 'title',
                         'title'         => 'admin::app.admin.system.title',
                         'type'          => 'text',
                         'validation'    => 'required',
                         'channel_based' => false,
                         'locale_based'  => true,
                     ], [
                         'name'          => 'description',
                         'title'         => 'admin::app.admin.system.description',
                         'type'          => 'textarea',
                         'channel_based' => false,
                         'locale_based'  => true,
                     ],  [
                        'name'          => 'app_id',
                        'title'         => 'App Id',
                        'type'          => 'text',
                        'channel_based' => false,
                        'locale_based'  => true,
                    ], [
                        'name'          => 'key_secret',
                        'title'         => 'Key Secret',
                        'type'          => 'text',
                        'channel_based' => false,
                        'locale_based'  => true,
                    ], [
                         'name'          => 'active',
                         'title'         => 'admin::app.admin.system.status',
                         'type'          => 'boolean',
                         'validation'    => 'required',
                         'channel_based' => false,
                         'locale_based'  => true
                     ], [
                        'name'          => 'test_mode',
                        'title'         => 'Test Mode',
                        'type'          => 'boolean',
                        'validation'    => 'required',
                        'channel_based' => false,
                        'locale_based'  => true
                    ], 
                 ]
             ]
         ];