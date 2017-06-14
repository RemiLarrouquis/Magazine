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

    'accepted'             => 'Ce champ doit être accepté.',
    'active_url'           => 'Ce champ n\'est pas une URL valide.',
    'after'                => 'Ce champ doit être une date après :date.',
    'alpha'                => 'Ce champ doit contenir uniquement des lettres.',
    'alpha_dash'           => 'Ce champ doit contenir uniquement des lettres, nombres, and tirets.',
    'alpha_num'            => 'Ce champ doit contenir uniquement des lettres et nombres.',
    'array'                => 'Ce champ doit être un tableau.',
    'before'               => 'Ce champ doit être une date avant :date.',
    'between'              => [
        'numeric' => 'Ce champ doit être entre :min et :max.',
        'file'    => 'Ce champ doit être entre :min et :max ko.',
        'string'  => 'Ce champ doit être entre :min et :max charactères.',
        'array'   => 'Ce champ doit avoir entre :min et :max objets.',
    ],
    'boolean'              => 'Ce champ doit être vrai ou faux.',
    'confirmed'            => 'Ce champ confirmation ne correspond pas.',
    'date'                 => 'Ce champ n\'est pas une date valide.',
    'date_format'          => 'Ce champ ne correspond pas au format :format.',
    'different'            => 'Ce champ et :other doivent être differents.',
    'digits'               => 'Ce champ doit être :digits digits.',
    'digits_between'       => 'Ce champ doit être entre :min et :max digits.',
    'dimensions'           => 'Les dimmensions de Ce champ sont invalides.',
    'distinct'             => 'Ce champ ce champ existe déjà.',
    'email'                => 'Ce champ doit être une adresse mail.',
    'exists'               => 'Ce champ est invalide.',
    'filled'               => 'Ce champ doit être remplis.',
    'image'                => 'Ce champ doit être une image.',
    'in'                   => 'Ce champ est invalide.',
    'in_array'             => 'Ce champ n\'existe pas dans :other.',
    'integer'              => 'Ce champ doit être un entier.',
    'ip'                   => 'Ce champ doit être une adresse IP.',
    'json'                 => 'Ce champ doit être une chaine JSON.',
    'max'                  => [
        'numeric' => 'Ce champ ne doit pas dépasser :max.',
        'file'    => 'Ce champ ne doit pas dépasser :max kilobytes.',
        'string'  => 'Ce champ ne doit pas dépasser :max characters.',
        'array'   => 'Ce champ ne doit pas avoir plus de :max objets.',
    ],
    'mimes'                => 'Ce champ doit être un fichier de type: :values.',
    'min'                  => [
        'numeric' => 'Ce champ doit dépasser :min.',
        'file'    => 'Ce champ doit dépasser :min kilobytes.',
        'string'  => 'Ce champ doit dépasser :min characters.',
        'array'   => 'Ce champ doit avoir au moins :min objets.',
    ],
    'not_in'               => 'Ce champ est invalide.',
    'numeric'              => 'Ce champ doit être un nombre.',
    'present'              => 'Ce champ doit être present.',
    'regex'                => 'Ce champ format incorrect.',
    'required'             => 'Ce champ est requis.',
    'required_if'          => 'Ce champ est requis si :other est :value.',
    'required_unless'      => 'Ce champ est requis sauf si :other est dans :values.',
    'required_with'        => 'Ce champ est requis si :values est present.',
    'required_with_all'    => 'Ce champ est requis si when :values est present.',
    'required_without'     => 'Ce champ est requis si :values n\'est pas present.',
    'required_without_all' => 'Ce champ est requis si aucun de :values n\'est présent.',
    'same'                 => 'Ce champ et :other doivent correspondrent.',
    'size'                 => [
        'numeric' => 'Ce champ doit être :size.',
        'file'    => 'Ce champ doit être :size kilobytes.',
        'string'  => 'Ce champ doit être :size characteres.',
        'array'   => 'Ce champ doit contenir :size objets.',
    ],
    'string'               => 'Ce champ doit être une chaine.',
    'timezone'             => 'Ce champ doit être une zone valide.',
    'unique'               => 'Ce champ est déjà utilisé.',
    'url'                  => 'Ce champ est d\'un format invalide.',

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
