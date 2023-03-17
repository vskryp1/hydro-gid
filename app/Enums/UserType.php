<?php

    namespace App\Enums;

    final class UserType extends CustomEnum
    {
        const ROLE_SUPER_ADMIN  = 'SUPER ADMIN';
        const ROLE_MANAGER      = 'MANAGER';
        const ROLE_EDITOR       = 'EDITOR';
        const ROLE_SIMPLE_USER  = 'SIMPLE USER';
        const ROLE_LEGAL_ENTITY = 'LEGAL ENTITY';

        public static $_adminRoles = [
            1 => self::ROLE_SUPER_ADMIN,
            2 => self::ROLE_MANAGER,
            3 => self::ROLE_EDITOR,
        ];

        public static $_webRoles = [
            4 => self::ROLE_SIMPLE_USER,
            5 => self::ROLE_LEGAL_ENTITY,
        ];
    }
