<?php

$count = 0;


if ( !is_dir('./storage') ) mkdir('./storage');

$data = ( !file_exists('database.json') ? [] : json_decode(file_get_contents('database.json')));

$writetable = fopen('database.json', 'w');

foreach ($_FILES as $key => $file) {

	if ( !move_uploaded_file($file['tmp_name'], './storage/' . $file['name']) ) {
		return print_r( json_encode(['message' => 'No fue posible subir los archivos', 'status' => http_response_code(500)] ));
	}

    array_push($data,[
        'is' => $key,
        'file_name' => $file['name']
    ]);
    $count++;
}

if( $count == count($_FILES)){
    fwrite($writetable, json_encode($data));
    fclose($writetable);

    return print_r(json_encode(
        [
            'message' => 'Se subieron ' . $count . 'archivos con exito',
            'status' => http_response_code(200),
            $data
        ]
    ));
}