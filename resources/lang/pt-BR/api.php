<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date 27/02/2019 23:11
 */

/*
    |--------------------------------------------------------------------------
    | API messages
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during returns API for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
*/
return [
        'http_errors' => [
            '200'  => 'OK',
            '201'  => 'Created',
            '400'  => 'Bad Request',
            '401'  => 'Unauthorized',
            '404'  => 'Page not found',
            '500'  => 'Server Error',
        ],
                'index' => [
            'success'  => 'Registros listados com sucesso!',
            'error'    => 'Erro ao tentar listar os registros :(',
        ],
                'store' => [
            'success'  => 'Registro criado com sucesso!',
            'error'    => 'Erro ao tentar criar o registro :(',
        ],
                'show' => [
            'success'  => 'Registro encontrado com sucesso!',
            'error'    => 'Erro ao tentar encontrar o registro :(',
        ],
                'update' => [
            'success'  => 'Registro atualizado com sucesso!',
            'error'    => 'Erro ao tentar atualizar o registro :(',
        ],
                'destroy' => [
            'success'  => 'Registro deletado com sucesso!',
            'error'    => 'Erro ao tentar deletar o registro :(',
        ],
    ];