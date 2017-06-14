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

    'accepted'             => ':attribute doit être accepté.',
    'active_url'           => ':attribute n\'est pas une URL valide.',
    'after'                => ':attribute doit être une date après :date.',
    'alpha'                => ':attribute doit contenir uniquement des lettres.',
    'alpha_dash'           => ':attribute doit contenir uniquement des lettres, nombres, and tirets.',
    'alpha_num'            => ':attribute doit contenir uniquement des lettres et nombres.',
    'array'                => ':attribute doit être un tableau.',
    'before'               => ':attribute doit être une date avant :date.',
    'between'              => [
        'numeric' => ':attribute doit être entre :min et :max.',
        'file'    => ':attribute doit être entre :min et :max ko.',
        'string'  => ':attribute doit être entre :min et :max charactères.',
        'array'   => ':attribute doit avoir entre :min et :max objets.',
    ],
    'boolean'              => ':attribute doit être vrai ou faux.',
    'confirmed'            => ':attribute confirmation ne correspond pas.',
    'date'                 => ':attribute n\'est pas une date valide.',
    'date_format'          => ':attribute ne correspond pas au format :format.',
    'different'            => ':attribute et :other doivent être differents.',
    'digits'               => ':attribute doit être :digits digits.',
    'digits_between'       => ':attribute doit être entre :min et :max digits.',
    'dimensions'           => 'Les dimmensions de :attribute sont invalides.',
    'distinct'             => ':attribute ce champ existe déjà.',
    'email'                => ':attribute doit être une adresse mail.',
    'exists'               => ':attribute est invalide.',
    'filled'               => ':attribute doit être remplis.',
    'image'                => ':attribute doit être une image.',
    'in'                   => ':attribute est invalide.',
    'in_array'             => ':attribute n\'existe pas dans :other.',
    'integer'              => ':attribute doit être un entier.',
    'ip'                   => ':attribute doit être une adresse IP.',
    'json'                 => ':attribute doit être une chaine JSON.',
    'max'                  => [
        'numeric' => ':attribute ne doit pas dépasser :max.',
        'file'    => ':attribute ne doit pas dépasser :max kilobytes.',
        'string'  => ':attribute ne doit pas dépasser :max characters.',
        'array'   => ':attribute ne doit pas avoir plus de :max objets.',
    ],
    'mimes'                => ':attribute doit être un fichier de type: :values.',
    'min'                  => [
        'numeric' => ':attribute doit dépasser :min.',
        'file'    => ':attribute doit dépasser :min kilobytes.',
        'string'  => ':attribute doit dépasser :min characters.',
        'array'   => ':attribute doit avoir au moins :min objets.',
    ],
    'not_in'               => ':attribute est invalide.',
    'numeric'              => ':attribute doit être un nombre.',
    'present'              => ':attribute doit être present.',
    'regex'                => ':attribute format incorrect.',
    'required'             => ':attribute est requis.',
    'required_if'          => ':attribute est requis si :other est :value.',
    'required_unless'      => ':attribute est requis sauf si :other est dans :values.',
    'required_with'        => ':attribute est requis si :values est present.',
    'required_with_all'    => ':attribute est requis si when :values est present.',
    'required_without'     => ':attribute est requis si :values n\'est pas present.',
    'required_without_all' => ':attribute est requis si aucun de :values n\'est présent.',
    'same'                 => ':attribute et :other doivent correspondrent.',
    'size'                 => [
        'numeric' => ':attribute doit être :size.',
        'file'    => ':attribute doit être :size kilobytes.',
        'string'  => ':attribute doit être :size characteres.',
        'array'   => ':attribute doit contenir :size objets.',
    ],
    'string'               => ':attribute doit être une chaine.',
    'timezone'             => ':attribute doit être une zone valide.',
    'unique'               => ':attribute est déjà utilisé.',
    'url'                  => ':attribute est d\'un format invalide.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
