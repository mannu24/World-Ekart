^ array:2 [
  4 => array:34 [
    "cart_id" => 21
    "customer_id" => 2
    "is_guest" => 0
    "customer_email" => "mannukumarshah595@gmail.com"
    "customer_first_name" => "Mannu kumar"
    "customer_last_name" => "Shah"
    "customer" => Webkul\Customer\Models\Customer {#1891
      #connection: "mysql"
      #table: "customers"
      #primaryKey: "id"
      #keyType: "int"
      +incrementing: true
      #with: []
      #withCount: []
      +preventsLazyLoading: false
      #perPage: 15
      +exists: true
      +wasRecentlyCreated: false
      #escapeWhenCastingToString: false
      #attributes: array:20 [
        "id" => 2
        "first_name" => "Mannu kumar"
        "last_name" => "Shah"
        "gender" => null
        "date_of_birth" => null
        "email" => "mannukumarshah595@gmail.com"
        "image" => null
        "status" => 1
        "password" => null
        "api_token" => null
        "customer_group_id" => 2
        "subscribed_to_news_letter" => 0
        "remember_token" => "eyTqIj6Rc5uAGwQFl2EtzLgw0I6Z5kcI4dvrIopgHa6XHIEob9AmcrdPM6H1"
        "created_at" => "2022-08-14 16:09:30"
        "updated_at" => "2022-08-14 16:09:30"
        "is_verified" => 1
        "is_suspended" => 0
        "token" => null
        "notes" => null
        "phone" => null
      ]
      #original: array:20 [
        "id" => 2
        "first_name" => "Mannu kumar"
        "last_name" => "Shah"
        "gender" => null
        "date_of_birth" => null
        "email" => "mannukumarshah595@gmail.com"
        "image" => null
        "status" => 1
        "password" => null
        "api_token" => null
        "customer_group_id" => 2
        "subscribed_to_news_letter" => 0
        "remember_token" => "eyTqIj6Rc5uAGwQFl2EtzLgw0I6Z5kcI4dvrIopgHa6XHIEob9AmcrdPM6H1"
        "created_at" => "2022-08-14 16:09:30"
        "updated_at" => "2022-08-14 16:09:30"
        "is_verified" => 1
        "is_suspended" => 0
        "token" => null
        "notes" => null
        "phone" => null
      ]
      #changes: []
      #casts: []
      #classCastCache: []
      #attributeCastCache: []
      #dates: []
      #dateFormat: null
      #appends: []
      #dispatchesEvents: []
      #observables: []
      #relations: []
      #touches: []
      +timestamps: true
      #hidden: array:3 [
        0 => "password"
        1 => "api_token"
        2 => "remember_token"
      ]
      #visible: []
      #fillable: array:15 [
        0 => "first_name"
        1 => "last_name"
        2 => "gender"
        3 => "date_of_birth"
        4 => "email"
        5 => "phone"
        6 => "password"
        7 => "api_token"
        8 => "token"
        9 => "customer_group_id"
        10 => "subscribed_to_news_letter"
        11 => "status"
        12 => "is_verified"
        13 => "is_suspended"
        14 => "notes"
      ]
      #guarded: array:1 [
        0 => "*"
      ]
      #rememberTokenName: "remember_token"
      #accessToken: null
    }
    "total_item_count" => 1
    "total_qty_ordered" => 1
    "base_currency_code" => "USD"
    "channel_currency_code" => "INR"
    "order_currency_code" => "INR"
    "grand_total" => 220.0
    "base_grand_total" => 220.0
    "sub_total" => 200.0
    "base_sub_total" => 200.0
    "tax_amount" => "0.0000"
    "base_tax_amount" => "0.0000"
    "coupon_code" => null
    "applied_cart_rule_ids" => ""
    "discount_amount" => "0.0000"
    "base_discount_amount" => "0.0000"
    "billing_address" => array:20 [
      "address_type" => "cart_billing"
      "customer_id" => 2
      "order_id" => null
      "first_name" => "Mannu"
      "last_name" => "kumar"
      "gender" => null
      "company_name" => "mAnuj"
      "address1" => "28 A/C Gandhi Nagar"
      "address2" => null
      "postcode" => "180004"
      "city" => "Jammu"
      "state" => "JK"
      "country" => "IN"
      "email" => "mannukumarshah595@gmail.com"
      "phone" => "09682150294"
      "vat_id" => null
      "default_address" => false
      "additional" => null
      "created_at" => "2022-09-17T04:10:59.000000Z"
      "updated_at" => "2022-09-17T04:10:59.000000Z"
    ]
    "payment" => array:4 [
      "method" => "cashondelivery"
      "method_title" => null
      "created_at" => "2022-09-17T12:42:42.000000Z"
      "updated_at" => "2022-09-17T12:42:42.000000Z"
    ]
    "channel" => Webkul\Core\Models\Channel {#1644
      #connection: "mysql"
      #table: "channels"
      #primaryKey: "id"
      #keyType: "int"
      +incrementing: true
      #with: []
      #withCount: []
      +preventsLazyLoading: false
      #perPage: 15
      +exists: true
      +wasRecentlyCreated: false
      #escapeWhenCastingToString: false
      #attributes: array:14 [
        "id" => 1
        "code" => "default"
        "timezone" => null
        "theme" => "ekart"
        "hostname" => "http://localhost"
        "logo" => "channel/1/qm1ktxmujTHaakC4JjHrfdSeFh9O7IEm1ZLQERzI.webp"
        "favicon" => "channel/1/ZUcAA4dbj4TLCzJP6b3KGDvqkpncrSqB17G0u6CE.webp"
        "is_maintenance_on" => 0
        "allowed_ips" => ""
        "default_locale_id" => 1
        "base_currency_id" => 3
        "created_at" => null
        "updated_at" => "2022-09-05 23:37:31"
        "root_category_id" => 1
      ]
      #original: array:14 [
        "id" => 1
        "code" => "default"
        "timezone" => null
        "theme" => "ekart"
        "hostname" => "http://localhost"
        "logo" => "channel/1/qm1ktxmujTHaakC4JjHrfdSeFh9O7IEm1ZLQERzI.webp"
        "favicon" => "channel/1/ZUcAA4dbj4TLCzJP6b3KGDvqkpncrSqB17G0u6CE.webp"
        "is_maintenance_on" => 0
        "allowed_ips" => ""
        "default_locale_id" => 1
        "base_currency_id" => 3
        "created_at" => null
        "updated_at" => "2022-09-05 23:37:31"
        "root_category_id" => 1
      ]
      #changes: []
      #casts: []
      #classCastCache: []
      #attributeCastCache: []
      #dates: []
      #dateFormat: null
      #appends: []
      #dispatchesEvents: []
      #observables: []
      #relations: array:1 [
        "base_currency" => Webkul\Core\Models\Currency {#1906
          #connection: "mysql"
          #table: "currencies"
          #primaryKey: "id"
          #keyType: "int"
          +incrementing: true
          #with: []
          #withCount: []
          +preventsLazyLoading: false
          #perPage: 15
          +exists: true
          +wasRecentlyCreated: false
          #escapeWhenCastingToString: false
          #attributes: array:6 [
            "id" => 3
            "code" => "INR"
            "name" => "Indian Rupees"
            "created_at" => "2022-08-10 13:50:26"
            "updated_at" => "2022-08-10 13:50:26"
            "symbol" => "₹"
          ]
          #original: array:6 [
            "id" => 3
            "code" => "INR"
            "name" => "Indian Rupees"
            "created_at" => "2022-08-10 13:50:26"
            "updated_at" => "2022-08-10 13:50:26"
            "symbol" => "₹"
          ]
          #changes: []
          #casts: []
          #classCastCache: []
          #attributeCastCache: []
          #dates: []
          #dateFormat: null
          #appends: []
          #dispatchesEvents: []
          #observables: []
          #relations: []
          #touches: []
          +timestamps: true
          #hidden: []
          #visible: []
          #fillable: array:3 [
            0 => "code"
            1 => "name"
            2 => "symbol"
          ]
          #guarded: array:1 [
            0 => "*"
          ]
        }
      ]
      #touches: []
      +timestamps: true
      #hidden: []
      #visible: []
      #fillable: array:15 [
        0 => "code"
        1 => "name"
        2 => "description"
        3 => "theme"
        4 => "home_page_content"
        5 => "footer_content"
        6 => "site_name"
        7 => "hostname"
        8 => "default_locale_id"
        9 => "base_currency_id"
        10 => "root_category_id"
        11 => "home_seo"
        12 => "is_maintenance_on"
        13 => "maintenance_mode_text"
        14 => "allowed_ips"
      ]
      #guarded: array:1 [
        0 => "*"
      ]
      #defaultLocale: null
      +translatedAttributes: array:6 [
        0 => "name"
        1 => "description"
        2 => "home_page_content"
        3 => "footer_content"
        4 => "maintenance_mode_text"
        5 => "home_seo"
      ]
    }
    "shipping_method" => "flatrate_flatrate"
    "shipping_title" => "Flat Rate - Flat Rate"
    "shipping_description" => "Flat Rate Shipping"
    "shipping_amount" => 20.0
    "base_shipping_amount" => 20.0
    "shipping_address" => array:20 [
      "address_type" => "cart_shipping"
      "customer_id" => 2
      "order_id" => null
      "first_name" => "Mannu"
      "last_name" => "kumar"
      "gender" => null
      "company_name" => "mAnuj"
      "address1" => "28 A/C Gandhi Nagar"
      "address2" => null
      "postcode" => "180004"
      "city" => "Jammu"
      "state" => "JK"
      "country" => "IN"
      "email" => "mannukumarshah595@gmail.com"
      "phone" => "09682150294"
      "vat_id" => null
      "default_address" => false
      "additional" => null
      "created_at" => "2022-09-17T04:10:59.000000Z"
      "updated_at" => "2022-09-17T04:10:59.000000Z"
    ]
    "shipping_discount_amount" => "0.0000"
    "base_shipping_discount_amount" => "0.0000"
    "items" => array:1 [
      0 => array:18 [
        "product" => Webkul\Product\Models\Product {#4191
          #connection: "mysql"
          #table: "products"
          #primaryKey: "id"
          #keyType: "int"
          +incrementing: true
          #with: []
          #withCount: []
          +preventsLazyLoading: false
          #perPage: 15
          +exists: true
          +wasRecentlyCreated: false
          #escapeWhenCastingToString: false
          #attributes: array:10 [
            "id" => 2
            "user_id" => 4
            "sku" => "temp21"
            "type" => "simple"
            "created_at" => "2022-08-10 12:46:07"
            "updated_at" => "2022-08-22 00:31:52"
            "parent_id" => null
            "attribute_family_id" => 1
            "country" => "IN"
            "additional" => null
          ]
          #original: array:10 [
            "id" => 2
            "user_id" => 4
            "sku" => "temp21"
            "type" => "simple"
            "created_at" => "2022-08-10 12:46:07"
            "updated_at" => "2022-08-22 00:31:52"
            "parent_id" => null
            "attribute_family_id" => 1
            "country" => "IN"
            "additional" => null
          ]
          #changes: []
          #casts: array:1 [
            "additional" => "array"
          ]
          #classCastCache: []
          #attributeCastCache: []
          #dates: []
          #dateFormat: null
          #appends: []
          #dispatchesEvents: []
          #observables: []
          #relations: []
          #touches: []
          +timestamps: true
          #hidden: []
          #visible: []
          #fillable: array:6 [
            0 => "type"
            1 => "attribute_family_id"
            2 => "sku"
            3 => "parent_id"
            4 => "user_id"
            5 => "country"
          ]
          #guarded: array:1 [
            0 => "*"
          ]
          #typeInstance: null
        }
        "sku" => "temp21"
        "type" => "simple"
        "name" => "temp1sdvc"
        "weight" => "12.0000"
        "total_weight" => "12.0000"
        "qty_ordered" => 1
        "price" => "200.0000"
        "base_price" => "200.0000"
        "total" => "200.0000"
        "base_total" => "200.0000"
        "tax_percent" => "0.0000"
        "tax_amount" => "0.0000"
        "base_tax_amount" => "0.0000"
        "discount_percent" => "0.0000"
        "discount_amount" => "0.0000"
        "base_discount_amount" => "0.0000"
        "additional" => array:4 [
          "quantity" => 1
          "product_id" => "2"
          "_token" => "2NxFTAbqnrweev5d7VBlu7XUYanL8TusMUakB37X"
          "locale" => "en"
        ]
      ]
    ]
  ]
  3 => array:34 [
    "cart_id" => 21
    "customer_id" => 2
    "is_guest" => 0
    "customer_email" => "mannukumarshah595@gmail.com"
    "customer_first_name" => "Mannu kumar"
    "customer_last_name" => "Shah"
    "customer" => Webkul\Customer\Models\Customer {#1891}
    "total_item_count" => 1
    "total_qty_ordered" => 1
    "base_currency_code" => "USD"
    "channel_currency_code" => "INR"
    "order_currency_code" => "INR"
    "grand_total" => 100.0
    "base_grand_total" => 100.0
    "sub_total" => 80.0
    "base_sub_total" => 80.0
    "tax_amount" => "0.0000"
    "base_tax_amount" => "0.0000"
    "coupon_code" => null
    "applied_cart_rule_ids" => ""
    "discount_amount" => "0.0000"
    "base_discount_amount" => "0.0000"
    "billing_address" => array:20 [
      "address_type" => "cart_billing"
      "customer_id" => 2
      "order_id" => null
      "first_name" => "Mannu"
      "last_name" => "kumar"
      "gender" => null
      "company_name" => "mAnuj"
      "address1" => "28 A/C Gandhi Nagar"
      "address2" => null
      "postcode" => "180004"
      "city" => "Jammu"
      "state" => "JK"
      "country" => "IN"
      "email" => "mannukumarshah595@gmail.com"
      "phone" => "09682150294"
      "vat_id" => null
      "default_address" => false
      "additional" => null
      "created_at" => "2022-09-17T04:10:59.000000Z"
      "updated_at" => "2022-09-17T04:10:59.000000Z"
    ]
    "payment" => array:4 [
      "method" => "cashondelivery"
      "method_title" => null
      "created_at" => "2022-09-17T12:42:42.000000Z"
      "updated_at" => "2022-09-17T12:42:42.000000Z"
    ]
    "channel" => Webkul\Core\Models\Channel {#1644}
    "shipping_method" => "flatrate_flatrate"
    "shipping_title" => "Flat Rate - Flat Rate"
    "shipping_description" => "Flat Rate Shipping"
    "shipping_amount" => 20.0
    "base_shipping_amount" => 20.0
    "shipping_address" => array:20 [
      "address_type" => "cart_shipping"
      "customer_id" => 2
      "order_id" => null
      "first_name" => "Mannu"
      "last_name" => "kumar"
      "gender" => null
      "company_name" => "mAnuj"
      "address1" => "28 A/C Gandhi Nagar"
      "address2" => null
      "postcode" => "180004"
      "city" => "Jammu"
      "state" => "JK"
      "country" => "IN"
      "email" => "mannukumarshah595@gmail.com"
      "phone" => "09682150294"
      "vat_id" => null
      "default_address" => false
      "additional" => null
      "created_at" => "2022-09-17T04:10:59.000000Z"
      "updated_at" => "2022-09-17T04:10:59.000000Z"
    ]
    "shipping_discount_amount" => "0.0000"
    "base_shipping_discount_amount" => "0.0000"
    "items" => array:1 [
      0 => array:18 [
        "product" => Webkul\Product\Models\Product {#4229
          #connection: "mysql"
          #table: "products"
          #primaryKey: "id"
          #keyType: "int"
          +incrementing: true
          #with: []
          #withCount: []
          +preventsLazyLoading: false
          #perPage: 15
          +exists: true
          +wasRecentlyCreated: false
          #escapeWhenCastingToString: false
          #attributes: array:10 [
            "id" => 4
            "user_id" => 3
            "sku" => "temporary-sku-6a87ba"
            "type" => "simple"
            "created_at" => "2022-08-12 08:38:32"
            "updated_at" => "2022-08-12 10:53:29"
            "parent_id" => null
            "attribute_family_id" => 1
            "country" => "IN"
            "additional" => null
          ]
          #original: array:10 [
            "id" => 4
            "user_id" => 3
            "sku" => "temporary-sku-6a87ba"
            "type" => "simple"
            "created_at" => "2022-08-12 08:38:32"
            "updated_at" => "2022-08-12 10:53:29"
            "parent_id" => null
            "attribute_family_id" => 1
            "country" => "IN"
            "additional" => null
          ]
          #changes: []
          #casts: array:1 [
            "additional" => "array"
          ]
          #classCastCache: []
          #attributeCastCache: []
          #dates: []
          #dateFormat: null
          #appends: []
          #dispatchesEvents: []
          #observables: []
          #relations: []
          #touches: []
          +timestamps: true
          #hidden: []
          #visible: []
          #fillable: array:6 [
            0 => "type"
            1 => "attribute_family_id"
            2 => "sku"
            3 => "parent_id"
            4 => "user_id"
            5 => "country"
          ]
          #guarded: array:1 [
            0 => "*"
          ]
          #typeInstance: null
        }
        "sku" => "temporary-sku-6a87ba"
        "type" => "simple"
        "name" => "Prodcut With Price"
        "weight" => "12.0000"
        "total_weight" => "12.0000"
        "qty_ordered" => 1
        "price" => "80.0000"
        "base_price" => "80.0000"
        "total" => "80.0000"
        "base_total" => "80.0000"
        "tax_percent" => "0.0000"
        "tax_amount" => "0.0000"
        "base_tax_amount" => "0.0000"
        "discount_percent" => "0.0000"
        "discount_amount" => "0.0000"
        "base_discount_amount" => "0.0000"
        "additional" => array:4 [
          "quantity" => 1
          "product_id" => "4"
          "_token" => "2NxFTAbqnrweev5d7VBlu7XUYanL8TusMUakB37X"
          "locale" => "en"
        ]
      ]
    ]
  ]
]