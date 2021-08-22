<?php
        // Pobieranie url strony
        $url = 'https://dlabystrzakow.pl/xml/produkty-dlabystrzakow.xml';

        // Pobieranie i zapisywanie pliku xml
        if(file_put_contents( "downloaded_file.xml",file_get_contents($url))) {
            $xml = simplexml_load_file("downloaded_file.xml");
        }
        else {
            // W przypadku błędu pobranie pliku lokalnego
            echo("Wystąpił błąd podczas pobierania, plik zostanie pobrany lokalnie");
            $xml = simplexml_load_file("downloaded_file_copy.xml");
        }
        
        // Zczytywanie danych każdej książki i zapisywanie ich
        foreach($xml->lista->ksiazka as $book)
        {
            $array[] = Array (
                "ident" => strval($book->ident),
                "tytul" => strval($book->tytul[0]),
                "liczbastron" => strval($book->liczbastron),
                "datawydania" => strval($book->datawydania),
            );
        }
        // Tworzenie pliku json
        $json = json_encode(array('ksiazki' => $array),JSON_PRETTY_PRINT);
        if (file_put_contents("data.json", $json))
            echo "Plik utworzono pomyślnie.";
        else 
            echo "Błąd podczas tworzenia pliku.";  
?>