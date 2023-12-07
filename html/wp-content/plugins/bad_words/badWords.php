<?php


/*
Plugin Name: badWords
*/

// Acción al activar el plugin
register_activation_hook(__FILE__, 'custom_table_activation');

/*
 * Función que crea la tabla para almacenar las palabras a reemplazar
 */
function custom_table_activation()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'badWords'; // Nombre de la tabla con prefijo de WordPress

    $charset_collate = $wpdb->get_charset_collate();

    // Query para crear la tabla
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        palabra varchar(100) NOT NULL,
        cambio varchar(100) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // Se requiere el archivo upgrade.php para utilizar dbDelta()
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);//si la tabla ya esta creada no la vuelve a crear
}

// Acción para insertar datos en la tabla después de que WordPress haya cargado los plugins
add_action('plugins_loaded', 'insert_data_to_custom_table');

/*
 * Función para insertar palabras malsonantes y sus reemplazos en la tabla
 */
// Acción para insertar datos en la tabla después de que WordPress haya cargado los plugins
add_action('plugins_loaded', 'insert_data_to_custom_table');

function insert_data_to_custom_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'badWords'; // Nombre de la tabla con prefijo de WordPress

    // Array de palabras malsonantes y sus reemplazos
    $malsonantes = array(
        array(
            'palabra' => 'Ostiasss',
            'cambio' => 'Caspita'
        ),
        array(
            'palabra' => 'Gilipollas',
            'cambio' => 'Estólido'
        ),
        array(
            'palabra' => 'Joder',
            'cambio' => 'Dichosos'
        ),
        array(
            'palabra' => 'Cabronazo',
            'cambio' => 'Granuja'
        ),
        // Puedes agregar más palabras y sus reemplazos aquí
    );

    // Insertar palabras malsonantes en la tabla
    foreach ($malsonantes as $m) {
        $wpdb->insert(
            $table_name,
            array(
                'palabra' => $m['palabra'],
                'cambio' => $m['cambio']
            )
        );
    }

    // Verificar si se insertaron los datos correctamente
    if ($wpdb->last_error) {
        // Hubo un error al insertar los datos
        error_log('Error al insertar datos: ' . $wpdb->last_error);
    } else {
        // Los datos se insertaron correctamente
        error_log('Datos insertados correctamente en la tabla.');
    }
}

/*
 * Función para reemplazar palabras malsonantes en el contenido
 */
function replace_bad_words( $content ) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'badWords'; // Nombre de la tabla con prefijo de WordPress

    // Obtener palabras malsonantes y sus reemplazos de la base de datos
    $bad_words = $wpdb->get_results("SELECT palabra, cambio FROM $table_name", ARRAY_A);

    // Verificar si hay palabras malsonantes para reemplazar
    if ($bad_words) {
        foreach ($bad_words as $bad_word) {
            $content = str_ireplace($bad_word['palabra'], $bad_word['cambio'], $content);
        }
    }

    return $content;
}

add_filter( 'the_content', 'replace_bad_words' );




