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

    'accepted' => ':attribute を承認する必要があります。',
    'accepted_if' => ':other が :value のとき、:attribute を承認する必要があります。',
    'active_url' => ':attribute は有効なURLである必要があります。',
    'after' => ':attribute は :date より後の日付である必要があります。',
    'after_or_equal' => ':attribute は :date 以降の日付である必要があります。',
    'alpha' => ':attribute には文字のみを含めることができます。',
    'alpha_dash' => ':attribute には、文字、数字、ダッシュ、アンダースコアのみを含めることができます。',
    'alpha_num' => ':attribute には、文字と数字のみを含めることができます。',
    'array' => ':attribute は配列である必要があります。',
    'ascii' => ':attribute には、シングルバイトの英数字と記号のみを含めることができます。',
    'before' => ':attribute は :date より前の日付である必要があります。',
    'before_or_equal' => ':attribute は :date 以前の日付である必要があります。',
    'between' => [
        'array' => ':attribute には :min ～ :max 個の項目が必要です。',
        'file' => ':attribute は :min ～ :max キロバイトである必要があります。',
        'numeric' => ':attribute は :min ～ :max の間である必要があります。',
        'string' => ':attribute は :min ～ :max 文字である必要があります。',
    ],
    'boolean' => ':attribute は true または false である必要があります。',
    'can' => ':attribute に許可されていない値が含まれています。',
    'confirmed' => ':attribute の確認が一致しません。',
    'contains' => ':attribute に必要な値が含まれていません。',
    'current_password' => 'パスワードが正しくありません。',
    'date' => ':attribute は有効な日付である必要があります。',
    'date_equals' => ':attribute は :date と同じ日付である必要があります。',
    'date_format' => ':attribute は :format 形式と一致する必要があります。',
    'decimal' => ':attribute には :decimal 桁の小数点以下が必要です。',
    'declined' => ':attribute を辞退する必要があります。',
    'declined_if' => ':other が :value のとき、:attribute を辞退する必要があります。',
    'different' => ':attribute と :other は異なる必要があります。',
    'digits' => ':attribute は :digits 桁である必要があります。',
    'digits_between' => ':attribute は :min ～ :max 桁である必要があります。',
    'dimensions' => ':attribute の画像サイズが無効です。',
    'distinct' => ':attribute に重複する値があります。',
    'doesnt_end_with' => ':attribute は次のいずれかで終了してはいけません: :values。',
    'doesnt_start_with' => ':attribute は次のいずれかで始まってはいけません: :values。',
    'email' => ':attribute は有効なメールアドレスである必要があります。',
    'ends_with' => ':attribute は次のいずれかで終わる必要があります: :values。',
    'enum' => '選択された :attribute は無効です。',
    'exists' => '選択された :attribute は無効です。',
    'extensions' => ':attribute は次の拡張子のいずれかである必要があります: :values。',
    'file' => ':attribute はファイルである必要があります。',
    'filled' => ':attribute には値が必要です。',
    'gt' => [
        'array' => ':attribute には :value 個以上の項目が必要です。',
        'file' => ':attribute は :value キロバイトより大きい必要があります。',
        'numeric' => ':attribute は :value より大きい必要があります。',
        'string' => ':attribute は :value 文字より多く必要です。',
    ],
    'gte' => [
        'array' => ':attribute には :value 個以上の項目が必要です。',
        'file' => ':attribute は :value キロバイト以上である必要があります。',
        'numeric' => ':attribute は :value 以上である必要があります。',
        'string' => ':attribute は :value 文字以上である必要があります。',
    ],
    'hex_color' => ':attribute は有効な16進数の色コードである必要があります。',
    'image' => ':attribute は画像である必要があります。',
    'in' => '選択された :attribute は無効です。',
    'in_array' => ':attribute は :other に存在する必要があります。',
    'integer' => ':attribute は整数である必要があります。',
    'ip' => ':attribute は有効なIPアドレスである必要があります。',
    'ipv4' => ':attribute は有効なIPv4アドレスである必要があります。',
    'ipv6' => ':attribute は有効なIPv6アドレスである必要があります。',
    'json' => ':attribute は有効なJSON文字列である必要があります。',
    'list' => ':attribute はリストである必要があります。',
    'lowercase' => ':attribute は小文字である必要があります。',
    'lt' => [
        'array' => ':attribute には :value 個未満の項目が必要です。',
        'file' => ':attribute は :value キロバイト未満である必要があります。',
        'numeric' => ':attribute は :value 未満である必要があります。',
        'string' => ':attribute は :value 文字未満である必要があります。',
    ],
    'lte' => [
        'array' => ':attribute には :value 個以下の項目しか含めることができません。',
        'file' => ':attribute は :value キロバイト以下である必要があります。',
        'numeric' => ':attribute は :value 以下である必要があります。',
        'string' => ':attribute は :value 文字以下である必要があります。',
    ],
    'mac_address' => ':attribute は有効なMACアドレスである必要があります。',
    'max' => [
        'array' => ':attribute には :max 個以下の項目しか含めることができません。',
        'file' => ':attribute は :max キロバイト以下である必要があります。',
        'numeric' => ':attribute は :max 以下である必要があります。',
        'string' => ':attribute は :max 文字以下である必要があります。',
    ],
    'max_digits' => ':attribute は :max 桁以下である必要があります。',
    'mimes' => ':attribute は次のタイプのファイルである必要があります: :values。',
    'mimetypes' => ':attribute は次のタイプのファイルである必要があります: :values。',
    'min' => [
        'array' => ':attribute には少なくとも :min 個の項目が必要です。',
        'file' => ':attribute は少なくとも :min キロバイトである必要があります。',
        'numeric' => ':attribute は少なくとも :min である必要があります。',
        'string' => ':attribute は少なくとも :min 文字である必要があります。',
    ],
    'min_digits' => ':attribute は少なくとも :min 桁必要です。',
    'missing' => ':attribute は存在してはいけません。',
    'missing_if' => ':other が :value のとき、:attribute は存在してはいけません。',
    'missing_unless' => ':other が :value でない限り、:attribute は存在してはいけません。',
    'missing_with' => ':values が存在する場合、:attribute は存在してはいけません。',
    'missing_with_all' => ':values がすべて存在する場合、:attribute は存在してはいけません。',
    'multiple_of' => ':attribute は :value の倍数である必要があります。',
    'not_in' => '選択された :attribute は無効です。',
    'not_regex' => ':attribute の形式が無効です。',
    'numeric' => ':attribute は数値である必要があります。',
    'password' => [
        'letters' => ':attribute には少なくとも1文字が含まれている必要があります。',
        'mixed' => ':attribute には少なくとも1つの大文字と小文字が含まれている必要があります。',
        'numbers' => ':attribute には少なくとも1つの数字が含まれている必要があります。',
        'symbols' => ':attribute には少なくとも1つの記号が含まれている必要があります。',
        'uncompromised' => '入力された :attribute はデータ漏洩で発見されました。別の :attribute を選択してください。',
    ],
    'present' => ':attribute が存在する必要があります。',
    'present_if' => ':other が :value のとき、:attribute が存在する必要があります。',
    'present_unless' => ':other が :value でない限り、:attribute が存在する必要があります。',
    'present_with' => ':values が存在する場合、:attribute が存在する必要があります。',
    'present_with_all' => ':values がすべて存在する場合、:attribute が存在する必要があります。',
    'prohibited' => ':attribute は使用禁止です。',
    'prohibited_if' => ':other が :value のとき、:attribute は使用禁止です。',
    'prohibited_unless' => ':other が :values のいずれかでない限り、:attribute は使用禁止です。',
    'prohibits' => ':attribute は :other の存在を禁止します。',
    'regex' => ':attribute の形式が無効です。',
    'required' => ':attribute は必須項目です。',
    'required_array_keys' => ':attribute には :values のエントリが含まれている必要があります。',
    'required_if' => ':other が :value のとき、:attribute は必須項目です。',
    'required_if_accepted' => ':other が承認されている場合、:attribute は必須項目です。',
    'required_if_declined' => ':other が辞退されている場合、:attribute は必須項目です。',
    'required_unless' => ':other が :values のいずれかでない限り、:attribute は必須項目です。',
    'required_with' => ':values が存在する場合、:attribute は必須項目です。',
    'required_with_all' => ':values がすべて存在する場合、:attribute は必須項目です。',
    'required_without' => ':values が存在しない場合、:attribute は必須項目です。',
    'required_without_all' => ':values がすべて存在しない場合、:attribute は必須項目です。',
    'same' => ':attribute と :other は一致している必要があります。',
    'size' => [
        'array' => ':attribute は :size 個の項目を含む必要があります。',
        'file' => ':attribute は :size キロバイトである必要があります。',
        'numeric' => ':attribute は :size である必要があります。',
        'string' => ':attribute は :size 文字である必要があります。',
    ],
    'starts_with' => ':attribute は次のいずれかで始まる必要があります: :values。',
    'string' => ':attribute は文字列である必要があります。',
    'timezone' => ':attribute は有効なタイムゾーンである必要があります。',
    'unique' => ':attribute は既に使用されています。',
    'uploaded' => ':attribute のアップロードに失敗しました。',
    'uppercase' => ':attribute は大文字である必要があります。',
    'url' => ':attribute は有効なURLである必要があります。',
    'ulid' => ':attribute は有効なULIDである必要があります。',
    'uuid' => ':attribute は有効なUUIDである必要があります。',

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
