<?php
final class BookStatus
{
    public const AVAILABLE   = 'available';
    public const RESERVED    = 'reserved';
    public const UNAVAILABLE = 'unavailable';
    public const LENT        = 'lent';

    public static function all(): array
    {
        return [
            self::AVAILABLE,
            self::RESERVED,
            self::UNAVAILABLE,
            self::LENT,
        ];
    }

    public static function labels(): array
    {
        return [
            self::AVAILABLE   => 'Disponible',
            self::RESERVED    => 'Réservé',
            self::UNAVAILABLE => 'Indisponible',
            self::LENT        => 'Prêté',
        ];
    }

    public static function labelOf(string $status): string
    {
        return self::labels()[$status] ?? $status;
    }
}