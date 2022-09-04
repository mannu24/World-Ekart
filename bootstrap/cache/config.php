<?php return array (
  'acl' => 
  array (
    0 => 
    array (
      'key' => 'contact',
      'name' => 'contact_lang::app.contact.title',
      'route' => 'admin.contact.index',
      'sort' => 20,
    ),
    1 => 
    array (
      'key' => 'velocity',
      'name' => 'velocity::app.admin.layouts.velocity',
      'route' => 'velocity.admin.meta-data',
      'sort' => 5,
    ),
    2 => 
    array (
      'key' => 'velocity.meta-data',
      'name' => 'velocity::app.admin.layouts.meta-data',
      'route' => 'velocity.admin.meta-data',
      'sort' => 5,
    ),
    3 => 
    array (
      'key' => 'velocity.meta-data.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'velocity.admin.store.meta-data',
      'sort' => 1,
    ),
    4 => 
    array (
      'key' => 'velocity.header',
      'name' => 'velocity::app.admin.layouts.header-content',
      'route' => 'velocity.admin.content.index',
      'sort' => 5,
    ),
    5 => 
    array (
      'key' => 'velocity.header.create',
      'name' => 'admin::app.acl.create',
      'route' => 'velocity.admin.content.create',
      'sort' => 1,
    ),
    6 => 
    array (
      'key' => 'velocity.header.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'velocity.admin.content.edit',
      'sort' => 2,
    ),
    7 => 
    array (
      'key' => 'velocity.header.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'velocity.admin.content.delete',
      'sort' => 3,
    ),
    8 => 
    array (
      'key' => 'dashboard',
      'name' => 'admin::app.acl.dashboard',
      'route' => 'admin.dashboard.index',
      'sort' => 1,
    ),
    9 => 
    array (
      'key' => 'sales',
      'name' => 'admin::app.acl.sales',
      'route' => 'admin.sales.orders.index',
      'sort' => 2,
    ),
    10 => 
    array (
      'key' => 'sales.orders',
      'name' => 'admin::app.acl.orders',
      'route' => 'admin.sales.orders.index',
      'sort' => 1,
    ),
    11 => 
    array (
      'key' => 'sales.orders.view',
      'name' => 'admin::app.acl.view',
      'route' => 'admin.sales.orders.view',
      'sort' => 1,
    ),
    12 => 
    array (
      'key' => 'sales.orders.cancel',
      'name' => 'admin::app.acl.cancel',
      'route' => 'admin.sales.orders.cancel',
      'sort' => 2,
    ),
    13 => 
    array (
      'key' => 'sales.invoices',
      'name' => 'admin::app.acl.invoices',
      'route' => 'admin.sales.invoices.index',
      'sort' => 2,
    ),
    14 => 
    array (
      'key' => 'sales.invoices.view',
      'name' => 'admin::app.acl.view',
      'route' => 'admin.sales.invoices.view',
      'sort' => 1,
    ),
    15 => 
    array (
      'key' => 'sales.invoices.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.sales.invoices.create',
      'sort' => 2,
    ),
    16 => 
    array (
      'key' => 'sales.shipments',
      'name' => 'admin::app.acl.shipments',
      'route' => 'admin.sales.shipments.index',
      'sort' => 3,
    ),
    17 => 
    array (
      'key' => 'sales.shipments.view',
      'name' => 'admin::app.acl.view',
      'route' => 'admin.sales.shipments.view',
      'sort' => 1,
    ),
    18 => 
    array (
      'key' => 'sales.shipments.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.sales.shipments.create',
      'sort' => 2,
    ),
    19 => 
    array (
      'key' => 'sales.refunds',
      'name' => 'admin::app.acl.refunds',
      'route' => 'admin.sales.refunds.index',
      'sort' => 4,
    ),
    20 => 
    array (
      'key' => 'sales.refunds.view',
      'name' => 'admin::app.acl.view',
      'route' => 'admin.sales.refunds.view',
      'sort' => 1,
    ),
    21 => 
    array (
      'key' => 'sales.refunds.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.sales.refunds.create',
      'sort' => 2,
    ),
    22 => 
    array (
      'key' => 'catalog',
      'name' => 'admin::app.acl.catalog',
      'route' => 'admin.catalog.index',
      'sort' => 3,
    ),
    23 => 
    array (
      'key' => 'catalog.products',
      'name' => 'admin::app.acl.products',
      'route' => 'admin.catalog.products.index',
      'sort' => 1,
    ),
    24 => 
    array (
      'key' => 'catalog.products.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.catalog.products.create',
      'sort' => 1,
    ),
    25 => 
    array (
      'key' => 'catalog.products.copy',
      'name' => 'admin::app.acl.copy',
      'route' => 'admin.catalog.products.copy',
      'sort' => 2,
    ),
    26 => 
    array (
      'key' => 'catalog.products.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.catalog.products.edit',
      'sort' => 3,
    ),
    27 => 
    array (
      'key' => 'catalog.products.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.catalog.products.delete',
      'sort' => 4,
    ),
    28 => 
    array (
      'key' => 'catalog.products.mass-update',
      'name' => 'admin::app.acl.mass-update',
      'route' => 'admin.catalog.products.massupdate',
      'sort' => 5,
    ),
    29 => 
    array (
      'key' => 'catalog.products.mass-delete',
      'name' => 'admin::app.acl.mass-delete',
      'route' => 'admin.catalog.products.massdelete',
      'sort' => 6,
    ),
    30 => 
    array (
      'key' => 'catalog.categories',
      'name' => 'admin::app.acl.categories',
      'route' => 'admin.catalog.categories.index',
      'sort' => 2,
    ),
    31 => 
    array (
      'key' => 'catalog.categories.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.catalog.categories.create',
      'sort' => 1,
    ),
    32 => 
    array (
      'key' => 'catalog.categories.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.catalog.categories.edit',
      'sort' => 2,
    ),
    33 => 
    array (
      'key' => 'catalog.categories.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.catalog.categories.delete',
      'sort' => 3,
    ),
    34 => 
    array (
      'key' => 'catalog.categories.mass-delete',
      'name' => 'admin::app.acl.mass-delete',
      'route' => 'admin.catalog.categories.massdelete',
      'sort' => 4,
    ),
    35 => 
    array (
      'key' => 'catalog.attributes',
      'name' => 'admin::app.acl.attributes',
      'route' => 'admin.catalog.attributes.index',
      'sort' => 3,
    ),
    36 => 
    array (
      'key' => 'catalog.attributes.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.catalog.attributes.create',
      'sort' => 1,
    ),
    37 => 
    array (
      'key' => 'catalog.attributes.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.catalog.attributes.edit',
      'sort' => 2,
    ),
    38 => 
    array (
      'key' => 'catalog.attributes.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.catalog.attributes.delete',
      'sort' => 3,
    ),
    39 => 
    array (
      'key' => 'catalog.attributes.mass-delete',
      'name' => 'admin::app.acl.mass-delete',
      'route' => 'admin.catalog.attributes.massdelete',
      'sort' => 4,
    ),
    40 => 
    array (
      'key' => 'catalog.families',
      'name' => 'admin::app.acl.attribute-families',
      'route' => 'admin.catalog.families.index',
      'sort' => 4,
    ),
    41 => 
    array (
      'key' => 'catalog.families.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.catalog.families.create',
      'sort' => 1,
    ),
    42 => 
    array (
      'key' => 'catalog.families.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.catalog.families.edit',
      'sort' => 2,
    ),
    43 => 
    array (
      'key' => 'catalog.families.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.catalog.families.delete',
      'sort' => 3,
    ),
    44 => 
    array (
      'key' => 'customers',
      'name' => 'admin::app.acl.customers',
      'route' => 'admin.customer.index',
      'sort' => 4,
    ),
    45 => 
    array (
      'key' => 'customers.customers',
      'name' => 'admin::app.acl.customers',
      'route' => 'admin.customer.index',
      'sort' => 1,
    ),
    46 => 
    array (
      'key' => 'customers.customers.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.customer.create',
      'sort' => 1,
    ),
    47 => 
    array (
      'key' => 'customers.customers.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.customer.edit',
      'sort' => 2,
    ),
    48 => 
    array (
      'key' => 'customers.customers.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.customer.delete',
      'sort' => 3,
    ),
    49 => 
    array (
      'key' => 'customers.customers.mass-update',
      'name' => 'admin::app.acl.mass-update',
      'route' => 'admin.customer.mass-update',
      'sort' => 4,
    ),
    50 => 
    array (
      'key' => 'customers.customers.mass-delete',
      'name' => 'admin::app.acl.mass-delete',
      'route' => 'admin.customer.mass-delete',
      'sort' => 5,
    ),
    51 => 
    array (
      'key' => 'customers.addresses',
      'name' => 'admin::app.acl.addresses',
      'route' => 'admin.customer.addresses.index',
      'sort' => 2,
    ),
    52 => 
    array (
      'key' => 'customers.addresses.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.customer.addresses.create',
      'sort' => 1,
    ),
    53 => 
    array (
      'key' => 'customers.addresses.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.customer.addresses.edit',
      'sort' => 2,
    ),
    54 => 
    array (
      'key' => 'customers.addresses.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.customer.addresses.delete',
      'sort' => 3,
    ),
    55 => 
    array (
      'key' => 'customers.note',
      'name' => 'admin::app.acl.note',
      'route' => 'admin.customer.note.create',
      'sort' => 3,
    ),
    56 => 
    array (
      'key' => 'customers.groups',
      'name' => 'admin::app.acl.groups',
      'route' => 'admin.groups.index',
      'sort' => 4,
    ),
    57 => 
    array (
      'key' => 'customers.groups.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.groups.create',
      'sort' => 1,
    ),
    58 => 
    array (
      'key' => 'customers.groups.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.groups.edit',
      'sort' => 2,
    ),
    59 => 
    array (
      'key' => 'customers.groups.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.groups.delete',
      'sort' => 3,
    ),
    60 => 
    array (
      'key' => 'customers.reviews',
      'name' => 'admin::app.acl.reviews',
      'route' => 'admin.customer.review.index',
      'sort' => 5,
    ),
    61 => 
    array (
      'key' => 'customers.reviews.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.customer.review.edit',
      'sort' => 1,
    ),
    62 => 
    array (
      'key' => 'customers.reviews.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.customer.review.delete',
      'sort' => 2,
    ),
    63 => 
    array (
      'key' => 'customers.reviews.mass-update',
      'name' => 'admin::app.acl.mass-update',
      'route' => 'admin.customer.review.massupdate',
      'sort' => 3,
    ),
    64 => 
    array (
      'key' => 'customers.reviews.mass-delete',
      'name' => 'admin::app.acl.mass-delete',
      'route' => 'admin.customer.review.massdelete',
      'sort' => 4,
    ),
    65 => 
    array (
      'key' => 'customers.orders',
      'name' => 'admin::app.acl.orders',
      'route' => 'admin.customer.orders.data',
      'sort' => 7,
    ),
    66 => 
    array (
      'key' => 'marketing',
      'name' => 'admin::app.acl.marketing',
      'route' => 'admin.cart-rules.index',
      'sort' => 6,
    ),
    67 => 
    array (
      'key' => 'marketing.promotions',
      'name' => 'admin::app.acl.promotions',
      'route' => 'admin.cart-rules.index',
      'sort' => 6,
    ),
    68 => 
    array (
      'key' => 'marketing.promotions.cart-rules',
      'name' => 'admin::app.acl.cart-rules',
      'route' => 'admin.cart-rules.index',
      'sort' => 1,
    ),
    69 => 
    array (
      'key' => 'marketing.promotions.cart-rules.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.cart-rules.create',
      'sort' => 1,
    ),
    70 => 
    array (
      'key' => 'marketing.promotions.cart-rules.copy',
      'name' => 'admin::app.acl.copy',
      'route' => 'admin.cart-rules.copy',
      'sort' => 1,
    ),
    71 => 
    array (
      'key' => 'marketing.promotions.cart-rules.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.cart-rules.edit',
      'sort' => 2,
    ),
    72 => 
    array (
      'key' => 'marketing.promotions.cart-rules.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.cart-rules.delete',
      'sort' => 3,
    ),
    73 => 
    array (
      'key' => 'marketing.promotions.catalog-rules',
      'name' => 'admin::app.acl.catalog-rules',
      'route' => 'admin.catalog-rules.index',
      'sort' => 1,
    ),
    74 => 
    array (
      'key' => 'marketing.promotions.catalog-rules.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.catalog-rules.index',
      'sort' => 1,
    ),
    75 => 
    array (
      'key' => 'marketing.promotions.catalog-rules.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.catalog-rules.edit',
      'sort' => 2,
    ),
    76 => 
    array (
      'key' => 'marketing.promotions.catalog-rules.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.catalog-rules.delete',
      'sort' => 3,
    ),
    77 => 
    array (
      'key' => 'marketing.email-marketing',
      'name' => 'admin::app.acl.email-marketing',
      'route' => 'admin.email-templates.index',
      'sort' => 7,
    ),
    78 => 
    array (
      'key' => 'marketing.email-marketing.email-templates',
      'name' => 'admin::app.acl.email-templates',
      'route' => 'admin.email-templates.index',
      'sort' => 1,
    ),
    79 => 
    array (
      'key' => 'marketing.email-marketing.email-templates.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.email-templates.create',
      'sort' => 1,
    ),
    80 => 
    array (
      'key' => 'marketing.email-marketing.email-templates.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.email-templates.edit',
      'sort' => 2,
    ),
    81 => 
    array (
      'key' => 'marketing.email-marketing.email-templates.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.email-templates.delete',
      'sort' => 3,
    ),
    82 => 
    array (
      'key' => 'marketing.email-marketing.events',
      'name' => 'admin::app.acl.events',
      'route' => 'admin.events.index',
      'sort' => 1,
    ),
    83 => 
    array (
      'key' => 'marketing.email-marketing.events.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.events.create',
      'sort' => 1,
    ),
    84 => 
    array (
      'key' => 'marketing.email-marketing.events.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.events.edit',
      'sort' => 2,
    ),
    85 => 
    array (
      'key' => 'marketing.email-marketing.events.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.events.delete',
      'sort' => 3,
    ),
    86 => 
    array (
      'key' => 'marketing.email-marketing.campaigns',
      'name' => 'admin::app.acl.campaigns',
      'route' => 'admin.campaigns.index',
      'sort' => 1,
    ),
    87 => 
    array (
      'key' => 'marketing.email-marketing.campaigns.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.campaigns.create',
      'sort' => 1,
    ),
    88 => 
    array (
      'key' => 'marketing.email-marketing.campaigns.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.campaigns.edit',
      'sort' => 2,
    ),
    89 => 
    array (
      'key' => 'marketing.email-marketing.campaigns.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.campaigns.delete',
      'sort' => 3,
    ),
    90 => 
    array (
      'key' => 'marketing.email-marketing.subscribers',
      'name' => 'admin::app.acl.subscribers',
      'route' => 'admin.customers.subscribers.index',
      'sort' => 1,
    ),
    91 => 
    array (
      'key' => 'marketing.email-marketing.subscribers.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.customers.subscribers.edit',
      'sort' => 2,
    ),
    92 => 
    array (
      'key' => 'marketing.email-marketing.subscribers.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.customers.subscribers.delete',
      'sort' => 3,
    ),
    93 => 
    array (
      'key' => 'cms',
      'name' => 'admin::app.layouts.cms',
      'route' => 'admin.cms.index',
      'sort' => 7,
    ),
    94 => 
    array (
      'key' => 'cms.pages',
      'name' => 'admin::app.cms.pages.pages',
      'route' => 'admin.cms.index',
      'sort' => 7,
    ),
    95 => 
    array (
      'key' => 'cms.pages.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.cms.create',
      'sort' => 1,
    ),
    96 => 
    array (
      'key' => 'cms.pages.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.cms.edit',
      'sort' => 2,
    ),
    97 => 
    array (
      'key' => 'cms.pages.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.cms.delete',
      'sort' => 3,
    ),
    98 => 
    array (
      'key' => 'cms.pages.mass-delete',
      'name' => 'admin::app.acl.mass-delete',
      'route' => 'admin.cms.mass-delete',
      'sort' => 4,
    ),
    99 => 
    array (
      'key' => 'settings',
      'name' => 'admin::app.acl.settings',
      'route' => 'admin.users.index',
      'sort' => 8,
    ),
    100 => 
    array (
      'key' => 'settings.locales',
      'name' => 'admin::app.acl.locales',
      'route' => 'admin.locales.index',
      'sort' => 1,
    ),
    101 => 
    array (
      'key' => 'settings.locales.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.locales.create',
      'sort' => 1,
    ),
    102 => 
    array (
      'key' => 'settings.locales.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.locales.edit',
      'sort' => 2,
    ),
    103 => 
    array (
      'key' => 'settings.locales.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.locales.delete',
      'sort' => 3,
    ),
    104 => 
    array (
      'key' => 'settings.currencies',
      'name' => 'admin::app.acl.currencies',
      'route' => 'admin.currencies.index',
      'sort' => 2,
    ),
    105 => 
    array (
      'key' => 'settings.currencies.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.currencies.create',
      'sort' => 1,
    ),
    106 => 
    array (
      'key' => 'settings.currencies.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.currencies.edit',
      'sort' => 2,
    ),
    107 => 
    array (
      'key' => 'settings.currencies.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.currencies.delete',
      'sort' => 3,
    ),
    108 => 
    array (
      'key' => 'settings.exchange_rates',
      'name' => 'admin::app.acl.exchange-rates',
      'route' => 'admin.exchange_rates.index',
      'sort' => 3,
    ),
    109 => 
    array (
      'key' => 'settings.exchange_rates.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.exchange_rates.create',
      'sort' => 1,
    ),
    110 => 
    array (
      'key' => 'settings.exchange_rates.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.exchange_rates.edit',
      'sort' => 2,
    ),
    111 => 
    array (
      'key' => 'settings.exchange_rates.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.exchange_rates.delete',
      'sort' => 3,
    ),
    112 => 
    array (
      'key' => 'settings.inventory_sources',
      'name' => 'admin::app.acl.inventory-sources',
      'route' => 'admin.inventory_sources.index',
      'sort' => 4,
    ),
    113 => 
    array (
      'key' => 'settings.inventory_sources.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.inventory_sources.create',
      'sort' => 1,
    ),
    114 => 
    array (
      'key' => 'settings.inventory_sources.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.inventory_sources.edit',
      'sort' => 2,
    ),
    115 => 
    array (
      'key' => 'settings.inventory_sources.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.inventory_sources.delete',
      'sort' => 3,
    ),
    116 => 
    array (
      'key' => 'settings.channels',
      'name' => 'admin::app.acl.channels',
      'route' => 'admin.channels.index',
      'sort' => 5,
    ),
    117 => 
    array (
      'key' => 'settings.channels.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.channels.create',
      'sort' => 1,
    ),
    118 => 
    array (
      'key' => 'settings.channels.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.channels.edit',
      'sort' => 2,
    ),
    119 => 
    array (
      'key' => 'settings.channels.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.channels.delete',
      'sort' => 3,
    ),
    120 => 
    array (
      'key' => 'settings.users',
      'name' => 'admin::app.acl.users',
      'route' => 'admin.users.index',
      'sort' => 6,
    ),
    121 => 
    array (
      'key' => 'settings.users.users',
      'name' => 'admin::app.acl.users',
      'route' => 'admin.users.index',
      'sort' => 1,
    ),
    122 => 
    array (
      'key' => 'settings.users.users.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.users.create',
      'sort' => 1,
    ),
    123 => 
    array (
      'key' => 'settings.users.users.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.users.edit',
      'sort' => 2,
    ),
    124 => 
    array (
      'key' => 'settings.users.users.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.users.delete',
      'sort' => 3,
    ),
    125 => 
    array (
      'key' => 'settings.users.roles',
      'name' => 'admin::app.acl.roles',
      'route' => 'admin.roles.index',
      'sort' => 2,
    ),
    126 => 
    array (
      'key' => 'settings.users.roles.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.roles.create',
      'sort' => 1,
    ),
    127 => 
    array (
      'key' => 'settings.users.roles.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.roles.edit',
      'sort' => 2,
    ),
    128 => 
    array (
      'key' => 'settings.users.roles.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.roles.delete',
      'sort' => 3,
    ),
    129 => 
    array (
      'key' => 'settings.sliders',
      'name' => 'admin::app.acl.sliders',
      'route' => 'admin.sliders.index',
      'sort' => 7,
    ),
    130 => 
    array (
      'key' => 'settings.sliders.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.sliders.create',
      'sort' => 1,
    ),
    131 => 
    array (
      'key' => 'settings.sliders.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.sliders.edit',
      'sort' => 2,
    ),
    132 => 
    array (
      'key' => 'settings.sliders.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.sliders.delete',
      'sort' => 3,
    ),
    133 => 
    array (
      'key' => 'settings.taxes',
      'name' => 'admin::app.acl.taxes',
      'route' => 'admin.tax-categories.index',
      'sort' => 8,
    ),
    134 => 
    array (
      'key' => 'settings.taxes.tax-categories',
      'name' => 'admin::app.acl.tax-categories',
      'route' => 'admin.tax-categories.index',
      'sort' => 1,
    ),
    135 => 
    array (
      'key' => 'settings.taxes.tax-categories.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.tax-categories.create',
      'sort' => 1,
    ),
    136 => 
    array (
      'key' => 'settings.taxes.tax-categories.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.tax-categories.edit',
      'sort' => 2,
    ),
    137 => 
    array (
      'key' => 'settings.taxes.tax-categories.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.tax-categories.delete',
      'sort' => 3,
    ),
    138 => 
    array (
      'key' => 'settings.taxes.tax-rates',
      'name' => 'admin::app.acl.tax-rates',
      'route' => 'admin.tax-rates.index',
      'sort' => 2,
    ),
    139 => 
    array (
      'key' => 'settings.taxes.tax-rates.create',
      'name' => 'admin::app.acl.create',
      'route' => 'admin.tax-rates.create',
      'sort' => 1,
    ),
    140 => 
    array (
      'key' => 'settings.taxes.tax-rates.edit',
      'name' => 'admin::app.acl.edit',
      'route' => 'admin.tax-rates.edit',
      'sort' => 2,
    ),
    141 => 
    array (
      'key' => 'settings.taxes.tax-rates.delete',
      'name' => 'admin::app.acl.delete',
      'route' => 'admin.tax-rates.delete',
      'sort' => 3,
    ),
    142 => 
    array (
      'key' => 'configuration',
      'name' => 'admin::app.acl.configure',
      'route' => 'admin.configuration.index',
      'sort' => 9,
    ),
    143 => 
    array (
      'key' => 'suggestion',
      'name' => 'Suggestion',
      'route' => 'suggestion.admin.index',
      'sort' => 2,
    ),
  ),
  'app' => 
  array (
    'name' => 'WorldEkart',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost:8000',
    'admin_url' => 'admin',
    'timezone' => 'Asia/Kolkata',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'default_country' => NULL,
    'currency' => 'USD',
    'channel' => 'default',
    'key' => 'base64:/WwUYivYmGAbYHYDZDbQ8fmQiz8BcnkYJU+fF68FYjg=',
    'cipher' => 'AES-256-CBC',
    'editor' => 'vscode',
    'version' => '1.0.1',
    'debug_blacklist' => 
    array (
      '_ENV' => 
      array (
        0 => 'APP_KEY',
        1 => 'DB_PASSWORD',
      ),
      '_SERVER' => 
      array (
        0 => 'APP_KEY',
        1 => 'DB_PASSWORD',
      ),
      '_POST' => 
      array (
        0 => 'password',
      ),
    ),
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Astrotomic\\Translatable\\TranslatableServiceProvider',
      23 => 'Intervention\\Image\\ImageServiceProvider',
      24 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      25 => 'App\\Providers\\AppServiceProvider',
      26 => 'App\\Providers\\AuthServiceProvider',
      27 => 'App\\Providers\\EventServiceProvider',
      28 => 'App\\Providers\\RouteServiceProvider',
      29 => 'Prettus\\Repository\\Providers\\RepositoryServiceProvider',
      30 => 'Konekt\\Concord\\ConcordServiceProvider',
      31 => 'Flynsarmy\\DbBladeCompiler\\DbBladeCompilerServiceProvider',
      32 => 'Barryvdh\\DomPDF\\ServiceProvider',
      33 => 'Webkul\\Theme\\Providers\\ThemeServiceProvider',
      34 => 'Webkul\\User\\Providers\\UserServiceProvider',
      35 => 'Webkul\\Admin\\Providers\\AdminServiceProvider',
      36 => 'Webkul\\Ui\\Providers\\UiServiceProvider',
      37 => 'Webkul\\Category\\Providers\\CategoryServiceProvider',
      38 => 'Webkul\\Attribute\\Providers\\AttributeServiceProvider',
      39 => 'Webkul\\Core\\Providers\\CoreServiceProvider',
      40 => 'Webkul\\Core\\Providers\\EnvValidatorServiceProvider',
      41 => 'Webkul\\Shop\\Providers\\ShopServiceProvider',
      42 => 'Webkul\\Customer\\Providers\\CustomerServiceProvider',
      43 => 'Webkul\\Inventory\\Providers\\InventoryServiceProvider',
      44 => 'Webkul\\Product\\Providers\\ProductServiceProvider',
      45 => 'Webkul\\Checkout\\Providers\\CheckoutServiceProvider',
      46 => 'Webkul\\Shipping\\Providers\\ShippingServiceProvider',
      47 => 'Webkul\\Payment\\Providers\\PaymentServiceProvider',
      48 => 'Webkul\\Paypal\\Providers\\PaypalServiceProvider',
      49 => 'Webkul\\Sales\\Providers\\SalesServiceProvider',
      50 => 'Webkul\\Tax\\Providers\\TaxServiceProvider',
      51 => 'Webkul\\CatalogRule\\Providers\\CatalogRuleServiceProvider',
      52 => 'Webkul\\CartRule\\Providers\\CartRuleServiceProvider',
      53 => 'Webkul\\Rule\\Providers\\RuleServiceProvider',
      54 => 'Webkul\\CMS\\Providers\\CMSServiceProvider',
      55 => 'Webkul\\Velocity\\Providers\\VelocityServiceProvider',
      56 => 'Webkul\\BookingProduct\\Providers\\BookingProductServiceProvider',
      57 => 'Webkul\\SocialLogin\\Providers\\SocialLoginServiceProvider',
      58 => 'Webkul\\DebugBar\\Providers\\DebugBarServiceProvider',
      59 => 'Webkul\\Marketing\\Providers\\MarketingServiceProvider',
      60 => 'Webkul\\Notification\\Providers\\NotificationServiceProvider',
      61 => 'Webkul\\SizeChart\\Providers\\SizeChartServiceProvider',
      62 => 'Wontonee\\Razorpay\\Providers\\RazorpayServiceProvider',
      63 => 'Wontonee\\Paytm\\Providers\\PaytmServiceProvider',
      64 => 'Webkul\\Bulkupload\\Providers\\BulkUploadServiceProvider',
      65 => 'RKREZA\\Contact\\Providers\\ContactServiceProvider',
      66 => 'Webkul\\suggestion\\Providers\\suggestionServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Captcha' => 'Webkul\\Customer\\Facades\\Captcha',
      'Cart' => 'Webkul\\Checkout\\Facades\\Cart',
      'Concord' => 'Konekt\\Concord\\Facades\\Concord',
      'Core' => 'Webkul\\Core\\Facades\\Core',
      'Datagrid' => 'Webkul\\Ui\\DataGrid\\Facades\\DataGrid',
      'DbView' => 'Flynsarmy\\DbBladeCompiler\\Facades\\DbView',
      'Debugbar' => 'Barryvdh\\Debugbar\\Facade',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'Helper' => 'Konekt\\Concord\\Facades\\Helper',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
      'ProductImage' => 'Webkul\\Product\\Facades\\ProductImage',
      'ProductVideo' => 'Webkul\\Product\\Facades\\ProductVideo',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'customer',
      'passwords' => 'customers',
    ),
    'guards' => 
    array (
      'customer' => 
      array (
        'driver' => 'session',
        'provider' => 'customers',
      ),
      'admin' => 
      array (
        'driver' => 'session',
        'provider' => 'admins',
      ),
      'api' => 
      array (
        'driver' => 'jwt',
        'provider' => 'customers',
      ),
      'admin-api' => 
      array (
        'driver' => 'jwt',
        'provider' => 'admins',
      ),
      'sanctum' => 
      array (
        'driver' => 'sanctum',
        'provider' => NULL,
      ),
    ),
    'providers' => 
    array (
      'customers' => 
      array (
        'driver' => 'eloquent',
        'model' => 'Webkul\\Customer\\Models\\Customer',
      ),
      'admins' => 
      array (
        'driver' => 'eloquent',
        'model' => 'Webkul\\User\\Models\\Admin',
      ),
    ),
    'passwords' => 
    array (
      'customers' => 
      array (
        'provider' => 'customers',
        'table' => 'customer_password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
      'admins' => 
      array (
        'provider' => 'admins',
        'table' => 'admin_password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
  ),
  'breadcrumbs' => 
  array (
    'view' => 'breadcrumbs::bootstrap5',
    'files' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\routes/breadcrumbs.php',
    'unnamed-route-exception' => true,
    'missing-route-bound-breadcrumb-exception' => true,
    'invalid-named-breadcrumb-exception' => true,
    'manager-class' => 'Diglactic\\Breadcrumbs\\Manager',
    'generator-class' => 'Diglactic\\Breadcrumbs\\Generator',
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
    ),
    'prefix' => 'worldekart_cache',
  ),
  'carriers' => 
  array (
    'flatrate' => 
    array (
      'code' => 'flatrate',
      'title' => 'Flat Rate',
      'description' => 'Flat Rate Shipping',
      'active' => true,
      'default_rate' => '10',
      'type' => 'per_unit',
      'class' => 'Webkul\\Shipping\\Carriers\\FlatRate',
    ),
    'free' => 
    array (
      'code' => 'free',
      'title' => 'Free Shipping',
      'description' => 'Free Shipping',
      'active' => true,
      'default_rate' => '0',
      'class' => 'Webkul\\Shipping\\Carriers\\Free',
    ),
    'dhl' => 
    array (
      'code' => 'dhl',
      'title' => 'DHL Shipping',
      'description' => 'DHL Shipping',
      'active' => true,
      'default_rate' => '15',
      'type' => 'per_unit',
      'class' => 'Webkul\\DHLShipping\\Carriers\\Dhl',
    ),
  ),
  'concord' => 
  array (
    'convention' => 'Webkul\\Core\\CoreConvention',
    'modules' => 
    array (
      0 => 'Webkul\\Admin\\Providers\\ModuleServiceProvider',
      1 => 'Webkul\\Attribute\\Providers\\ModuleServiceProvider',
      2 => 'Webkul\\BookingProduct\\Providers\\ModuleServiceProvider',
      3 => 'Webkul\\CartRule\\Providers\\ModuleServiceProvider',
      4 => 'Webkul\\CatalogRule\\Providers\\ModuleServiceProvider',
      5 => 'Webkul\\Category\\Providers\\ModuleServiceProvider',
      6 => 'Webkul\\Checkout\\Providers\\ModuleServiceProvider',
      7 => 'Webkul\\Core\\Providers\\ModuleServiceProvider',
      8 => 'Webkul\\CMS\\Providers\\ModuleServiceProvider',
      9 => 'Webkul\\Customer\\Providers\\ModuleServiceProvider',
      10 => 'Webkul\\Inventory\\Providers\\ModuleServiceProvider',
      11 => 'Webkul\\Marketing\\Providers\\ModuleServiceProvider',
      12 => 'Webkul\\Payment\\Providers\\ModuleServiceProvider',
      13 => 'Webkul\\Paypal\\Providers\\ModuleServiceProvider',
      14 => 'Webkul\\Product\\Providers\\ModuleServiceProvider',
      15 => 'Webkul\\Rule\\Providers\\ModuleServiceProvider',
      16 => 'Webkul\\Sales\\Providers\\ModuleServiceProvider',
      17 => 'Webkul\\Shipping\\Providers\\ModuleServiceProvider',
      18 => 'Webkul\\Shop\\Providers\\ModuleServiceProvider',
      19 => 'Webkul\\SocialLogin\\Providers\\ModuleServiceProvider',
      20 => 'Webkul\\Tax\\Providers\\ModuleServiceProvider',
      21 => 'Webkul\\Theme\\Providers\\ModuleServiceProvider',
      22 => 'Webkul\\Ui\\Providers\\ModuleServiceProvider',
      23 => 'Webkul\\User\\Providers\\ModuleServiceProvider',
      24 => 'Webkul\\Velocity\\Providers\\ModuleServiceProvider',
      25 => 'Webkul\\suggestion\\Providers\\ModuleServiceProvider',
      26 => 'RKREZA\\Contact\\Providers\\ModuleServiceProvider',
    ),
  ),
  'core' => 
  array (
    0 => 
    array (
      'key' => 'catalog.products.social_share',
      'name' => 'Social Share',
      'sort' => 100,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'enabled',
          'title' => 'Enable Social Share?',
          'type' => 'boolean',
        ),
        1 => 
        array (
          'name' => 'facebook',
          'title' => 'Enable Share in Facebook?',
          'type' => 'boolean',
        ),
        2 => 
        array (
          'name' => 'twitter',
          'title' => 'Enable Share in Twitter?',
          'type' => 'boolean',
        ),
        3 => 
        array (
          'name' => 'pinterest',
          'title' => 'Enable Share in Pinterest?',
          'type' => 'boolean',
        ),
        4 => 
        array (
          'name' => 'whatsapp',
          'title' => 'Enable Share in What\'s App?',
          'type' => 'boolean',
          'info' => 'What\'s App share link just will appear to mobile devices.',
        ),
        5 => 
        array (
          'name' => 'linkedin',
          'title' => 'Enable Share in Linkedin?',
          'type' => 'boolean',
        ),
        6 => 
        array (
          'name' => 'email',
          'title' => 'Enable Share in Email?',
          'type' => 'boolean',
        ),
        7 => 
        array (
          'name' => 'share_message',
          'title' => 'Share Message',
          'type' => 'text',
        ),
      ),
    ),
    1 => 
    array (
      'key' => 'catalog.products.size-chart',
      'name' => 'sizechart::app.admin.system.size-chart',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'enable-sizechart',
          'title' => 'sizechart::app.admin.system.enable-size-chart',
          'type' => 'boolean',
        ),
      ),
    ),
    2 => 
    array (
      'key' => 'customer.settings.social_login',
      'name' => 'sociallogin::app.admin.system.social-login',
      'sort' => 4,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'enable_facebook',
          'title' => 'sociallogin::app.admin.system.enable-facebook',
          'type' => 'boolean',
          'channel_based' => true,
        ),
        1 => 
        array (
          'name' => 'enable_twitter',
          'title' => 'sociallogin::app.admin.system.enable-twitter',
          'type' => 'boolean',
          'channel_based' => true,
        ),
        2 => 
        array (
          'name' => 'enable_google',
          'title' => 'sociallogin::app.admin.system.enable-google',
          'type' => 'boolean',
          'channel_based' => true,
        ),
        3 => 
        array (
          'name' => 'enable_linkedin',
          'title' => 'sociallogin::app.admin.system.enable-linkedin',
          'type' => 'boolean',
          'channel_based' => true,
        ),
        4 => 
        array (
          'name' => 'enable_github',
          'title' => 'sociallogin::app.admin.system.enable-github',
          'type' => 'boolean',
          'channel_based' => true,
        ),
      ),
    ),
    3 => 
    array (
      'key' => 'taxes',
      'name' => 'tax::app.admin.system.taxes.taxes',
      'sort' => 6,
    ),
    4 => 
    array (
      'key' => 'taxes.catalogue',
      'name' => 'tax::app.admin.system.taxes.catalogue',
      'sort' => 1,
    ),
    5 => 
    array (
      'key' => 'taxes.catalogue.pricing',
      'name' => 'tax::app.admin.system.taxes.pricing',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'tax_inclusive',
          'title' => 'tax::app.admin.system.taxes.tax-inclusive',
          'type' => 'boolean',
          'validation' => 'required',
          'default' => false,
        ),
      ),
    ),
    6 => 
    array (
      'key' => 'taxes.catalogue.default-location-calculation',
      'name' => 'tax::app.admin.system.taxes.default-location-calculation',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'country',
          'title' => 'tax::app.admin.system.taxes.default-country',
          'type' => 'country',
          'default' => '',
        ),
        1 => 
        array (
          'name' => 'state',
          'title' => 'tax::app.admin.system.taxes.default-state',
          'type' => 'state',
          'default' => '',
        ),
        2 => 
        array (
          'name' => 'post_code',
          'title' => 'tax::app.admin.system.taxes.default-post-code',
          'type' => 'text',
          'default' => '',
        ),
      ),
    ),
    7 => 
    array (
      'key' => 'sales',
      'name' => 'admin::app.admin.system.sales',
      'sort' => 5,
    ),
    8 => 
    array (
      'key' => 'sales.orderSettings',
      'name' => 'admin::app.admin.system.order-settings',
      'sort' => 4,
    ),
    9 => 
    array (
      'key' => 'sales.orderSettings.order_number',
      'name' => 'admin::app.admin.system.orderNumber',
      'sort' => 0,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'order_number_prefix',
          'title' => 'admin::app.admin.system.order-number-prefix',
          'type' => 'text',
          'validation' => false,
          'channel_based' => true,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'order_number_length',
          'title' => 'admin::app.admin.system.order-number-length',
          'type' => 'text',
          'validation' => 'numeric',
          'channel_based' => true,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'order_number_suffix',
          'title' => 'admin::app.admin.system.order-number-suffix',
          'type' => 'text',
          'validation' => false,
          'channel_based' => true,
          'locale_based' => true,
        ),
        3 => 
        array (
          'name' => 'order_number_generator_class',
          'title' => 'admin::app.admin.system.order-number-generator-class',
          'type' => 'text',
          'validation' => false,
          'channel_based' => true,
          'locale_based' => true,
        ),
      ),
    ),
    10 => 
    array (
      'key' => 'sales.orderSettings.minimum-order',
      'name' => 'admin::app.admin.system.minimum-order',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'minimum_order_amount',
          'title' => 'admin::app.admin.system.minimum-order-amount',
          'type' => 'text',
          'validation' => 'decimal',
          'channel_based' => true,
          'locale_based' => true,
        ),
      ),
    ),
    11 => 
    array (
      'key' => 'sales.invoice_setttings',
      'name' => 'admin::app.admin.system.invoice-settings',
      'sort' => 5,
    ),
    12 => 
    array (
      'key' => 'sales.invoice_setttings.invoice_number',
      'name' => 'admin::app.admin.system.invoice-number',
      'sort' => 0,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'invoice_number_prefix',
          'title' => 'admin::app.admin.system.invoice-number-prefix',
          'type' => 'text',
          'validation' => false,
          'channel_based' => true,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'invoice_number_length',
          'title' => 'admin::app.admin.system.invoice-number-length',
          'type' => 'text',
          'validation' => 'numeric',
          'channel_based' => true,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'invoice_number_suffix',
          'title' => 'admin::app.admin.system.invoice-number-suffix',
          'type' => 'text',
          'validation' => false,
          'channel_based' => true,
          'locale_based' => true,
        ),
        3 => 
        array (
          'name' => 'invoice_number_generator_class',
          'title' => 'admin::app.admin.system.invoice-number-generator-class',
          'type' => 'text',
          'validation' => false,
          'channel_based' => true,
          'locale_based' => true,
        ),
      ),
    ),
    13 => 
    array (
      'key' => 'sales.invoice_setttings.payment_terms',
      'name' => 'admin::app.admin.system.payment-terms',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'due_duration',
          'title' => 'admin::app.admin.system.due-duration',
          'type' => 'text',
          'validation' => 'numeric',
          'channel_based' => true,
        ),
      ),
    ),
    14 => 
    array (
      'key' => 'sales.invoice_setttings.invoice_slip_design',
      'name' => 'admin::app.admin.system.invoice-slip-design',
      'sort' => 2,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'logo',
          'title' => 'admin::app.admin.system.logo',
          'type' => 'image',
          'validation' => 'mimes:bmp,jpeg,jpg,png,webp',
          'channel_based' => true,
        ),
      ),
    ),
    15 => 
    array (
      'key' => 'sales.invoice_setttings.invoice_reminders',
      'name' => 'admin::app.admin.system.invoice-reminders',
      'sort' => 2,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'reminders_limit',
          'title' => 'admin::app.admin.system.maximum-limit-of-reminders',
          'type' => 'text',
          'validation' => 'numeric',
          'channel_based' => true,
        ),
        1 => 
        array (
          'name' => 'interval_between_reminders',
          'title' => 'admin::app.admin.system.interval-between-reminders',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => '1 day',
              'value' => 'P1D',
            ),
            1 => 
            array (
              'title' => '2 days',
              'value' => 'P2D',
            ),
            2 => 
            array (
              'title' => '3 days',
              'value' => 'P3D',
            ),
            3 => 
            array (
              'title' => '4 days',
              'value' => 'P4D',
            ),
            4 => 
            array (
              'title' => '5 days',
              'value' => 'P4D',
            ),
            5 => 
            array (
              'title' => '6 days',
              'value' => 'P4D',
            ),
            6 => 
            array (
              'title' => '7 days',
              'value' => 'P4D',
            ),
            7 => 
            array (
              'title' => '2 weeks',
              'value' => 'P2W',
            ),
            8 => 
            array (
              'title' => '3 weeks',
              'value' => 'P3W',
            ),
            9 => 
            array (
              'title' => '4 weeks',
              'value' => 'P4W',
            ),
          ),
        ),
      ),
    ),
    16 => 
    array (
      'key' => 'sales.paymentmethods.paypal_standard',
      'name' => 'admin::app.admin.system.paypal-standard',
      'sort' => 3,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
          'channel_based' => false,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => false,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'business_account',
          'title' => 'admin::app.admin.system.business-account',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
        ),
        3 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        4 => 
        array (
          'name' => 'sandbox',
          'title' => 'admin::app.admin.system.sandbox',
          'type' => 'boolean',
          'channel_based' => false,
          'locale_based' => true,
        ),
        5 => 
        array (
          'name' => 'sort',
          'title' => 'admin::app.admin.system.sort_order',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => '1',
              'value' => 1,
            ),
            1 => 
            array (
              'title' => '2',
              'value' => 2,
            ),
            2 => 
            array (
              'title' => '3',
              'value' => 3,
            ),
            3 => 
            array (
              'title' => '4',
              'value' => 4,
            ),
          ),
        ),
      ),
    ),
    17 => 
    array (
      'key' => 'sales.paymentmethods.paypal_smart_button',
      'name' => 'admin::app.admin.system.paypal-smart-button',
      'sort' => 0,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
          'channel_based' => false,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => false,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'client_id',
          'title' => 'admin::app.admin.system.client-id',
          'info' => 'admin::app.admin.system.client-id-info',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
        ),
        3 => 
        array (
          'name' => 'client_secret',
          'title' => 'admin::app.admin.system.client-secret',
          'info' => 'admin::app.admin.system.client-secret-info',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
        ),
        4 => 
        array (
          'name' => 'accepted_currencies',
          'title' => 'admin::app.admin.system.accepted-currencies',
          'info' => 'admin::app.admin.system.accepted-currencies-info',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
        ),
        5 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        6 => 
        array (
          'name' => 'sandbox',
          'title' => 'admin::app.admin.system.sandbox',
          'type' => 'boolean',
          'channel_based' => false,
          'locale_based' => true,
        ),
        7 => 
        array (
          'name' => 'sort',
          'title' => 'admin::app.admin.system.sort_order',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => '1',
              'value' => 1,
            ),
            1 => 
            array (
              'title' => '2',
              'value' => 2,
            ),
            2 => 
            array (
              'title' => '3',
              'value' => 3,
            ),
            3 => 
            array (
              'title' => '4',
              'value' => 4,
            ),
          ),
        ),
      ),
    ),
    18 => 
    array (
      'key' => 'sales.paymentmethods',
      'name' => 'admin::app.admin.system.payment-methods',
      'sort' => 3,
    ),
    19 => 
    array (
      'key' => 'sales.paymentmethods.cashondelivery',
      'name' => 'admin::app.admin.system.cash-on-delivery',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
          'channel_based' => true,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => true,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'instructions',
          'title' => 'admin::app.admin.system.instructions',
          'type' => 'textarea',
          'channel_based' => true,
          'locale_based' => true,
        ),
        3 => 
        array (
          'name' => 'generate_invoice',
          'title' => 'admin::app.admin.system.generate-invoice',
          'type' => 'boolean',
          'default_value' => false,
          'channel_based' => true,
          'locale_based' => false,
        ),
        4 => 
        array (
          'name' => 'invoice_status',
          'title' => 'admin::app.admin.system.set-invoice-status',
          'validation' => 'required_if:generate_invoice,1',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'admin::app.sales.invoices.status-pending',
              'value' => 'pending',
            ),
            1 => 
            array (
              'title' => 'admin::app.sales.invoices.status-paid',
              'value' => 'paid',
            ),
          ),
          'info' => 'admin::app.admin.system.generate-invoice-applicable',
          'channel_based' => true,
          'locale_based' => false,
        ),
        5 => 
        array (
          'name' => 'order_status',
          'title' => 'admin::app.admin.system.set-order-status',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'admin::app.sales.orders.order-status-pending',
              'value' => 'pending',
            ),
            1 => 
            array (
              'title' => 'admin::app.sales.orders.order-status-pending-payment',
              'value' => 'pending_payment',
            ),
            2 => 
            array (
              'title' => 'admin::app.sales.orders.order-status-processing',
              'value' => 'processing',
            ),
          ),
          'info' => 'admin::app.admin.system.generate-invoice-applicable',
          'channel_based' => true,
          'locale_based' => false,
        ),
        6 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => true,
        ),
        7 => 
        array (
          'name' => 'sort',
          'title' => 'admin::app.admin.system.sort_order',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => '1',
              'value' => 1,
            ),
            1 => 
            array (
              'title' => '2',
              'value' => 2,
            ),
            2 => 
            array (
              'title' => '3',
              'value' => 3,
            ),
            3 => 
            array (
              'title' => '4',
              'value' => 4,
            ),
          ),
        ),
      ),
    ),
    20 => 
    array (
      'key' => 'sales.paymentmethods.moneytransfer',
      'name' => 'admin::app.admin.system.money-transfer',
      'sort' => 2,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
          'channel_based' => true,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => true,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'generate_invoice',
          'title' => 'Automatically generate the invoice after placing an order',
          'type' => 'boolean',
          'default_value' => false,
          'channel_based' => true,
          'locale_based' => false,
        ),
        3 => 
        array (
          'name' => 'invoice_status',
          'title' => 'Invoice status after creating the invoice',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'admin::app.sales.invoices.status-pending',
              'value' => 'pending',
            ),
            1 => 
            array (
              'title' => 'admin::app.sales.invoices.status-paid',
              'value' => 'paid',
            ),
          ),
          'info' => 'admin::app.admin.system.generate-invoice-applicable',
        ),
        4 => 
        array (
          'name' => 'order_status',
          'title' => 'Order status after creating the invoice',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'admin::app.sales.orders.order-status-pending',
              'value' => 'pending',
            ),
            1 => 
            array (
              'title' => 'admin::app.sales.orders.order-status-pending-payment',
              'value' => 'pending_payment',
            ),
            2 => 
            array (
              'title' => 'admin::app.sales.orders.order-status-processing',
              'value' => 'processing',
            ),
          ),
          'info' => 'admin::app.admin.system.generate-invoice-applicable',
        ),
        5 => 
        array (
          'name' => 'mailing_address',
          'title' => 'admin::app.admin.system.mailing-address',
          'type' => 'textarea',
          'channel_based' => true,
          'locale_based' => true,
        ),
        6 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => true,
        ),
        7 => 
        array (
          'name' => 'sort',
          'title' => 'admin::app.admin.system.sort_order',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => '1',
              'value' => 1,
            ),
            1 => 
            array (
              'title' => '2',
              'value' => 2,
            ),
            2 => 
            array (
              'title' => '3',
              'value' => 3,
            ),
            3 => 
            array (
              'title' => '4',
              'value' => 4,
            ),
          ),
        ),
      ),
    ),
    21 => 
    array (
      'key' => 'sales.shipping',
      'name' => 'admin::app.admin.system.shipping',
      'sort' => 1,
    ),
    22 => 
    array (
      'key' => 'sales.shipping.origin',
      'name' => 'admin::app.admin.system.origin',
      'sort' => 0,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'country',
          'title' => 'admin::app.admin.system.country',
          'type' => 'country',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'state',
          'title' => 'admin::app.admin.system.state',
          'type' => 'state',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'city',
          'title' => 'admin::app.admin.system.city',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => false,
        ),
        3 => 
        array (
          'name' => 'address1',
          'title' => 'admin::app.admin.system.street-address',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => false,
        ),
        4 => 
        array (
          'name' => 'zipcode',
          'title' => 'admin::app.admin.system.zip',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => true,
          'locale_based' => false,
        ),
        5 => 
        array (
          'name' => 'store_name',
          'title' => 'admin::app.admin.system.store-name',
          'type' => 'text',
          'channel_based' => true,
        ),
        6 => 
        array (
          'name' => 'vat_number',
          'title' => 'admin::app.admin.system.vat-number',
          'type' => 'text',
          'channel_based' => true,
        ),
        7 => 
        array (
          'name' => 'contact',
          'title' => 'admin::app.admin.system.contact-number',
          'type' => 'text',
          'channel_based' => true,
        ),
        8 => 
        array (
          'name' => 'bank_details',
          'title' => 'admin::app.admin.system.bank-details',
          'type' => 'textarea',
          'channel_based' => true,
        ),
      ),
    ),
    23 => 
    array (
      'key' => 'sales.carriers',
      'name' => 'admin::app.admin.system.shipping-methods',
      'sort' => 2,
    ),
    24 => 
    array (
      'key' => 'sales.carriers.free',
      'name' => 'admin::app.admin.system.free-shipping',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
          'channel_based' => false,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => false,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
      ),
    ),
    25 => 
    array (
      'key' => 'sales.carriers.flatrate',
      'name' => 'admin::app.admin.system.flate-rate-shipping',
      'sort' => 2,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
          'channel_based' => true,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => true,
          'locale_based' => false,
        ),
        2 => 
        array (
          'name' => 'default_rate',
          'title' => 'admin::app.admin.system.rate',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
          'channel_based' => true,
          'locale_based' => false,
        ),
        3 => 
        array (
          'name' => 'type',
          'title' => 'admin::app.admin.system.type',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'Per Unit',
              'value' => 'per_unit',
            ),
            1 => 
            array (
              'title' => 'Per Order',
              'value' => 'per_order',
            ),
          ),
        ),
        4 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
      ),
    ),
    26 => 
    array (
      'key' => 'customer.captcha',
      'name' => 'customer::app.admin.system.captcha.title',
      'sort' => 2,
    ),
    27 => 
    array (
      'key' => 'customer.captcha.credentials',
      'name' => 'customer::app.admin.system.captcha.credentials',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'site_key',
          'title' => 'customer::app.admin.system.captcha.site-key',
          'type' => 'text',
          'channel_based' => true,
        ),
        1 => 
        array (
          'name' => 'secret_key',
          'title' => 'customer::app.admin.system.captcha.secret-key',
          'type' => 'text',
          'channel_based' => true,
        ),
        2 => 
        array (
          'name' => 'status',
          'title' => 'customer::app.admin.system.captcha.status',
          'type' => 'boolean',
          'channel_based' => true,
        ),
      ),
    ),
    28 => 
    array (
      'key' => 'general.content.shop',
      'name' => 'shop::app.products.settings',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'compare_option',
          'title' => 'shop::app.products.compare_options',
          'type' => 'boolean',
          'locale_based' => true,
          'channel_based' => true,
        ),
        1 => 
        array (
          'name' => 'wishlist_option',
          'title' => 'shop::app.products.wishlist-options',
          'type' => 'boolean',
          'locale_based' => true,
          'channel_based' => true,
        ),
        2 => 
        array (
          'name' => 'image_search',
          'title' => 'shop::app.search.image-search-option',
          'type' => 'boolean',
          'locale_based' => true,
          'channel_based' => true,
        ),
      ),
    ),
    29 => 
    array (
      'key' => 'sales.paymentmethods.paypal_standard',
      'name' => 'admin::app.admin.system.paypal-standard',
      'sort' => 3,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => false,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'business_account',
          'title' => 'admin::app.admin.system.business-account',
          'type' => 'text',
          'validation' => 'required',
        ),
        3 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        4 => 
        array (
          'name' => 'sandbox',
          'title' => 'admin::app.admin.system.sandbox',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        5 => 
        array (
          'name' => 'sort',
          'title' => 'admin::app.admin.system.sort_order',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => '1',
              'value' => 1,
            ),
            1 => 
            array (
              'title' => '2',
              'value' => 2,
            ),
            2 => 
            array (
              'title' => '3',
              'value' => 3,
            ),
            3 => 
            array (
              'title' => '4',
              'value' => 4,
            ),
          ),
        ),
      ),
    ),
    30 => 
    array (
      'key' => 'general',
      'name' => 'admin::app.admin.system.general',
      'sort' => 1,
    ),
    31 => 
    array (
      'key' => 'general.general',
      'name' => 'admin::app.admin.system.general',
      'sort' => 1,
    ),
    32 => 
    array (
      'key' => 'general.general.locale_options',
      'name' => 'admin::app.admin.system.locale-options',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'weight_unit',
          'title' => 'admin::app.admin.system.weight-unit',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'lbs',
              'value' => 'lbs',
            ),
            1 => 
            array (
              'title' => 'kgs',
              'value' => 'kgs',
            ),
          ),
          'channel_based' => true,
        ),
      ),
    ),
    33 => 
    array (
      'key' => 'general.content',
      'name' => 'admin::app.admin.system.content',
      'sort' => 2,
    ),
    34 => 
    array (
      'key' => 'general.content.footer',
      'name' => 'admin::app.admin.system.footer',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'footer_content',
          'title' => 'admin::app.admin.system.footer-content',
          'type' => 'text',
          'channel_based' => true,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'footer_toggle',
          'title' => 'admin::app.admin.system.footer-toggle',
          'type' => 'boolean',
          'locale_based' => true,
          'channel_based' => true,
        ),
      ),
    ),
    35 => 
    array (
      'key' => 'general.content.custom_scripts',
      'name' => 'admin::app.admin.system.custom-scripts',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'custom_css',
          'title' => 'admin::app.admin.system.custom-css',
          'type' => 'textarea',
          'channel_based' => true,
          'locale_based' => false,
        ),
        1 => 
        array (
          'name' => 'custom_javascript',
          'title' => 'admin::app.admin.system.custom-javascript',
          'type' => 'textarea',
          'channel_based' => true,
          'locale_based' => false,
        ),
      ),
    ),
    36 => 
    array (
      'key' => 'general.design',
      'name' => 'admin::app.admin.system.design',
      'sort' => 3,
    ),
    37 => 
    array (
      'key' => 'general.design.admin_logo',
      'name' => 'admin::app.admin.system.admin-logo',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'logo_image',
          'title' => 'admin::app.admin.system.logo-image',
          'type' => 'image',
          'channel_based' => true,
          'validation' => 'mimes:bmp,jpeg,jpg,png,webp',
        ),
        1 => 
        array (
          'name' => 'favicon',
          'title' => 'admin::app.admin.system.favicon',
          'type' => 'image',
          'channel_based' => true,
          'validation' => 'mimes:bmp,jpeg,jpg,png,webp',
        ),
      ),
    ),
    38 => 
    array (
      'key' => 'catalog',
      'name' => 'admin::app.admin.system.catalog',
      'sort' => 2,
    ),
    39 => 
    array (
      'key' => 'catalog.products',
      'name' => 'admin::app.admin.system.products',
      'sort' => 2,
    ),
    40 => 
    array (
      'key' => 'catalog.products.guest-checkout',
      'name' => 'admin::app.admin.system.guest-checkout',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'allow-guest-checkout',
          'title' => 'admin::app.admin.system.allow-guest-checkout',
          'type' => 'boolean',
        ),
      ),
    ),
    41 => 
    array (
      'key' => 'catalog.products.homepage',
      'name' => 'admin::app.admin.system.homepage',
      'sort' => 2,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'no_of_new_product_homepage',
          'title' => 'admin::app.admin.system.allow-no-of-new-product-homepage',
          'type' => 'number',
          'validation' => 'min:0',
        ),
        1 => 
        array (
          'name' => 'no_of_featured_product_homepage',
          'title' => 'admin::app.admin.system.allow-no-of-featured-product-homepage',
          'type' => 'number',
          'validation' => 'min:0',
        ),
        2 => 
        array (
          'name' => 'out_of_stock_items',
          'title' => 'admin::app.admin.system.allow-out-of-stock-items',
          'type' => 'boolean',
        ),
      ),
    ),
    42 => 
    array (
      'key' => 'catalog.products.storefront',
      'name' => 'admin::app.admin.system.storefront',
      'sort' => 3,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'mode',
          'title' => 'admin::app.admin.system.default-list-mode',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'admin::app.admin.system.grid',
              'value' => 'grid',
            ),
            1 => 
            array (
              'title' => 'admin::app.admin.system.list',
              'value' => 'list',
            ),
          ),
          'channel_based' => true,
        ),
        1 => 
        array (
          'name' => 'products_per_page',
          'title' => 'admin::app.admin.system.products-per-page',
          'type' => 'text',
          'info' => 'admin::app.admin.system.comma-seperated',
          'channel_based' => true,
        ),
        2 => 
        array (
          'name' => 'sort_by',
          'title' => 'admin::app.admin.system.sort-by',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'admin::app.admin.system.from-z-a',
              'value' => 'name-desc',
            ),
            1 => 
            array (
              'title' => 'admin::app.admin.system.from-a-z',
              'value' => 'name-asc',
            ),
            2 => 
            array (
              'title' => 'admin::app.admin.system.newest-first',
              'value' => 'created_at-desc',
            ),
            3 => 
            array (
              'title' => 'admin::app.admin.system.oldest-first',
              'value' => 'created_at-asc',
            ),
            4 => 
            array (
              'title' => 'admin::app.admin.system.cheapest-first',
              'value' => 'price-asc',
            ),
            5 => 
            array (
              'title' => 'admin::app.admin.system.expensive-first',
              'value' => 'price-desc',
            ),
          ),
          'channel_based' => true,
        ),
        3 => 
        array (
          'name' => 'buy_now_button_display',
          'title' => 'admin::app.admin.system.buy-now-button-display',
          'type' => 'boolean',
        ),
      ),
    ),
    43 => 
    array (
      'key' => 'catalog.products.cache-small-image',
      'name' => 'admin::app.admin.system.cache-small-image',
      'sort' => 4,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'width',
          'title' => 'admin::app.admin.system.width',
          'type' => 'text',
        ),
        1 => 
        array (
          'name' => 'height',
          'title' => 'admin::app.admin.system.height',
          'type' => 'text',
        ),
      ),
    ),
    44 => 
    array (
      'key' => 'catalog.products.cache-medium-image',
      'name' => 'admin::app.admin.system.cache-medium-image',
      'sort' => 5,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'width',
          'title' => 'admin::app.admin.system.width',
          'type' => 'text',
        ),
        1 => 
        array (
          'name' => 'height',
          'title' => 'admin::app.admin.system.height',
          'type' => 'text',
        ),
      ),
    ),
    45 => 
    array (
      'key' => 'catalog.products.cache-large-image',
      'name' => 'admin::app.admin.system.cache-large-image',
      'sort' => 6,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'width',
          'title' => 'admin::app.admin.system.width',
          'type' => 'text',
        ),
        1 => 
        array (
          'name' => 'height',
          'title' => 'admin::app.admin.system.height',
          'type' => 'text',
        ),
      ),
    ),
    46 => 
    array (
      'key' => 'catalog.products.review',
      'name' => 'admin::app.admin.system.review',
      'sort' => 7,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'guest_review',
          'title' => 'admin::app.admin.system.allow-guest-review',
          'type' => 'boolean',
        ),
      ),
    ),
    47 => 
    array (
      'key' => 'catalog.products.attribute',
      'name' => 'admin::app.admin.system.attribute',
      'sort' => 8,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'image_attribute_upload_size',
          'title' => 'admin::app.admin.system.image-upload-size',
          'type' => 'text',
        ),
        1 => 
        array (
          'name' => 'file_attribute_upload_size',
          'title' => 'admin::app.admin.system.file-upload-size',
          'type' => 'text',
        ),
      ),
    ),
    48 => 
    array (
      'key' => 'catalog.inventory',
      'name' => 'admin::app.admin.system.inventory',
      'sort' => 1,
    ),
    49 => 
    array (
      'key' => 'catalog.inventory.stock_options',
      'name' => 'admin::app.admin.system.stock-options',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'backorders',
          'title' => 'admin::app.admin.system.allow-backorders',
          'type' => 'boolean',
          'channel_based' => true,
        ),
      ),
    ),
    50 => 
    array (
      'key' => 'catalog.rich_snippets',
      'name' => 'admin::app.admin.system.rich-snippets',
      'sort' => 3,
    ),
    51 => 
    array (
      'key' => 'catalog.rich_snippets.products',
      'name' => 'admin::app.admin.system.products',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'enable',
          'title' => 'admin::app.admin.system.enable',
          'type' => 'boolean',
        ),
        1 => 
        array (
          'name' => 'show_sku',
          'title' => 'admin::app.admin.system.show-sku',
          'type' => 'boolean',
        ),
        2 => 
        array (
          'name' => 'show_weight',
          'title' => 'admin::app.admin.system.show-weight',
          'type' => 'boolean',
        ),
        3 => 
        array (
          'name' => 'show_categories',
          'title' => 'admin::app.admin.system.show-categories',
          'type' => 'boolean',
        ),
        4 => 
        array (
          'name' => 'show_images',
          'title' => 'admin::app.admin.system.show-images',
          'type' => 'boolean',
        ),
        5 => 
        array (
          'name' => 'show_reviews',
          'title' => 'admin::app.admin.system.show-reviews',
          'type' => 'boolean',
        ),
        6 => 
        array (
          'name' => 'show_ratings',
          'title' => 'admin::app.admin.system.show-ratings',
          'type' => 'boolean',
        ),
        7 => 
        array (
          'name' => 'show_offers',
          'title' => 'admin::app.admin.system.show-offers',
          'type' => 'boolean',
        ),
      ),
    ),
    52 => 
    array (
      'key' => 'catalog.rich_snippets.categories',
      'name' => 'admin::app.admin.system.categories',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'enable',
          'title' => 'admin::app.admin.system.enable',
          'type' => 'boolean',
        ),
        1 => 
        array (
          'name' => 'show_search_input_field',
          'title' => 'admin::app.admin.system.show-search-input-field',
          'type' => 'boolean',
        ),
      ),
    ),
    53 => 
    array (
      'key' => 'customer',
      'name' => 'admin::app.admin.system.customer',
      'sort' => 3,
    ),
    54 => 
    array (
      'key' => 'customer.address',
      'name' => 'admin::app.admin.system.address',
      'sort' => 1,
    ),
    55 => 
    array (
      'key' => 'customer.address.requirements',
      'name' => 'admin::app.admin.system.requirements',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'country',
          'title' => 'admin::app.admin.system.country',
          'type' => 'boolean',
          'channel_based' => true,
          'default' => '1',
        ),
        1 => 
        array (
          'name' => 'state',
          'title' => 'admin::app.admin.system.state',
          'type' => 'boolean',
          'channel_based' => true,
          'default' => '1',
        ),
        2 => 
        array (
          'name' => 'postcode',
          'title' => 'admin::app.admin.system.zip',
          'type' => 'boolean',
          'channel_based' => true,
          'default' => '1',
        ),
      ),
    ),
    56 => 
    array (
      'key' => 'customer.address.information',
      'name' => 'Information',
      'sort' => 2,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'street_lines',
          'title' => 'admin::app.admin.system.street-lines',
          'type' => 'text',
          'validation' => 'between:1,4',
          'channel_based' => true,
        ),
      ),
    ),
    57 => 
    array (
      'key' => 'customer.settings',
      'name' => 'admin::app.admin.system.settings',
      'sort' => 3,
    ),
    58 => 
    array (
      'key' => 'customer.settings.wishlist',
      'name' => 'admin::app.admin.system.wishlist',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'share',
          'title' => 'admin::app.admin.system.wishlist-share',
          'type' => 'boolean',
        ),
      ),
    ),
    59 => 
    array (
      'key' => 'customer.settings.newsletter',
      'name' => 'admin::app.admin.system.newsletter',
      'sort' => 2,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'subscription',
          'title' => 'admin::app.admin.system.newsletter-subscription',
          'type' => 'boolean',
        ),
      ),
    ),
    60 => 
    array (
      'key' => 'customer.settings.email',
      'name' => 'admin::app.admin.system.email',
      'sort' => 3,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'verification',
          'title' => 'admin::app.admin.system.email-verification',
          'type' => 'boolean',
        ),
      ),
    ),
    61 => 
    array (
      'key' => 'emails',
      'name' => 'admin::app.admin.emails.email',
      'sort' => 4,
    ),
    62 => 
    array (
      'key' => 'emails.configure',
      'name' => 'admin::app.admin.system.email-settings',
      'sort' => 1,
    ),
    63 => 
    array (
      'key' => 'emails.configure.email_settings',
      'name' => 'admin::app.admin.system.email-settings',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'sender_name',
          'title' => 'admin::app.admin.system.email-sender-name',
          'type' => 'text',
          'info' => 'admin::app.admin.system.email-sender-name-tip',
          'validation' => 'required|max:50',
          'channel_based' => true,
          'default_value' => '',
        ),
        1 => 
        array (
          'name' => 'shop_email_from',
          'title' => 'admin::app.admin.system.shop-email-from',
          'type' => 'text',
          'info' => 'admin::app.admin.system.shop-email-from-tip',
          'validation' => 'required|email',
          'channel_based' => true,
          'default_value' => '',
        ),
        2 => 
        array (
          'name' => 'admin_name',
          'title' => 'admin::app.admin.system.admin-name',
          'type' => 'text',
          'info' => 'admin::app.admin.system.admin-name-tip',
          'validation' => 'required|max:50',
          'channel_based' => true,
          'default_value' => 'Admin',
        ),
        3 => 
        array (
          'name' => 'admin_email',
          'title' => 'admin::app.admin.system.admin-email',
          'type' => 'text',
          'info' => 'admin::app.admin.system.admin-email-tip',
          'validation' => 'required|email',
          'channel_based' => true,
          'default_value' => '',
        ),
      ),
    ),
    64 => 
    array (
      'key' => 'emails.general',
      'name' => 'admin::app.admin.emails.notification_label',
      'sort' => 1,
    ),
    65 => 
    array (
      'key' => 'emails.general.notifications',
      'name' => 'admin::app.admin.emails.notification_label',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'emails.general.notifications.verification',
          'title' => 'admin::app.admin.emails.notifications.verification',
          'type' => 'boolean',
        ),
        1 => 
        array (
          'name' => 'emails.general.notifications.registration',
          'title' => 'admin::app.admin.emails.notifications.registration',
          'type' => 'boolean',
        ),
        2 => 
        array (
          'name' => 'emails.general.notifications.customer-registration-confirmation-mail-to-admin',
          'title' => 'admin::app.admin.emails.notifications.customer-registration-confirmation-mail-to-admin',
          'type' => 'boolean',
        ),
        3 => 
        array (
          'name' => 'emails.general.notifications.customer',
          'title' => 'admin::app.admin.emails.notifications.customer',
          'type' => 'boolean',
        ),
        4 => 
        array (
          'name' => 'emails.general.notifications.new-order',
          'title' => 'admin::app.admin.emails.notifications.new-order',
          'type' => 'boolean',
        ),
        5 => 
        array (
          'name' => 'emails.general.notifications.new-admin',
          'title' => 'admin::app.admin.emails.notifications.new-admin',
          'type' => 'boolean',
        ),
        6 => 
        array (
          'name' => 'emails.general.notifications.new-invoice',
          'title' => 'admin::app.admin.emails.notifications.new-invoice',
          'type' => 'boolean',
        ),
        7 => 
        array (
          'name' => 'emails.general.notifications.new-refund',
          'title' => 'admin::app.admin.emails.notifications.new-refund',
          'type' => 'boolean',
        ),
        8 => 
        array (
          'name' => 'emails.general.notifications.new-shipment',
          'title' => 'admin::app.admin.emails.notifications.new-shipment',
          'type' => 'boolean',
        ),
        9 => 
        array (
          'name' => 'emails.general.notifications.new-inventory-source',
          'title' => 'admin::app.admin.emails.notifications.new-inventory-source',
          'type' => 'boolean',
        ),
        10 => 
        array (
          'name' => 'emails.general.notifications.cancel-order',
          'title' => 'admin::app.admin.emails.notifications.cancel-order',
          'type' => 'boolean',
        ),
      ),
    ),
    66 => 
    array (
      'key' => 'sales.paymentmethods.razorpay',
      'name' => 'Razorpay',
      'sort' => 5,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => false,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'key_id',
          'title' => 'admin::app.admin.system.key-id',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        3 => 
        array (
          'name' => 'secret',
          'title' => 'admin::app.admin.system.key-secret',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        4 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.status',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
      ),
    ),
    67 => 
    array (
      'key' => 'sales.paymentmethods.paytm',
      'name' => 'Paytm',
      'sort' => 4,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'admin::app.admin.system.title',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => false,
          'locale_based' => true,
        ),
        2 => 
        array (
          'name' => 'merchant_id',
          'title' => 'admin::app.admin.system.merchant-id',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        3 => 
        array (
          'name' => 'merchant_key',
          'title' => 'admin::app.admin.system.merchant-key',
          'type' => 'text',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        4 => 
        array (
          'name' => 'website',
          'title' => 'admin::app.admin.system.websitestatus',
          'type' => 'select',
          'options' => 
          array (
            0 => 
            array (
              'title' => 'Staging',
              'value' => 'WEBSTAGING',
            ),
            1 => 
            array (
              'title' => 'Live',
              'value' => 'DEFAULT',
            ),
          ),
        ),
        5 => 
        array (
          'name' => 'active',
          'title' => 'admin::app.admin.system.paytmstatus',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
      ),
    ),
    68 => 
    array (
      'key' => 'suggestion',
      'name' => 'Search Suggestion',
      'sort' => 1,
    ),
    69 => 
    array (
      'key' => 'suggestion.suggestion',
      'name' => 'Search Suggestion Settings',
      'sort' => 1,
    ),
    70 => 
    array (
      'key' => 'suggestion.suggestion.options',
      'name' => 'Options',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'show_terms',
          'title' => 'suggestion::app.admin.configuration.show-categories',
          'type' => 'text',
          'validation' => 'required|numeric|min:1|max:5',
          'channel_based' => true,
        ),
        1 => 
        array (
          'name' => 'show_products',
          'title' => 'suggestion::app.admin.configuration.show-products',
          'type' => 'text',
          'validation' => 'required|numeric|min:1|max:5',
          'channel_based' => true,
        ),
        2 => 
        array (
          'name' => 'display_terms_toggle',
          'title' => 'suggestion::app.admin.configuration.display-terms',
          'type' => 'boolean',
          'locale_based' => true,
          'channel_based' => true,
        ),
        3 => 
        array (
          'name' => 'display_product_toggle',
          'title' => 'suggestion::app.admin.configuration.display-product',
          'type' => 'boolean',
          'locale_based' => true,
          'channel_based' => true,
        ),
        4 => 
        array (
          'name' => 'display_categories_toggle',
          'title' => 'suggestion::app.admin.configuration.display-categories',
          'type' => 'boolean',
          'locale_based' => true,
          'channel_based' => true,
        ),
      ),
    ),
    71 => 
    array (
      'key' => 'rma',
      'name' => 'rma::app.admin.admin-name.rma',
      'sort' => 2,
    ),
    72 => 
    array (
      'key' => 'rma.settings',
      'name' => 'rma::app.admin.setting.settings',
      'sort' => 1,
    ),
    73 => 
    array (
      'key' => 'rma.settings.general',
      'name' => 'rma::app.admin.setting.general',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'enable_rma',
          'title' => 'rma::app.admin.setting.fields.enable',
          'type' => 'boolean',
          'channel_based' => true,
          'locale_based' => false,
        ),
        1 => 
        array (
          'name' => 'default_allow_days',
          'title' => 'rma::app.admin.setting.fields.default-allow-days',
          'type' => 'depends',
          'depend' => 'enable_rma:1',
          'validation' => 'required_if:enable_rma,1',
          'channel_based' => true,
          'locale_based' => false,
        ),
        2 => 
        array (
          'name' => 'enable_rma_for_pending_order',
          'title' => 'rma::app.admin.setting.fields.allow_new_request_for_pending_order',
          'type' => 'boolean',
          'channel_based' => true,
          'locale_based' => false,
        ),
      ),
    ),
    74 => 
    array (
      'key' => 'sales',
      'name' => 'admin::app.admin.system.sales',
      'sort' => 5,
    ),
    75 => 
    array (
      'key' => 'sales.carriers',
      'name' => 'admin::app.admin.system.shipping-methods',
      'sort' => 1,
    ),
    76 => 
    array (
      'key' => 'sales.carriers.dhl',
      'name' => 'dhl::app.admin.system.dhl',
      'sort' => 3,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'title',
          'title' => 'dhl::app.admin.system.title',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
          'channel_based' => false,
          'locale_based' => true,
        ),
        1 => 
        array (
          'name' => 'description',
          'title' => 'admin::app.admin.system.description',
          'type' => 'textarea',
          'channel_based' => true,
          'locale_based' => false,
        ),
        2 => 
        array (
          'name' => 'active',
          'title' => 'dhl::app.admin.system.enable-checkout',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        3 => 
        array (
          'name' => 'is_calculate_tax',
          'title' => 'admin::app.admin.system.calculate-tax',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => false,
        ),
        4 => 
        array (
          'name' => 'sandbox_mode',
          'title' => 'dhl::app.admin.system.sandbox-mode',
          'type' => 'boolean',
          'validation' => 'required',
          'channel_based' => false,
          'locale_based' => true,
        ),
        5 => 
        array (
          'name' => 'access_id',
          'title' => 'dhl::app.admin.system.access-id',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
          'channel_based' => false,
          'locale_based' => true,
        ),
        6 => 
        array (
          'name' => 'password',
          'title' => 'dhl::app.admin.system.password',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
          'channel_based' => false,
          'locale_based' => true,
        ),
        7 => 
        array (
          'name' => 'account_number',
          'title' => 'dhl::app.admin.system.account-number',
          'type' => 'depends',
          'depend' => 'active:1',
          'validation' => 'required_if:active,1',
          'channel_based' => false,
          'locale_based' => true,
        ),
        8 => 
        array (
          'name' => 'weight_unit',
          'title' => 'dhl::app.admin.system.weight-unit',
          'type' => 'select',
          'channel_based' => false,
          'locale_based' => true,
          'options' => 
          array (
            0 => 
            array (
              'title' => 'dhl::app.admin.system.kilograms',
              'value' => 'KG',
            ),
            1 => 
            array (
              'title' => 'dhl::app.admin.system.pounds',
              'value' => 'LB',
            ),
          ),
        ),
        9 => 
        array (
          'name' => 'dimension_unit',
          'title' => 'dhl::app.admin.system.dimension-unit',
          'type' => 'select',
          'channel_based' => false,
          'locale_based' => true,
          'options' => 
          array (
            0 => 
            array (
              'title' => 'dhl::app.admin.system.inches',
              'value' => 'IN',
            ),
            1 => 
            array (
              'title' => 'dhl::app.admin.system.cms',
              'value' => 'CM',
            ),
          ),
        ),
        10 => 
        array (
          'name' => 'height',
          'title' => 'dhl::app.admin.system.height',
          'type' => 'text',
          'channel_based' => false,
          'locale_based' => true,
        ),
        11 => 
        array (
          'name' => 'depth',
          'title' => 'dhl::app.admin.system.depth',
          'type' => 'text',
          'channel_based' => false,
          'locale_based' => true,
        ),
        12 => 
        array (
          'name' => 'width',
          'title' => 'dhl::app.admin.system.width',
          'type' => 'text',
          'channel_based' => false,
          'locale_based' => true,
        ),
        13 => 
        array (
          'name' => 'content_type',
          'title' => 'dhl::app.admin.system.content-type',
          'type' => 'select',
          'channel_based' => false,
          'locale_based' => true,
          'options' => 
          array (
            0 => 
            array (
              'title' => 'dhl::app.admin.system.documents',
              'value' => 'documents',
            ),
            1 => 
            array (
              'title' => 'dhl::app.admin.system.non-documents',
              'value' => 'non documents',
            ),
          ),
        ),
        14 => 
        array (
          'name' => 'allowed_methods',
          'title' => 'dhl::app.admin.system.allowed-methods',
          'type' => 'multiselect',
          'depend' => 'content_type:documents',
          'channel_based' => false,
          'locale_based' => true,
          'options' => 
          array (
            0 => 
            array (
              'title' => 'Easy shop',
              'value' => 'Easy shop',
            ),
            1 => 
            array (
              'title' => 'Sprintline',
              'value' => 'Sprintline',
            ),
            2 => 
            array (
              'title' => 'Secureline',
              'value' => 'Secureline',
            ),
            3 => 
            array (
              'title' => 'Express easy',
              'value' => 'Express easy',
            ),
            4 => 
            array (
              'title' => 'Europack',
              'value' => 'Europack',
            ),
            5 => 
            array (
              'title' => 'Break bulk express',
              'value' => 'Break bulk express',
            ),
            6 => 
            array (
              'title' => 'Medical express',
              'value' => 'Medical express',
            ),
            7 => 
            array (
              'title' => 'Express worldwide',
              'value' => 'Express worldwide',
            ),
            8 => 
            array (
              'title' => 'Express worldwide',
              'value' => 'Express worldwide',
            ),
            9 => 
            array (
              'title' => 'Express 9:00',
              'value' => 'Express 9:00',
            ),
            10 => 
            array (
              'title' => 'Express 10:30',
              'value' => 'Express 10:30',
            ),
            11 => 
            array (
              'title' => 'Domestic economy select',
              'value' => 'Domestic economy select',
            ),
            12 => 
            array (
              'title' => 'Economy select',
              'value' => 'Economy select',
            ),
            13 => 
            array (
              'title' => 'Domestic express 9:00',
              'value' => 'Domestic express 9:00',
            ),
            14 => 
            array (
              'title' => 'Domestic express',
              'value' => 'Domestic express',
            ),
            15 => 
            array (
              'title' => 'Others',
              'value' => 'Others',
            ),
            16 => 
            array (
              'title' => 'Globalmail business',
              'value' => 'Globalmail business',
            ),
            17 => 
            array (
              'title' => 'Same day',
              'value' => 'Same day',
            ),
            18 => 
            array (
              'title' => 'Express 12:00',
              'value' => 'Express 12:00',
            ),
            19 => 
            array (
              'title' => 'Express envelope',
              'value' => 'Express envelope',
            ),
            20 => 
            array (
              'title' => 'Domestic express 12:00 (Doc)',
              'value' => 'Domestic express 12:00 (Doc)',
            ),
            21 => 
            array (
              'title' => 'Easy shop (Doc)',
              'value' => 'Easy shop (Doc)',
            ),
            22 => 
            array (
              'title' => 'Jetline (Doc)',
              'value' => 'Jetline (Doc)',
            ),
            23 => 
            array (
              'title' => 'Express easy',
              'value' => 'Express easy (Doc)',
            ),
            24 => 
            array (
              'title' => 'Express worldwide (Doc)',
              'value' => 'Express worldwide (Doc)',
            ),
            25 => 
            array (
              'title' => 'Medical express (Doc)',
              'value' => 'Medical express (Doc)',
            ),
            26 => 
            array (
              'title' => 'Express 9:00',
              'value' => 'Express 9:00 (Doc)',
            ),
            27 => 
            array (
              'title' => 'Freight worldwide (Doc)',
              'value' => 'Freight worldwide (Doc)',
            ),
            28 => 
            array (
              'title' => 'Economy select (Doc)',
              'value' => 'Economy select (Doc)',
            ),
            29 => 
            array (
              'title' => 'Jumbo box (Doc)',
              'value' => 'Jumbo box (Doc)',
            ),
            30 => 
            array (
              'title' => 'Express 10:30 (Doc)',
              'value' => 'Express 10:30 (Doc)',
            ),
            31 => 
            array (
              'title' => 'Europack (Doc)',
              'value' => 'Europack (Doc)',
            ),
            32 => 
            array (
              'title' => 'Express 12:00 (Doc)',
              'value' => 'Express 12:00 (Doc)',
            ),
          ),
        ),
        15 => 
        array (
          'name' => 'ready_time',
          'title' => 'dhl::app.admin.system.ready-time',
          'type' => 'text',
          'info' => 'dhl::app.admin.system.note',
          'channel_based' => false,
          'locale_based' => true,
        ),
        16 => 
        array (
          'name' => 'allowed_country',
          'title' => 'dhl::app.admin.system.allow-country',
          'type' => 'multiselect',
          'channel_based' => true,
          'locale_based' => true,
          'repository' => 'Webkul\\DHLShipping\\Repositories\\DhlDetailRepository@getCountries',
        ),
      ),
    ),
    77 => 
    array (
      'key' => 'bulkupload',
      'name' => 'bulkupload::app.admin.system.bulkupload',
      'sort' => 5,
    ),
    78 => 
    array (
      'key' => 'bulkupload.settings',
      'name' => 'bulkupload::app.admin.system.settings',
      'sort' => 1,
    ),
    79 => 
    array (
      'key' => 'bulkupload.settings.general',
      'name' => 'bulkupload::app.admin.system.general',
      'sort' => 1,
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'status',
          'title' => 'bulkupload::app.admin.system.status',
          'type' => 'boolean',
          'channel_based' => true,
          'locale_based' => false,
        ),
      ),
    ),
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'ekart',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ekart',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => 'InnoDB ROW_FORMAT=DYNAMIC',
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ekart',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ekart',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
      'session' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '2',
      ),
    ),
  ),
  'db-blade-compiler' => 
  array (
    'model_property' => '__db_blade_compiler_content_field',
    'model_default_field' => 'content',
    'cache' => false,
  ),
  'debugbar' => 
  array (
    'enabled' => NULL,
    'except' => 
    array (
      0 => 'telescope*',
      1 => 'horizon*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\debugbar',
      'connection' => NULL,
      'provider' => '',
      'hostname' => '127.0.0.1',
      'port' => 2304,
    ),
    'editor' => 'phpstorm',
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => false,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => false,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => false,
      'cache' => false,
      'models' => true,
      'livewire' => true,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'backtrace_exclude_paths' => 
        array (
        ),
        'timeline' => false,
        'duration_background' => true,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => false,
        'show_copy' => false,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'timeline' => false,
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
    'theme' => 'auto',
    'debug_backtrace_limit' => 50,
  ),
  'discount-rules' => 
  array (
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'convert_entities' => true,
    'defines' => 
    array (
      'font_dir' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\fonts',
      'font_cache' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\fonts',
      'temp_dir' => 'C:\\Users\\coolp\\AppData\\Local\\Temp',
      'chroot' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
        'output_encoding' => '',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => NULL,
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
      'db' => 
      array (
        'connection' => NULL,
      ),
    ),
    'temporary_files' => 
    array (
      'local_path' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\framework/cache/laravel-excel',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'public',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\app',
      ),
      'private' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\app/private',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\app/public',
        'url' => 'http://localhost:8000/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
      ),
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'flare_middleware' => 
    array (
      0 => 'Spatie\\FlareClient\\FlareMiddleware\\RemoveRequestIp',
      1 => 'Spatie\\FlareClient\\FlareMiddleware\\AddGitInformation',
      2 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddNotifierName',
      3 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddEnvironmentInformation',
      4 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddExceptionInformation',
      5 => 'Spatie\\LaravelIgnition\\FlareMiddleware\\AddDumps',
      'Spatie\\LaravelIgnition\\FlareMiddleware\\AddLogs' => 
      array (
        'maximum_number_of_collected_logs' => 200,
      ),
      'Spatie\\LaravelIgnition\\FlareMiddleware\\AddQueries' => 
      array (
        'maximum_number_of_collected_queries' => 200,
        'report_query_bindings' => true,
      ),
      'Spatie\\LaravelIgnition\\FlareMiddleware\\AddJobs' => 
      array (
        'max_chained_job_reporting_depth' => 5,
      ),
      'Spatie\\FlareClient\\FlareMiddleware\\CensorRequestBodyFields' => 
      array (
        'censor_fields' => 
        array (
          0 => 'password',
          1 => 'password_confirmation',
        ),
      ),
      'Spatie\\FlareClient\\FlareMiddleware\\CensorRequestHeaders' => 
      array (
        'headers' => 
        array (
          0 => 'API-KEY',
        ),
      ),
    ),
    'send_logs_as_events' => true,
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'auto',
    'enable_share_button' => true,
    'register_commands' => false,
    'solution_providers' => 
    array (
      0 => 'Spatie\\Ignition\\Solutions\\SolutionProviders\\BadMethodCallSolutionProvider',
      1 => 'Spatie\\Ignition\\Solutions\\SolutionProviders\\MergeConflictSolutionProvider',
      2 => 'Spatie\\Ignition\\Solutions\\SolutionProviders\\UndefinedPropertySolutionProvider',
      3 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\IncorrectValetDbCredentialsSolutionProvider',
      4 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingAppKeySolutionProvider',
      5 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\DefaultDbNameSolutionProvider',
      6 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\TableNotFoundSolutionProvider',
      7 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingImportSolutionProvider',
      8 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\InvalidRouteActionSolutionProvider',
      9 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\ViewNotFoundSolutionProvider',
      10 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\RunningLaravelDuskInProductionProvider',
      11 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingColumnSolutionProvider',
      12 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\UnknownValidationSolutionProvider',
      13 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingMixManifestSolutionProvider',
      14 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingViteManifestSolutionProvider',
      15 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\MissingLivewireComponentSolutionProvider',
      16 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\UndefinedViewVariableSolutionProvider',
      17 => 'Spatie\\LaravelIgnition\\Solutions\\SolutionProviders\\GenericLaravelExceptionSolutionProvider',
    ),
    'ignored_solution_providers' => 
    array (
    ),
    'enable_runnable_solutions' => true,
    'remote_sites_path' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
    'settings_file_path' => '',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'imagecache' => 
  array (
    'route' => 'cache',
    'paths' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\app/public',
      1 => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\public\\storage',
    ),
    'templates' => 
    array (
      'small' => 'Webkul\\Product\\CacheFilters\\Small',
      'medium' => 'Webkul\\Product\\CacheFilters\\Medium',
      'large' => 'Webkul\\Product\\CacheFilters\\Large',
    ),
    'lifetime' => 525600,
  ),
  'jwt' => 
  array (
    'secret' => NULL,
    'keys' => 
    array (
      'public' => NULL,
      'private' => NULL,
      'passphrase' => NULL,
    ),
    'ttl' => 60,
    'refresh_ttl' => 20160,
    'algo' => 'HS256',
    'required_claims' => 
    array (
      0 => 'iss',
      1 => 'iat',
      2 => 'exp',
      3 => 'nbf',
      4 => 'sub',
      5 => 'jti',
    ),
    'persistent_claims' => 
    array (
    ),
    'lock_subject' => true,
    'leeway' => 0,
    'blacklist_enabled' => true,
    'blacklist_grace_period' => 0,
    'show_black_list_exception' => 0,
    'decrypt_cookies' => false,
    'providers' => 
    array (
      'jwt' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\JWT\\Lcobucci',
      'auth' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\Auth\\Illuminate',
      'storage' => 'PHPOpenSourceSaver\\JWTAuth\\Providers\\Storage\\Illuminate',
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 7,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'smtp.mailtrap.io',
        'port' => '2525',
        'encryption' => 'tls',
        'username' => '',
        'password' => '',
        'timeout' => NULL,
        'verify_peer' => false,
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs -i',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
      ),
    ),
    'from' => 
    array (
      'address' => '',
      'name' => '',
    ),
    'admin' => 
    array (
      'address' => '',
      'name' => 'Admin',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'menu' => 
  array (
    'admin' => 
    array (
      0 => 
      array (
        'key' => 'contact',
        'name' => 'contact_lang::app.contact.title',
        'route' => 'admin.contact.index',
        'sort' => 20,
        'icon-class' => 'dashboard-icon',
      ),
      1 => 
      array (
        'key' => 'contact.index',
        'name' => 'contact_lang::app.contact.title',
        'route' => 'admin.contact.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      2 => 
      array (
        'key' => 'sizechart',
        'name' => 'sizechart::app.layouts.sizechart',
        'route' => 'sizechart.admin.index',
        'sort' => 3,
        'icon-class' => 'dashboard-icon',
      ),
      3 => 
      array (
        'key' => 'sizechart.template',
        'name' => 'sizechart::app.layouts.sizechart-template',
        'route' => 'sizechart.admin.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      4 => 
      array (
        'key' => 'sales.bookings',
        'name' => 'bookingproduct::app.admin.sales.bookings.title',
        'route' => 'admin.sales.bookings.index',
        'sort' => 6,
        'icon-class' => '',
      ),
      5 => 
      array (
        'key' => 'settings.velocity',
        'name' => 'velocity::app.admin.layouts.velocity',
        'route' => 'velocity.admin.content.index',
        'sort' => 9,
        'icon-class' => '',
      ),
      6 => 
      array (
        'key' => 'settings.velocity.meta-data',
        'name' => 'velocity::app.admin.layouts.meta-data',
        'route' => 'velocity.admin.meta-data',
        'sort' => 1,
        'icon-class' => '',
      ),
      7 => 
      array (
        'key' => 'settings.velocity.header',
        'name' => 'velocity::app.admin.layouts.header-content',
        'route' => 'velocity.admin.content.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      8 => 
      array (
        'key' => 'dashboard',
        'name' => 'admin::app.layouts.dashboard',
        'route' => 'admin.dashboard.index',
        'sort' => 1,
        'icon-class' => 'dashboard-icon',
      ),
      9 => 
      array (
        'key' => 'sales',
        'name' => 'admin::app.layouts.sales',
        'route' => 'admin.sales.orders.index',
        'sort' => 2,
        'icon-class' => 'sales-icon',
      ),
      10 => 
      array (
        'key' => 'sales.orders',
        'name' => 'admin::app.layouts.orders',
        'route' => 'admin.sales.orders.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      11 => 
      array (
        'key' => 'sales.shipments',
        'name' => 'admin::app.layouts.shipments',
        'route' => 'admin.sales.shipments.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      12 => 
      array (
        'key' => 'sales.invoices',
        'name' => 'admin::app.layouts.invoices',
        'route' => 'admin.sales.invoices.index',
        'sort' => 3,
        'icon-class' => '',
      ),
      13 => 
      array (
        'key' => 'sales.refunds',
        'name' => 'admin::app.layouts.refunds',
        'route' => 'admin.sales.refunds.index',
        'sort' => 4,
        'icon-class' => '',
      ),
      14 => 
      array (
        'key' => 'sales.transactions',
        'name' => 'admin::app.layouts.transactions',
        'route' => 'admin.sales.transactions.index',
        'sort' => 5,
        'icon-class' => '',
      ),
      15 => 
      array (
        'key' => 'catalog',
        'name' => 'admin::app.layouts.catalog',
        'route' => 'admin.catalog.products.index',
        'sort' => 3,
        'icon-class' => 'catalog-icon',
      ),
      16 => 
      array (
        'key' => 'catalog.products',
        'name' => 'admin::app.layouts.products',
        'route' => 'admin.catalog.products.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      17 => 
      array (
        'key' => 'catalog.categories',
        'name' => 'admin::app.layouts.categories',
        'route' => 'admin.catalog.categories.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      18 => 
      array (
        'key' => 'catalog.attributes',
        'name' => 'admin::app.layouts.attributes',
        'route' => 'admin.catalog.attributes.index',
        'sort' => 3,
        'icon-class' => '',
      ),
      19 => 
      array (
        'key' => 'catalog.families',
        'name' => 'admin::app.layouts.attribute-families',
        'route' => 'admin.catalog.families.index',
        'sort' => 4,
        'icon-class' => '',
      ),
      20 => 
      array (
        'key' => 'customers',
        'name' => 'admin::app.layouts.customers',
        'route' => 'admin.customer.index',
        'sort' => 4,
        'icon-class' => 'customer-icon',
      ),
      21 => 
      array (
        'key' => 'customers.customers',
        'name' => 'admin::app.layouts.customers',
        'route' => 'admin.customer.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      22 => 
      array (
        'key' => 'customers.groups',
        'name' => 'admin::app.layouts.groups',
        'route' => 'admin.groups.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      23 => 
      array (
        'key' => 'customers.reviews',
        'name' => 'admin::app.layouts.reviews',
        'route' => 'admin.customer.review.index',
        'sort' => 3,
        'icon-class' => '',
      ),
      24 => 
      array (
        'key' => 'configuration',
        'name' => 'admin::app.layouts.configure',
        'route' => 'admin.configuration.index',
        'sort' => 7,
        'icon-class' => 'configuration-icon',
      ),
      25 => 
      array (
        'key' => 'settings',
        'name' => 'admin::app.layouts.settings',
        'route' => 'admin.locales.index',
        'sort' => 6,
        'icon-class' => 'settings-icon',
      ),
      26 => 
      array (
        'key' => 'settings.locales',
        'name' => 'admin::app.layouts.locales',
        'route' => 'admin.locales.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      27 => 
      array (
        'key' => 'settings.currencies',
        'name' => 'admin::app.layouts.currencies',
        'route' => 'admin.currencies.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      28 => 
      array (
        'key' => 'settings.exchange_rates',
        'name' => 'admin::app.layouts.exchange-rates',
        'route' => 'admin.exchange_rates.index',
        'sort' => 3,
        'icon-class' => '',
      ),
      29 => 
      array (
        'key' => 'settings.inventory_sources',
        'name' => 'admin::app.layouts.inventory-sources',
        'route' => 'admin.inventory_sources.index',
        'sort' => 4,
        'icon-class' => '',
      ),
      30 => 
      array (
        'key' => 'settings.channels',
        'name' => 'admin::app.layouts.channels',
        'route' => 'admin.channels.index',
        'sort' => 5,
        'icon-class' => '',
      ),
      31 => 
      array (
        'key' => 'settings.users',
        'name' => 'admin::app.layouts.users',
        'route' => 'admin.users.index',
        'sort' => 6,
        'icon-class' => '',
      ),
      32 => 
      array (
        'key' => 'settings.users.users',
        'name' => 'admin::app.layouts.users',
        'route' => 'admin.users.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      33 => 
      array (
        'key' => 'settings.users.roles',
        'name' => 'admin::app.layouts.roles',
        'route' => 'admin.roles.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      34 => 
      array (
        'key' => 'settings.users.vendors-requests',
        'name' => 'Vendors Requests',
        'route' => 'admin.vendors.index',
        'sort' => 3,
        'icon-class' => '',
      ),
      35 => 
      array (
        'key' => 'settings.sliders',
        'name' => 'admin::app.layouts.sliders',
        'route' => 'admin.sliders.index',
        'sort' => 7,
        'icon-class' => '',
      ),
      36 => 
      array (
        'key' => 'settings.taxes',
        'name' => 'admin::app.layouts.taxes',
        'route' => 'admin.tax-categories.index',
        'sort' => 8,
        'icon-class' => '',
      ),
      37 => 
      array (
        'key' => 'settings.taxes.tax-categories',
        'name' => 'admin::app.layouts.tax-categories',
        'route' => 'admin.tax-categories.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      38 => 
      array (
        'key' => 'settings.taxes.tax-rates',
        'name' => 'admin::app.layouts.tax-rates',
        'route' => 'admin.tax-rates.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      39 => 
      array (
        'key' => 'marketing',
        'name' => 'admin::app.layouts.marketing',
        'route' => 'admin.catalog-rules.index',
        'sort' => 5,
        'icon-class' => 'promotion-icon',
      ),
      40 => 
      array (
        'key' => 'marketing.promotions',
        'name' => 'admin::app.layouts.promotions',
        'route' => 'admin.catalog-rules.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      41 => 
      array (
        'key' => 'marketing.promotions.catalog-rules',
        'name' => 'admin::app.promotions.catalog-rules.title',
        'route' => 'admin.catalog-rules.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      42 => 
      array (
        'key' => 'marketing.promotions.cart-rules',
        'name' => 'admin::app.promotions.cart-rules.title',
        'route' => 'admin.cart-rules.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      43 => 
      array (
        'key' => 'marketing.email-marketing',
        'name' => 'admin::app.layouts.email-marketing',
        'route' => 'admin.email-templates.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      44 => 
      array (
        'key' => 'marketing.email-marketing.email-templates',
        'name' => 'admin::app.layouts.email-templates',
        'route' => 'admin.email-templates.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      45 => 
      array (
        'key' => 'marketing.email-marketing.events',
        'name' => 'admin::app.layouts.events',
        'route' => 'admin.events.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      46 => 
      array (
        'key' => 'marketing.email-marketing.campaigns',
        'name' => 'admin::app.layouts.campaigns',
        'route' => 'admin.campaigns.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      47 => 
      array (
        'key' => 'marketing.email-marketing.subscribers',
        'name' => 'admin::app.layouts.newsletter-subscriptions',
        'route' => 'admin.customers.subscribers.index',
        'sort' => 3,
        'icon-class' => '',
      ),
      48 => 
      array (
        'key' => 'cms',
        'name' => 'admin::app.layouts.cms',
        'route' => 'admin.cms.index',
        'sort' => 5,
        'icon-class' => 'cms-icon',
      ),
      49 => 
      array (
        'key' => 'cms.pages',
        'name' => 'admin::app.cms.pages.pages',
        'route' => 'admin.cms.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      50 => 
      array (
        'key' => 'sales.rma',
        'name' => 'rma::app.admin.layouts.rma',
        'route' => 'admin.rma.index',
        'sort' => 6,
      ),
      51 => 
      array (
        'key' => 'sales.rma.index',
        'name' => 'rma::app.admin.rma-tab.heading',
        'route' => 'admin.rma.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      52 => 
      array (
        'key' => 'sales.rma.reason',
        'name' => 'rma::app.admin.tabs.reasons',
        'route' => 'admin.rma.reason.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      53 => 
      array (
        'key' => 'catalog.bulkupload',
        'name' => 'bulkupload::app.admin.bulk-upload.manage-bulk-upload',
        'route' => 'admin.dataflow-profile.index',
        'sort' => 5,
        'icon-class' => '',
      ),
      54 => 
      array (
        'key' => 'catalog.bulkupload.data-flow-profile',
        'name' => 'bulkupload::app.admin.bulk-upload.data-flow-profile.index',
        'route' => 'admin.dataflow-profile.index',
        'sort' => 1,
        'icon-class' => '',
      ),
      55 => 
      array (
        'key' => 'catalog.bulkupload.upload-files',
        'name' => 'bulkupload::app.admin.bulk-upload.upload-files.index',
        'route' => 'admin.bulk-upload.index',
        'sort' => 2,
        'icon-class' => '',
      ),
      56 => 
      array (
        'key' => 'catalog.bulkupload.run-profile',
        'name' => 'bulkupload::app.admin.bulk-upload.run-profile.index',
        'route' => 'admin.run-profile.index',
        'sort' => 3,
        'icon-class' => '',
      ),
    ),
    'customer' => 
    array (
      0 => 
      array (
        'key' => 'account',
        'name' => 'shop::app.layouts.my-account',
        'route' => 'customer.profile.index',
        'sort' => 1,
      ),
      1 => 
      array (
        'key' => 'account.profile',
        'name' => 'shop::app.layouts.profile',
        'route' => 'customer.profile.index',
        'sort' => 1,
      ),
      2 => 
      array (
        'key' => 'account.address',
        'name' => 'shop::app.layouts.address',
        'route' => 'customer.address.index',
        'sort' => 2,
      ),
      3 => 
      array (
        'key' => 'account.reviews',
        'name' => 'shop::app.layouts.reviews',
        'route' => 'customer.reviews.index',
        'sort' => 3,
      ),
      4 => 
      array (
        'key' => 'account.wishlist',
        'name' => 'shop::app.layouts.wishlist',
        'route' => 'customer.wishlist.index',
        'sort' => 4,
      ),
      5 => 
      array (
        'key' => 'account.compare',
        'name' => 'shop::app.customer.compare.text',
        'route' => 'velocity.customer.product.compare',
        'sort' => 5,
      ),
      6 => 
      array (
        'key' => 'account.orders',
        'name' => 'shop::app.layouts.orders',
        'route' => 'customer.orders.index',
        'sort' => 6,
      ),
      7 => 
      array (
        'key' => 'account.downloadables',
        'name' => 'shop::app.layouts.downloadable-products',
        'route' => 'customer.downloadable_products.index',
        'sort' => 7,
      ),
      8 => 
      array (
        'key' => 'account.rma',
        'name' => 'rma::app.shop.customer.menu-name',
        'route' => 'rma.customers.allrma',
        'sort' => 8,
      ),
    ),
  ),
  'paymentmethods' => 
  array (
    'paypal_smart_button' => 
    array (
      'code' => 'paypal_smart_button',
      'title' => 'PayPal Smart Button',
      'description' => 'PayPal',
      'client_id' => 'sb',
      'class' => 'Webkul\\Paypal\\Payment\\SmartButton',
      'sandbox' => true,
      'active' => true,
      'sort' => 0,
    ),
    'paypal_standard' => 
    array (
      'code' => 'paypal_standard',
      'title' => 'PayPal Standard',
      'description' => 'PayPal Standard',
      'class' => 'Webkul\\Paypal\\Payment\\Standard',
      'sandbox' => true,
      'active' => true,
      'business_account' => 'test@webkul.com',
      'sort' => 3,
    ),
    'cashondelivery' => 
    array (
      'code' => 'cashondelivery',
      'title' => 'Cash On Delivery',
      'description' => 'Cash On Delivery',
      'class' => 'Webkul\\Payment\\Payment\\CashOnDelivery',
      'active' => true,
      'sort' => 1,
    ),
    'moneytransfer' => 
    array (
      'code' => 'moneytransfer',
      'title' => 'Money Transfer',
      'description' => 'Money Transfer',
      'class' => 'Webkul\\Payment\\Payment\\MoneyTransfer',
      'active' => true,
      'sort' => 2,
    ),
    'razorpay' => 
    array (
      'code' => 'razorpay',
      'title' => 'Razorpay',
      'description' => 'Razorpay',
      'class' => 'Wontonee\\Razorpay\\Payment\\Razorpay',
      'active' => true,
      'sort' => 5,
    ),
    'paytm' => 
    array (
      'code' => 'paytm',
      'title' => 'Paytm',
      'description' => 'Paytm',
      'class' => 'Wontonee\\Paytm\\Payment\\Paytm',
      'active' => true,
      'sort' => 4,
    ),
  ),
  'pricerules' => 
  array (
  ),
  'product-types' => 
  array (
  ),
  'products' => 
  array (
    'skipAttributesOnCopy' => 
    array (
    ),
    'linkProductsOnCopy' => false,
    'isSaleable' => NULL,
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'repository' => 
  array (
    'pagination' => 
    array (
      'limit' => 15,
    ),
    'fractal' => 
    array (
      'params' => 
      array (
        'include' => 'include',
      ),
      'serializer' => 'League\\Fractal\\Serializer\\DataArraySerializer',
    ),
    'cache' => 
    array (
      'enabled' => false,
      'minutes' => 30,
      'repository' => 'cache',
      'clean' => 
      array (
        'enabled' => true,
        'on' => 
        array (
          'create' => true,
          'update' => true,
          'delete' => true,
        ),
      ),
      'params' => 
      array (
        'skipCache' => 'skipCache',
      ),
      'allowed' => 
      array (
        'only' => NULL,
        'except' => NULL,
      ),
    ),
    'criteria' => 
    array (
      'acceptedConditions' => 
      array (
        0 => '=',
        1 => 'like',
        2 => 'in',
      ),
      'params' => 
      array (
        'search' => 'search',
        'searchFields' => 'searchFields',
        'filter' => 'filter',
        'orderBy' => 'orderBy',
        'sortedBy' => 'sortedBy',
        'with' => 'with',
        'searchJoin' => 'searchJoin',
        'withCount' => 'withCount',
      ),
    ),
    'generator' => 
    array (
      'basePath' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\app',
      'rootNamespace' => 'App\\',
      'stubsOverridePath' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\app',
      'paths' => 
      array (
        'models' => 'Entities',
        'repositories' => 'Repositories',
        'interfaces' => 'Repositories',
        'transformers' => 'Transformers',
        'presenters' => 'Presenters',
        'validators' => 'Validators',
        'controllers' => 'Http/Controllers',
        'provider' => 'RepositoryServiceProvider',
        'criteria' => 'Criteria',
      ),
    ),
  ),
  'sanctum' => 
  array (
    'stateful' => 
    array (
      0 => 'localhost',
      1 => 'localhost:3000',
      2 => '127.0.0.1',
      3 => '127.0.0.1:8000',
      4 => '::1',
      5 => 'localhost',
    ),
    'guard' => 
    array (
      0 => 'customer',
    ),
    'expiration' => NULL,
    'middleware' => 
    array (
      'verify_csrf_token' => 'App\\Http\\Middleware\\VerifyCsrfToken',
      'encrypt_cookies' => 'App\\Http\\Middleware\\EncryptCookies',
    ),
  ),
  'scout' => 
  array (
    'driver' => NULL,
    'prefix' => '',
    'queue' => false,
    'after_commit' => false,
    'chunk' => 
    array (
      'searchable' => 500,
      'unsearchable' => 500,
    ),
    'soft_delete' => false,
    'identify' => false,
    'algolia' => 
    array (
      'id' => '',
      'secret' => '',
    ),
    'meilisearch' => 
    array (
      'host' => 'http://localhost:7700',
      'key' => NULL,
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'exchange-api' => 
    array (
      'default' => 'exchange_rates',
      'fixer' => 
      array (
        'key' => '',
        'class' => 'Webkul\\Core\\Helpers\\Exchange\\FixerExchange',
      ),
      'exchange_rates' => 
      array (
        'key' => '',
        'class' => 'Webkul\\Core\\Helpers\\Exchange\\ExchangeRates',
      ),
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
    'facebook' => 
    array (
      'client_id' => '',
      'client_secret' => '',
      'redirect' => 'https://yourhost.com/customer/social-login/facebook/callback',
    ),
    'twitter' => 
    array (
      'client_id' => '',
      'client_secret' => '',
      'redirect' => 'https://yourhost.com/customer/social-login/twitter/callback',
    ),
    'google' => 
    array (
      'client_id' => '906960171751-457onoth2mj1s2v2md0ja89cdn100fks.apps.googleusercontent.com',
      'client_secret' => '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',
      'redirect' => 'http://localhost:8000/customer/social-login/google/callback',
    ),
    'linkedin' => 
    array (
      'client_id' => '',
      'client_secret' => '',
      'redirect' => 'https://yourhost.com/customer/social-login/linkedin/callback',
    ),
    'github' => 
    array (
      'client_id' => '',
      'client_secret' => '',
      'redirect' => 'https://yourhost.com/customer/social-login/github/callback',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => true,
    'encrypt' => false,
    'files' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\framework/sessions',
    'connection' => 'session',
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'worldekart_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'themes' => 
  array (
    'default' => 'default',
    'themes' => 
    array (
      'default' => 
      array (
        'views_path' => 'resources/themes/default/views',
        'assets_path' => 'public/themes/default/assets',
        'name' => 'Default',
      ),
      'martfury' => 
      array (
        'views_path' => 'resources/themes/martfury/views',
        'assets_path' => 'public/themes/martfury/assets',
        'name' => 'Martfury',
        'parent' => 'default',
      ),
      'ekart' => 
      array (
        'views_path' => 'resources/themes/ekart/views',
        'assets_path' => 'public/themes/ekart/assets',
        'name' => 'Ekart',
        'parent' => 'Velocity',
      ),
      'velocity' => 
      array (
        'views_path' => 'resources/themes/velocity/views',
        'assets_path' => 'public/themes/velocity/assets',
        'name' => 'Velocity',
        'parent' => 'default',
      ),
    ),
    'admin-default' => 'default',
    'admin-themes' => 
    array (
      'default' => 
      array (
        'views_path' => 'resources/admin-themes/default/views',
        'assets_path' => 'public/admin-themes/default/assets',
        'name' => 'Default',
      ),
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
  'translatable' => 
  array (
    'locales' => 
    array (
      0 => 'en',
      1 => 'fr',
      'es' => 
      array (
        0 => 'MX',
        1 => 'CO',
      ),
    ),
    'locale_separator' => '-',
    'locale' => NULL,
    'use_fallback' => false,
    'use_property_fallback' => true,
    'fallback_locale' => 'en',
    'translation_model_namespace' => NULL,
    'translation_suffix' => 'Translation',
    'locale_key' => 'locale',
    'to_array_always_loads_translations' => true,
    'rule_factory' => 
    array (
      'format' => 1,
      'prefix' => '%',
      'suffix' => '%',
    ),
  ),
  'view' => 
  array (
    'tracer' => false,
    'paths' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\resources\\views',
    ),
    'compiled' => 'C:\\xampp\\htdocs\\Self+Manu\\World-Ekart\\storage\\framework\\views',
  ),
  'product_types' => 
  array (
    'booking' => 
    array (
      'key' => 'booking',
      'name' => 'Booking',
      'class' => 'Webkul\\BookingProduct\\Type\\Booking',
      'sort' => 7,
    ),
    'simple' => 
    array (
      'key' => 'simple',
      'name' => 'Simple',
      'class' => 'Webkul\\Product\\Type\\Simple',
      'sort' => 1,
    ),
    'configurable' => 
    array (
      'key' => 'configurable',
      'name' => 'Configurable',
      'class' => 'Webkul\\Product\\Type\\Configurable',
      'sort' => 2,
    ),
    'virtual' => 
    array (
      'key' => 'virtual',
      'name' => 'Virtual',
      'class' => 'Webkul\\Product\\Type\\Virtual',
      'sort' => 3,
    ),
    'grouped' => 
    array (
      'key' => 'grouped',
      'name' => 'Grouped',
      'class' => 'Webkul\\Product\\Type\\Grouped',
      'sort' => 4,
    ),
    'downloadable' => 
    array (
      'key' => 'downloadable',
      'name' => 'Downloadable',
      'class' => 'Webkul\\Product\\Type\\Downloadable',
      'sort' => 5,
    ),
    'bundle' => 
    array (
      'key' => 'bundle',
      'name' => 'Bundle',
      'class' => 'Webkul\\Product\\Type\\Bundle',
      'sort' => 6,
    ),
  ),
);
