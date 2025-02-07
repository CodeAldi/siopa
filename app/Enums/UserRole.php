<?php

namespace App\Enums;

enum UserRole: String
{
    case admin = 'admin';
    case pengurus = 'pengurus';
    case anggota = 'anggota';
    case masyarakat = 'masyarakat';
}
