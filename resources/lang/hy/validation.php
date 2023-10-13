<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Այն :attribute պետք է ընդունել.',
    'active_url' => 'Այն :attribute վավեր URL չէ.',
    'after' => 'Այն :attribute պետք է լինի ամսաթիվ հետո :date.',
    'after_or_equal' => 'Այն :attribute պետք է լինի հաջորդ կամ հավասար ամսաթիվ :date.',
    'alpha' => 'Այն :attribute կարող է պարունակել միայն տառեր.',
    'alpha_dash' => 'Այն :attribute կարող է պարունակել միայն տառեր, թվեր, գծիկներ և ընդգծումներ.',
    'alpha_num' => 'Այն :attribute կարող է պարունակել միայն տառեր և թվեր.',
    'array' => 'Այն :attribute պետք է լինի զանգված.',
    'before' => 'Այն :attribute պետք է նախօրոք ժամադրություն լինի :date.',
    'before_or_equal' => 'Այն :attribute պետք է լինի նախորդ կամ հավասար ամսաթիվ :date.',
    'between' => [
        'numeric' => 'Այն :attribute միջեւ պետք է լինի :min և :max.',
        'file' => 'Այն :attribute միջեւ պետք է լինի :min և :max կիլոբայթ.',
        'string' => 'Այն :attribute միջեւ պետք է լինի :min և :max կերպարներ.',
        'array' => 'Այն :attribute միջեւ պետք է լինի :min և :max իրեր.',
    ],
    'boolean' => 'Այն :attribute դաշտը պետք է լինի ճշմարիտ կամ կեղծ.',
    'confirmed' => 'Այն :attribute հաստատումը չի համընկնում.',
    'date' => 'Այն :attribute վավեր ամսաթիվ չէ.',
    'date_equals' => 'Այն :attribute պետք է լինի ամսաթիվը հավասար է :date.',
    'date_format' => 'Այն :attribute չի համապատասխանում ձևաչափին :format.',
    'different' => 'Այն :attribute և :other պետք է տարբեր լինի.',
    'digits' => 'Այն :attribute պետք է լինի :digits digits.',
    'digits_between' => 'Այն :attribute միջեւ պետք է լինի :min և :max digits.',
    'dimensions' => 'Այն :attribute ունի պատկերի անվավեր չափեր.',
    'distinct' => 'Այն :attribute դաշտն ունի կրկնօրինակ արժեք.',
    'email' => 'Այն :attribute պետք է լինի վավեր էլփոստի հասցե.',
    'ends_with' => 'Այն :attribute պետք է ավարտվի հետևյալով: :values.',
    'exists' => 'Այն ընտրված :attribute անվավեր է.',
    'file' => 'Այն :attribute պետք է լինի ֆայլ.',
    'filled' => 'Այն :attribute դաշտը պետք է արժեք ունենա.',
    'gt' => [
        'numeric' => 'Այն :attribute պետք է լինի ավելի մեծ, քան :value.',
        'file' => 'Այն :attribute պետք է լինի ավելի մեծ, քան :value կիլոբայթ.',
        'string' => 'Այն :attribute պետք է լինի ավելի մեծ, քան :value կերպարներ.',
        'array' => 'Այն :attribute պետք է ունենա ավելի քան :value իրեր.',
    ],
    'gte' => [
        'numeric' => 'Այն :attribute պետք է լինի ավելի մեծ, քան կամ հավասար :value.',
        'file' => 'Այն :attribute պետք է լինի ավելի մեծ, քան կամ հավասար :value կիլոբայթ.',
        'string' => 'Այն :attribute պետք է լինի ավելի մեծ, քան կամ հավասար :value կերպարներ.',
        'array' => 'Այն :attribute պետք է ունենալ :value իրեր կամ ավելին.',
    ],
    'image' => 'Այն :attribute պետք է լինի պատկեր.',
    'in' => 'Այն ընտրված :attribute անվավեր է.',
    'in_array' => 'Այն :attribute դաշտը գոյություն չունի :other.',
    'integer' => 'Այն :attribute պետք է լինի ամբողջ թիվ.',
    'ip' => 'Այն :attribute պետք է լինի վավեր IP հասցե.',
    'ipv4' => 'Այն :attribute պետք է լինի վավեր IPv4 հասցե.',
    'ipv6' => 'Այն :attribute պետք է լինի վավեր IPv6 հասցե.',
    'json' => 'Այն :attribute պետք է լինի վավեր JSON տող.',
    'lt' => [
        'numeric' => 'Այն :attribute պետք է լինի պակաս, քան :value.',
        'file' => 'Այն :attribute պետք է լինի պակաս, քան :value կիլոբայթ.',
        'string' => 'Այն :attribute պետք է լինի պակաս, քան :value կերպարներ.',
        'array' => 'Այն :attribute must have less than :value իրեր.',
    ],
    'lte' => [
        'numeric' => 'Այն :attribute պետք է լինի պակաս, քան կամ հավասար :value.',
        'file' => 'Այն :attribute պետք է լինի պակաս, քան կամ հավասար :value կիլոբայթ.',
        'string' => 'Այն :attribute պետք է լինի պակաս, քան կամ հավասար :value կերպարներ.',
        'array' => 'Այն :attribute չպետք է ունենա ավելի քան :value իրեր.',
    ],
    'max' => [
        'numeric' => 'Այն :attribute չի կարող ավելի մեծ լինել, քան :max.',
        'file' => 'Այն :attribute չի կարող ավելի մեծ լինել, քան :max կիլոբայթ.',
        'string' => 'Այն :attribute չի կարող ավելի մեծ լինել, քան :max կերպարներ.',
        'array' => 'Այն :attribute չի կարող ունենալ ավելի քան :max իրեր.',
    ],
    'mimes' => 'Այն :attribute պետք է լինի ֆայլ type: :values.',
    'mimetypes' => 'Այն :attribute պետք է լինի ֆայլ type: :values.',
    'min' => [
        'numeric' => 'Այն :attribute պետք է լինի առնվազն :min.',
        'file' => 'Այն :attribute պետք է լինի առնվազն :min կիլոբայթ.',
        'string' => 'Այն :attribute պետք է լինի առնվազն :min կերպարներ.',
        'array' => 'Այն :attribute պետք է ունենա առնվազն :min իրեր.',
    ],
    'not_in' => 'Այն ընտրված :attribute անվավեր է.',
    'not_regex' => 'Այն :attribute ձևաչափը անվավեր է.',
    'numeric' => 'Այն :attribute պետք է լինի թիվ.',
    'password' => 'Այն գաղտնաբառը սխալ է.',
    'present' => 'Այն :attribute դաշտը պետք է ներկա լինի.',
    'regex' => 'Այն :attribute ձևաչափը անվավեր է.',
    'required' => 'Այն :attribute դաշտը պարտադիր է.',
    'required_if' => 'Այն :attribute դաշտը պահանջվում է, երբ :oԱյնr է :value.',
    'required_unless' => 'Այն :attribute դաշտը պարտադիր է եթե :oԱյնr է in :values.',
    'required_with' => 'Այն :attribute դաշտը պահանջվում է, երբ :values է ներկա.',
    'required_with_all' => 'Այն :attribute դաշտը պահանջվում է, երբ :values ներկա են.',
    'required_without' => 'Այն :attribute դաշտը պահանջվում է, երբ :values է ոչ ներկա.',
    'required_without_all' => 'Այն :attribute դաշտը պահանջվում է, երբ ոչ մեկը :values ներկա են.',
    'same' => 'Այն :attribute և :other պետք է համապատասխանի.',
    'size' => [
        'numeric' => 'Այն :attribute պետք է լինի :size.',
        'file' => 'Այն :attribute պետք է լինի :size կիլոբայթ.',
        'string' => 'Այն :attribute պետք է լինի :size կերպարներ.',
        'array' => 'Այն :attribute պետք է պարունակի :size իրեր.',
    ],
    'starts_with' => 'Այն :attribute պետք է սկսվի հետևյալներից որևէ մեկով: :values.',
    'string' => 'Այն :attribute պետք է լինի լար.',
    'timezone' => 'Այն :attribute պետք է լինի վավեր գոտի.',
    'unique' => 'Այն :attribute արդեն վերցված է.',
    'uploaded' => 'Այն :attribute չհաջողվեց վերբեռնել.',
    'url' => 'Այն :attribute ձևաչափն անվավեր է.',
    'uuid' => 'Այն :attribute պետք է լինի վավեր UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
