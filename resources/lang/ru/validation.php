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

    'accepted' => 'The :attribute должен быть принят.',
    'active_url' => 'The :attribute недействительный URL-адрес.',
    'after' => 'The :attribute должна быть дата после :date.',
    'after_or_equal' => 'The :attribute должна быть датой после или равной :date.',
    'alpha' => 'The :attribute может содержать только буквы.',
    'alpha_dash' => 'The :attribute может содержать только буквы, цифры, дефисы и символы подчеркивания.',
    'alpha_num' => 'The :attribute может содержать только буквы и цифры.',
    'array' => 'The :attribute должен быть массив.',
    'before' => 'The :attribute должна быть дата до :date.',
    'before_or_equal' => 'The :attribute должна быть датой до или равной :date.',
    'between' => [
        'numeric' => 'The :attribute должно быть между :min и :max.',
        'file' => 'The :attribute должно быть между :min и :max килобайты.',
        'string' => 'The :attribute должно быть между :min и :max персонажи.',
        'array' => 'The :attribute должно быть между :min и :max предметы.',
    ],
    'boolean' => 'The :attribute поле должно быть истинным или ложным.',
    'confirmed' => 'The :attribute подтверждение не совпадает.',
    'date' => 'The :attribute не верная дата.',
    'date_equals' => 'The :attribute должна быть дата, равная :date.',
    'date_format' => 'The :attribute не соответствует формату :format.',
    'different' => 'The :attribute и :other должно быть другим.',
    'digits' => 'The :attribute должно быть :digits цифры.',
    'digits_between' => 'The :attribute должно быть между :min и :max цифры.',
    'dimensions' => 'The :attribute имеет недопустимые размеры изображения.',
    'distinct' => 'The :attribute поле имеет повторяющееся значение.',
    'email' => 'The :attribute Адрес эл. почты должен быть действительным.',
    'ends_with' => 'The :attribute должен заканчиваться одним из following: :values.',
    'exists' => 'The selected :attribute является недействительным.',
    'file' => 'The :attribute должен быть файл.',
    'filled' => 'The :attribute поле должно иметь значение.',
    'gt' => [
        'numeric' => 'The :attribute должно быть больше, чем :value.',
        'file' => 'The :attribute должно быть больше, чем :value килобайты.',
        'string' => 'The :attribute должно быть больше, чем :value персонажи.',
        'array' => 'The :attribute должно быть больше, чем :value предметы.',
    ],
    'gte' => [
        'numeric' => 'The :attribute должно быть больше или равно :value.',
        'file' => 'The :attribute должно быть больше или равно :value килобайты.',
        'string' => 'The :attribute должно быть больше или равно :value персонажи.',
        'array' => 'The :attribute должен иметь :value предметы или больше.',
    ],
    'image' => 'The :attribute должно быть изображение.',
    'in' => 'The selected :attribute является недействительным.',
    'in_array' => 'The :attribute поле не существует в :other.',
    'integer' => 'The :attribute должно быть целым числом.',
    'ip' => 'The :attribute должен быть действительным IP-адресом.',
    'ipv4' => 'The :attribute должен быть действительным адресом IPv4.',
    'ipv6' => 'The :attribute должен быть действительным адресом IPv6.',
    'json' => 'The :attribute должна быть допустимой строкой JSON.',
    'lt' => [
        'numeric' => 'The :attribute должно быть меньше, чем :value.',
        'file' => 'The :attribute должно быть меньше, чем :value килобайты.',
        'string' => 'The :attribute должно быть меньше, чем :value персонажи.',
        'array' => 'The :attribute должно быть меньше, чем :value предметы.',
    ],
    'lte' => [
        'numeric' => 'The :attribute должно быть меньше или равно :value.',
        'file' => 'The :attribute должно быть меньше или равно :value килобайты.',
        'string' => 'The :attribute должно быть меньше или равно :value персонажи.',
        'array' => 'The :attribute не должен иметь более :value предметы.',
    ],
    'max' => [
        'numeric' => 'The :attribute не может быть больше, чем :max.',
        'file' => 'The :attribute не может быть больше, чем :max килобайты.',
        'string' => 'The :attribute не может быть больше, чем :max персонажи.',
        'array' => 'The :attribute может иметь не более :max предметы.',
    ],
    'mimes' => 'The :attribute должен быть файл type: :values.',
    'mimetypes' => 'The :attribute должен быть файл type: :values.',
    'min' => [
        'numeric' => 'The :attribute должен быть не менее :min.',
        'file' => 'The :attribute должен быть не менее :min килобайты.',
        'string' => 'The :attribute должен быть не менее :min персонажи.',
        'array' => 'The :attribute должен иметь по крайней мере :min предметы.',
    ],
    'not_in' => 'The selected :attribute является недействительным.',
    'not_regex' => 'The :attribute формат недействителен.',
    'numeric' => 'The :attribute должен быть числом.',
    'password' => 'Неправильный пароль.',
    'present' => 'The :attribute поле должно присутствовать.',
    'regex' => 'The :attribute формат недействителен.',
    'required' => 'The :attribute Поле, обязательное для заполнения.',
    'required_if' => 'The :attribute поле обязательно, когда :other является :value.',
    'required_unless' => 'The :attribute поле обязательно, если только :other в :values.',
    'required_with' => 'The :attribute поле обязательно, когда :values настоящее.',
    'required_with_all' => 'The :attribute поле обязательно, когда :values присутствуют.',
    'required_without' => 'The :attribute поле обязательно, когда :values нет.',
    'required_without_all' => 'The :attribute поле является обязательным, если ни одно из :values присутствуют.',
    'same' => 'The :attribute и :other должен соответствовать.',
    'size' => [
        'numeric' => 'The :attribute должно быть :size.',
        'file' => 'The :attribute должно быть :size килобайты.',
        'string' => 'The :attribute должно быть :size персонажи.',
        'array' => 'The :attribute должен содержать :size предметы.',
    ],
    'starts_with' => 'The :attribute должен начинаться с одного из following: :values.',
    'string' => 'The :attribute должна быть строка.',
    'timezone' => 'The :attribute должна быть допустимой зоной.',
    'unique' => 'The :attribute уже принято.',
    'uploaded' => 'The :attribute не удалось загрузить.',
    'url' => 'The :attribute формат недействителен.',
    'uuid' => 'The :attribute должен быть допустимым UUID.',

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
