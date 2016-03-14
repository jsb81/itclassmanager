<?php

/**
 * Estrae in formato JSON l'elenco delle classi di contenuto
 * per il siteaccess attuale
 * 
 */

$module = $Params['Module'];

try
{
    $itClassManager = new ITClassManager();
    
    $result = $itClassManager->fetchClassList();
    
} catch (Exception $ex) {
    $result = array( 'error' => $ex->getMessage() ); 
}

header('Content-Type: application/json');
echo json_encode( $result );    
eZExecution::cleanExit();
