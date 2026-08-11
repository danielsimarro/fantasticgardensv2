<?php
/**
 * Página de ajustes del tema (Apariencia → FG Ajustes): marca, datos de
 * contacto, horario, redes y coordenadas del schema. Se leen con fg_opt().
 *
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

add_action('admin_menu', function (): void {
    add_theme_page(
        __('Fantastic Gardens — Ajustes', 'fg-theme'),
        __('FG Ajustes', 'fg-theme'),
        'manage_options',
        'fg-settings',
        'fg_settings_page_html'
    );
});

add_action('admin_init', function (): void {
    $fields = [
        'brand', 'brand_sub',
        'phone', 'phone_href',
        'phone_sanpedro', 'phone_sanpedro_href', 'address',
        'phone_ronda', 'phone_ronda_href', 'address2',
        'cif', 'hours', 'hours_ronda', 'geo_lat', 'geo_lng',
    ];
    foreach ($fields as $f) {
        register_setting('fg_settings', 'fg_' . $f, ['sanitize_callback' => 'sanitize_text_field']);
    }
    register_setting('fg_settings', 'fg_email',     ['sanitize_callback' => 'sanitize_email']);
    register_setting('fg_settings', 'fg_instagram', ['sanitize_callback' => 'esc_url_raw']);
    register_setting('fg_settings', 'fg_facebook',  ['sanitize_callback' => 'esc_url_raw']);
});

function fg_settings_field(string $key, string $label, string $type = 'text', string $desc = ''): void {
    $defaults = fg_defaults();
    $val = get_option('fg_' . $key, '');
    ?>
    <tr>
      <th scope="row"><label for="fg_<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></label></th>
      <td>
        <input type="<?php echo esc_attr($type); ?>" id="fg_<?php echo esc_attr($key); ?>" name="fg_<?php echo esc_attr($key); ?>"
               value="<?php echo esc_attr($val); ?>" class="regular-text"
               placeholder="<?php echo esc_attr($defaults[$key] ?? ''); ?>">
        <?php if ($desc) : ?><p class="description"><?php echo esc_html($desc); ?></p><?php endif; ?>
      </td>
    </tr>
    <?php
}

function fg_settings_page_html(): void {
    if (!current_user_can('manage_options')) return;
    ?>
    <div class="wrap">
      <h1><?php esc_html_e('Fantastic Gardens — Ajustes', 'fg-theme'); ?></h1>
      <p style="color:#666;margin-bottom:2em"><?php esc_html_e('Marca, datos de contacto, horario y redes que aparecen en la cabecera, el pie, el formulario y el schema. Si se dejan vacíos, se usan los valores por defecto.', 'fg-theme'); ?></p>

      <form method="post" action="options.php">
        <?php settings_fields('fg_settings'); ?>

        <h2 class="title"><?php esc_html_e('Marca', 'fg-theme'); ?></h2>
        <table class="form-table" role="presentation">
          <?php
          fg_settings_field('brand', __('Nombre de marca', 'fg-theme'), 'text', __('Lo que se lee en la cabecera y en el menú móvil. Va aparte del título del sitio de WordPress para que el lockup diga siempre lo correcto.', 'fg-theme'));
          fg_settings_field('brand_sub', __('Segunda línea de la marca', 'fg-theme'), 'text', __('La línea pequeña bajo el nombre. Ej.: Marbella · Costa del Sol', 'fg-theme'));
          ?>
        </table>

        <h2 class="title"><?php esc_html_e('Contacto', 'fg-theme'); ?></h2>
        <table class="form-table" role="presentation">
          <?php
          fg_settings_field('phone', __('Móvil / WhatsApp (visible)', 'fg-theme'), 'text', __('Ej.: 691 142 679', 'fg-theme'));
          fg_settings_field('phone_href', __('Móvil / WhatsApp (enlace tel:)', 'fg-theme'), 'text', __('Sin espacios, con prefijo. Ej.: +34691142679', 'fg-theme'));
          fg_settings_field('email', 'Email', 'email', __('Destino del formulario de contacto.', 'fg-theme'));
          fg_settings_field('cif', 'CIF', 'text', __('Aparece en el aviso legal.', 'fg-theme'));
          ?>
        </table>

        <h2 class="title"><?php esc_html_e('Sede — San Pedro de Alcántara', 'fg-theme'); ?></h2>
        <table class="form-table" role="presentation">
          <?php
          fg_settings_field('phone_sanpedro', __('Teléfono San Pedro (visible)', 'fg-theme'));
          fg_settings_field('phone_sanpedro_href', __('Teléfono San Pedro (enlace tel:)', 'fg-theme'));
          fg_settings_field('address', __('Dirección San Pedro', 'fg-theme'));
          ?>
        </table>

        <h2 class="title"><?php esc_html_e('Sede — Garden Center y vivero de Ronda', 'fg-theme'); ?></h2>
        <table class="form-table" role="presentation">
          <?php
          fg_settings_field('phone_ronda', __('Teléfono Ronda (visible)', 'fg-theme'));
          fg_settings_field('phone_ronda_href', __('Teléfono Ronda (enlace tel:)', 'fg-theme'));
          fg_settings_field('address2', __('Dirección Ronda', 'fg-theme'));
          ?>
        </table>

        <h2 class="title"><?php esc_html_e('Horario', 'fg-theme'); ?></h2>
        <table class="form-table" role="presentation">
          <?php
          fg_settings_field('hours', __('Horario San Pedro (oficinas)', 'fg-theme'), 'text', __('Ej.: Lunes a Viernes, 8:00–16:00 (cerrado sábados y domingos).', 'fg-theme'));
          fg_settings_field('hours_ronda', __('Horario Ronda (vivero)', 'fg-theme'), 'text', __('Ej.: Lunes a Viernes, 7:00–15:00 · Sábados, 9:00–14:00 (cerrado domingos).', 'fg-theme'));
          ?>
        </table>

        <h2 class="title"><?php esc_html_e('Redes sociales', 'fg-theme'); ?></h2>
        <table class="form-table" role="presentation">
          <?php
          fg_settings_field('instagram', 'Instagram', 'url', __('URL completa (https://…). Vacío = no se muestra.', 'fg-theme'));
          fg_settings_field('facebook', 'Facebook', 'url', __('URL completa (https://…). Vacío = no se muestra.', 'fg-theme'));
          ?>
        </table>

        <h2 class="title"><?php esc_html_e('Ubicación (schema LocalBusiness)', 'fg-theme'); ?></h2>
        <table class="form-table" role="presentation">
          <?php
          fg_settings_field('geo_lat', __('Latitud', 'fg-theme'), 'text', __('Ej.: 36.4848 (desde Google Maps / Google Business).', 'fg-theme'));
          fg_settings_field('geo_lng', __('Longitud', 'fg-theme'), 'text', __('Ej.: -4.9483.', 'fg-theme'));
          ?>
        </table>

        <?php submit_button(); ?>
      </form>
    </div>
    <?php
}
