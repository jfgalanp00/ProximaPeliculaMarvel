<?php
    const API_URL = "https://whenisthenextmcufilm.com/api";

    # Inicializar una nueva sesion de cURL; ch = cURL hanle
    $ch = curl_init(API_URL);

    // indicar que queremos recibir el resultado de la peticion y no mostrar en pantalla
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	// Deshabilitamos la verificación SSL (solo para propósitos de desarrollo y pruebas)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    /* Ejecutar la peticion y guardamos el resultado */
    $result = curl_exec( $ch );
	
	// Verificamos si hubo un error con la solicitud
	if (curl_errno($ch)) {
		echo "Error cURL: " . curl_error($ch);
		exit;
	}
	
	// Decodificamos la respuesta JSON
    $data = json_decode( $result, true );
    
	// Cerramos la sesión de cURL
    curl_close( $ch );    
?>

<head>
    <meta charset="UTF-8" />
    <title>
        La próxima película de Marvel
    </title>

    <meta name="description" content="La próxima película de Marvel" />
    <meta name="viewport" content="width=device-width, ininitial-scale=1.0" />
    
    <!--  esto es un css sin clase para ver un diseño rapido. la web es: https://picocss.com/docs -->
    <link 
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
    />

</head>

<main>
<!--   
    <pre style="font-size: 20px; overflow: scroll; height: 250px;">
        
            var_dump( $data );
        
    </pre>
-->
    <section>
        <img src="<?= $data["poster_url"]; ?>" width="300" alt="Poster de <?= $data["title"]; ?> "
        style="border-radius: 16px" />    
    </section>

    <hgroup>
        <h3>
            <?= $data["title"] ?> se estrena en <?= $data["days_until"]; ?> días.
        </h3>
        <p>
            Fecha de estreno: <?= $data["release_date"]; ?>
        </p>

        <p>
            La siguiente película es: <?= $data["following_production"]["title"]; ?>
        </p>
    </hgroup>
</main>

<style>
    :root{
        color-scheme: light dark;
    }

    body{
        display: grid;
        place-content: center;
    }

    section{
        display: flex;
        justify-content: center;
        text-align: center;
    }

    hgroup{
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }
</style>