<?php
/**
 * Textos legales por defecto. Se usan como fallback cuando la página de WordPress
 * no tiene contenido propio, de modo que el tema funcione "llave en mano". El
 * cliente puede sobrescribirlos editando el contenido de la página.
 *
 * Datos de empresa desde los ajustes del tema (fg_opt) para mantener coherencia con el pie.
 *
 * @package Fantastic_Gardens
 */
if (!defined('ABSPATH')) exit;

/** Renderiza la plantilla legal: breadcrumb + título + contenido (the_content o fallback). */
function fg_render_legal(string $slug, string $title): void {
    get_header();
    ?>
    <section class="section">
      <div class="wrap legal">
        <?php fg_breadcrumb([['label' => __('Inicio', 'fg-theme'), 'url' => home_url('/')], ['label' => $title]]); ?>
        <h1 class="page-title"><?php echo esc_html($title); ?></h1>
        <span class="accent-rule"></span>
        <div class="legal-prose">
          <?php
          $content = trim((string) get_post_field('post_content', get_the_ID()));
          if ($content !== '') {
              echo apply_filters('the_content', $content);
          } else {
              echo fg_legal_default($slug); // markup interno controlado
          }
          ?>
        </div>
      </div>
    </section>
    <?php
    get_footer();
}

/** Texto legal por defecto para un slug dado ('aviso-legal'|'cookies'|'privacidad'). */
function fg_legal_default(string $slug): string {
    $email   = esc_html(fg_opt('email'));
    $mailto  = esc_url('mailto:' . fg_opt('email'));
    $cif     = esc_html(fg_opt('cif'));
    $address = esc_html(fg_opt('address'));
    $phone   = esc_html(fg_opt('phone'));

    if ($slug === 'aviso-legal') {
        return '
        <h2>Aviso legal y condiciones de uso de la web</h2>
        <p>Los contenidos e imágenes de este sitio web son propiedad exclusiva de <strong>Fantastic Gardens A.J. S.L.</strong></p>
        <h2>Datos de la empresa</h2>
        <ul>
          <li><strong>Denominación social:</strong> Fantastic Gardens A.J. S.L.</li>
          <li><strong>CIF:</strong> ' . $cif . '</li>
          <li><strong>Domicilio:</strong> ' . $address . '</li>
          <li><strong>Teléfono:</strong> ' . $phone . '</li>
          <li><strong>Email:</strong> <a href="' . $mailto . '">' . $email . '</a></li>
        </ul>
        <h2>Reproducciones</h2>
        <p>El diseño, la programación y los contenidos de este sitio web están protegidos por la legislación de propiedad intelectual e industrial vigente. Queda prohibido el plagio o copia de los mismos. La reproducción total o parcial sin consentimiento escrito del propietario está totalmente prohibida en cualquier soporte, mecánico o digital.</p>
        <h2>Consentimiento del usuario</h2>
        <p>El envío de datos personales, mediante el uso de los formularios electrónicos o, en su caso, mensajes de correo electrónico, supone el consentimiento expreso del remitente al tratamiento automatizado de los datos. Fantastic Gardens A.J. S.L. se compromete a no ceder estos datos a terceros para uso comercial o publicitario.</p>
        <h2>Derechos de acceso, rectificación, oposición y cancelación</h2>
        <p>El usuario podrá ejercer estos derechos mediante envío postal a las oficinas de la empresa o por email a <a href="' . $mailto . '">' . $email . '</a>.</p>
        <h2>Hiperenlaces</h2>
        <p>El establecimiento de hiperenlaces hacia este sitio web requiere solicitud escrita previa. Únicamente se podrá enlazar a la página de inicio (https://fantasticgardens.net), sin reproducción de contenidos, sin frames y sin inserción de marcas.</p>';
    }

    if ($slug === 'cookies') {
        return '
        <p>Una cookie es un fichero que se descarga en su ordenador al acceder a determinadas páginas web. Las cookies permiten a una página web, entre otras cosas, almacenar y recuperar información sobre los hábitos de navegación de un usuario o de su equipo y, dependiendo de la información que contengan y de la forma en que utilice su equipo, pueden utilizarse para reconocer al usuario. Las cookies no contienen ninguna clase de información personal específica, y la mayoría se borran del disco duro al finalizar la sesión de navegador (cookies de sesión).</p>
        <p>La mayoría de los navegadores aceptan como estándar las cookies y permiten o impiden en los ajustes de seguridad las cookies temporales o memorizadas.</p>
        <h2>¿Qué tipos de cookies utiliza esta página web?</h2>
        <ul>
          <li><strong>Cookies técnicas:</strong> permiten la navegación y la utilización de las diferentes opciones o servicios de la web (controlar el tráfico, identificar la sesión, acceder a partes restringidas, elementos de seguridad, compartir en redes sociales…).</li>
          <li><strong>Cookies de personalización:</strong> permiten acceder al servicio con características predefinidas (idioma, tipo de navegador, configuración regional…).</li>
          <li><strong>Cookies de análisis:</strong> permiten medir y analizar estadísticamente el uso del servicio para mejorar la oferta.</li>
          <li><strong>Cookies publicitarias y de publicidad comportamental:</strong> gestionan los espacios publicitarios en función del uso y de los hábitos de navegación.</li>
        </ul>
        <h2>Cookies de terceros</h2>
        <p>Este sitio puede utilizar Google Analytics, un servicio analítico de Google, Inc. (EE. UU.). Estas cookies recopilan información, incluida la dirección IP, que será tratada por Google en los términos fijados en su sitio web. El usuario puede permitir, bloquear o eliminar las cookies mediante la configuración de su navegador (Chrome, Edge, Firefox, Safari). El bloqueo de cookies puede impedir el uso pleno de algunas funcionalidades.</p>
        <p>Si tiene dudas sobre esta política de cookies, puede contactar con nosotros a través de <a href="' . esc_url(fg_page_url('contacto')) . '">nuestro formulario de contacto</a>.</p>';
    }

    // privacidad
    return '
    <h2>1. Aviso legal y su aceptación</h2>
    <p>El presente aviso legal regula el uso de los servicios de <strong>Fantastic Gardens A.J. S.L.</strong>, con domicilio en ' . $address . ', C.I.F. ' . $cif . ', correo electrónico <a href="' . $mailto . '">' . $email . '</a>. La utilización de las páginas web implica la aceptación plena de todas las disposiciones incluidas en este Aviso Legal.</p>
    <h2>2. Política de tratamiento de datos de carácter personal</h2>
    <p>Para acceder a determinados servicios, el usuario deberá proporcionar datos personales, que serán tratados en los ficheros de la empresa con la finalidad de prestarle y ofrecerle los servicios. Finalidades: prestación de servicios, mejoras del sitio web, finalidades comerciales y envío de información sobre productos y servicios.</p>
    <p><strong>Derechos del usuario:</strong> acceso, rectificación, cancelación y oposición dirigiéndose a <a href="' . $mailto . '">' . $email . '</a>. La empresa ha adoptado las medidas técnicas necesarias para la seguridad de los datos. El usuario garantiza la veracidad de los datos facilitados.</p>
    <h2>3. Condiciones de utilización de los servicios web</h2>
    <p>El usuario se compromete a utilizar el sitio conforme a la ley, al presente Aviso Legal y a la moral y buenas costumbres, absteniéndose de usos ilícitos, lesivos de derechos de terceros, publicidad ilícita o engañosa, incorporación de virus, o infracción de derechos de propiedad intelectual.</p>
    <h2>4. Contenidos recogidos en la web</h2>
    <p>Los usuarios que depositen información no se convierten en socios ni colaboradores de la empresa. Los enlaces informativos no constituyen recomendaciones; la empresa no es responsable de los resultados obtenidos a través de hipervínculos.</p>
    <h2>5. Propiedad intelectual e industrial</h2>
    <p>Todos los elementos del diseño, menús, código y contenidos están protegidos por derechos de propiedad industrial e intelectual de la empresa o de terceros. Queda prohibida su alteración, reproducción, distribución o comunicación pública.</p>
    <h2>6. Utilización del sitio bajo la exclusiva responsabilidad del usuario</h2>
    <p>El usuario utiliza el sitio web bajo su única responsabilidad y responde frente a reclamaciones de terceros.</p>
    <h2>7. Exclusión de garantías y de responsabilidades</h2>
    <p>La empresa no garantiza la disponibilidad, continuidad, utilidad o infalibilidad del servicio, y excluye su responsabilidad por la falta de disponibilidad, fallos de acceso, contenidos de usuarios, infracción de derechos, falta de veracidad o suplantación de personalidad, entre otros.</p>
    <h2>8. Actualización de la web</h2>
    <p>La empresa se reserva el derecho a actualizar, modificar o eliminar la información, pudiendo limitar o no permitir el acceso.</p>
    <h2>9. Licencia</h2>
    <p>La empresa autoriza el uso de las aplicaciones informáticas únicamente para utilizar el servicio conforme al presente Aviso Legal.</p>
    <h2>10. Duración y terminación</h2>
    <p>Los servicios y contenidos tienen una duración indefinida. La empresa podrá dar por terminada, suspender o interrumpir unilateralmente la prestación de los servicios.</p>
    <h2>11. Legislación aplicable</h2>
    <p>El presente Aviso Legal se rige por la legislación española.</p>';
}
