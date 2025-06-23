<?php

use Carbon\Carbon; 

/**
 * Get the value from the array if it's set, otherwise return default.
 *
 * @param array $ls      The array to fetch from.
 * @param string $key    The key to look up.
 * @param mixed|null $default The default value if key is not found.
 * @return mixed
 */
function get(array $ls, string $key, mixed $default = null)
{
    if (array_key_exists($key, $ls)) {
        return $ls[$key];
    }

    return $default;
}

/**
 * Check if a value is filled (not null, not empty, and not zero).
 *
 * @param mixed $v
 * @return bool
 */
function isfilled($v)
{
    return $v !== null && $v !== '' && $v !== 0;
}

/**
 * Format a number to 2 decimal places.
 *
 * @param int|float|null $v
 * @return string
 */
function nfmt(int|float|null $v)
{
    if (!isfilled($v)) {
        return '0.00';
    }

    return number_format($v, 2);
}

/**
 * Format a number without decimal places (integer formatting).
 *
 * @param int|float|null $v
 * @return string
 */
function ifmt(int|float|null $v)
{
    if (!isfilled($v)) {
        return '0';
    }

    return number_format($v);
}

/**
 * Format a monetary value using localized currency format.
 *
 * @param int|float|null $v
 * @param string $currency The ISO 4217 currency code (e.g., 'GHS', 'USD').
 * @return string|false
 */
function mfmt(int|float|null $v, string $currency = 'GHS')
{
    if (!isfilled($v)) {
        return '0';
    }

    $locale = 'en_US';
    $fmt = new NumberFormatter($locale, NumberFormatter::CURRENCY);
    return $fmt->formatCurrency($v, $currency);
}

/**
 * Format enum-like values for display.
 * Converts underscores to spaces and capitalizes words.
 *
 * @param mixed $v
 * @return string
 */
function efmt($v): string
{
    $display = str_replace('_', ' ', $v);
    return ucwords($display);
}

/**
 * Format a date for display as 'Mon D, YYYY'.
 *
 * @param mixed $v A date string or Carbon-compatible value.
 * @return string
 */
function dfmt($v)
{
    if ($v == null) {
        return '';
    }

    $date = Carbon::parse($v);
    return $date->format('M j, Y');
}

/**
 * Format a datetime string as 'Mon Dth, YYYY h:ia'.
 *
 * @param mixed $v A datetime string or Carbon-compatible value.
 * @return string
 */
function tfmt($v)
{
    if ($v == null) {
        return '';
    }

    $date = Carbon::parse($v);
    return $date->format('M jS, Y g:ia');
}

/**
 * Format a date for HTML input type="date".
 *
 * @param mixed $v A date string or Carbon-compatible value.
 * @return string
 */
function hdfmt($v)
{
    if ($v == null) {
        return '';
    }

    $date = Carbon::parse($v);
    return $date->format('Y-m-d');
}

/**
 * Format a datetime for HTML input type="datetime-local".
 *
 * @param mixed $v A datetime string or Carbon-compatible value.
 * @return string
 */
function htfmt($v)
{
    if ($v == null) {
        return '';
    }

    $date = Carbon::parse($v);
    return $date->format('Y-m-d\TH:i');
}

/**
 * Format a boolean value as a check or cross symbol.
 *
 * @param mixed $value
 * @return string
 */
function bfmt($value): string
{
    if (is_bool($value)) {
        return $value ? '✔' : '✖';
    }
    return '';
}

/**
 * Format a UUID by showing only the last segment.
 *
 * @param string $uuid
 * @return string
 */
function idfmt(string $uuid): string
{
    $segments = explode('-', $uuid);
    return end($segments);
}