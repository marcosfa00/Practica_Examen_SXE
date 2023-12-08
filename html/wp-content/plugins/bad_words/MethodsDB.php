<?php
/*
 * Aquí organizaremos los métodos para llamarlos desde la pagina principal
 */


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

/*
 * para lanzar la función debemos hacer lo siguiente:
 */
// Acción para insertar datos en la tabla después de que WordPress haya cargado los plugins
add_action('plugins_loaded', 'insert_data_to_custom_table');//esta función se ejecuta cuando se cargan los plugins



/*
 * Función para insertar palabras malsonantes y sus reemplazos en la tabla
 */

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
 * Lanzamos la función
 */
// Acción para insertar datos en la tabla después de que WordPress haya cargado los plugins
add_action('plugins_loaded', 'insert_data_to_custom_table');



