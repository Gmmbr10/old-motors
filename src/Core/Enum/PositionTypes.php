<?php

namespace Core\Enum;

enum PositionTypes: string
{
    case Admin = 'admin';
    case Common = 'common';
    case Saleman = 'saleman';


    public static function content(PositionTypes $type): string
    {
        return match ($type) {
            self::Admin => 'Administrador',
            self::Saleman => 'Vendedor',
            self::Common => 'Comum',
            default => 'Desconhecido'
        };
    }
}
