<?php


/*
Plugin Name: badWords
*/

// Acción al activar el plugin
register_activation_hook(__FILE__, 'custom_table_activation');


include_once 'MethodsDB.php';


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

/*
 * Creamos la funcion de sumar 2 numeros y vemos si se muestra en el contenido
 */

function sumar_dos_numeros($content){
    $numero1 = 5;
    $numero2 = 10;
    $suma = $numero1 + $numero2;
    $content = $content . "<br> La suma de $numero1 + $numero2 es: $suma";
    return $content;
}

//Esto añade al contenido todo lo que hayamos escrito en la función sumar_dos_numeros
add_filter('the_content', 'sumar_dos_numeros');






