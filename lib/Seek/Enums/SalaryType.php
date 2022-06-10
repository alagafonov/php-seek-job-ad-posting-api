<?php namespace Seek\Enums;

use MabeEnum\Enum;

/**
 * Work type enum
 */
class SalaryType extends Enum
{
    const ANNUAL_PACKAGE = 'Salaried';
    const ANNUAL_COMMISSION = 'SalariedPlusCommission';
    const COMMISSION_ONLY = 'CommissionOnly';
    const HOURLY_RATE = 'Hourly';
}
