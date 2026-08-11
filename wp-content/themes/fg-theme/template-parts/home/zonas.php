<?php
/**
 * Home · Marquesina de zonas de trabajo (cinta continua).
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

fg_zones_marquee([
    ['label' => __('Marbella', 'fg-theme')],
    ['label' => __('San Pedro Alcántara', 'fg-theme'), 'destacada' => true],
    ['label' => __('Estepona', 'fg-theme')],
    ['label' => __('Ronda', 'fg-theme')],
    ['label' => __('Costa del Sol', 'fg-theme'), 'destacada' => true],
    ['label' => __('Málaga', 'fg-theme')],
]);
