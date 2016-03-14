<?php

/**
 * Questa classe serve ad estrarre le classi di contenuto di un siteaccess remoto
 * 
 * @author Stefano Ziller <stefano.ziller@infotn.it>
 */
class ITClassManager {
    
    private $local_classes = NULL;
    
    /**
     * Ritorna l'elenco delle classi di contenuto del sito attuale
     * 
     * @return array
     */
    public static function fetchClassList() {
        $result = eZFunctionHandler::execute( 'class', 'list', '' );
        
        return $result;
    }
    
    /**
     * Funzione usata dall'operatore di template per caricare l'elenco
     * delle classi remote
     * 
     * @return array
     */
    public static function fetchRemoteClassList(){
        $result = array();
        
        // Indirizzo sito remoto
        $remote_url = eZINI::instance('openpa.ini')->variable( 'NetworkSettings', 'PrototypeUrl' ); 
        $remote_url = str_replace('openpa/classdefinition/', 'itclassmanager/classlist', $remote_url);
        
        if( $remote_url != FALSE ){
            // Ricavo le classi dal repository remoto
            // $remote_url .= 'itclassmanager/classlist';
            $remote_classes_json = file_get_contents($remote_url);
            $remote_classes = json_decode($remote_classes_json, true);
            
            $result = $remote_classes;
            
        }
        else{
            throw new Exception('Variabile ClassesRepository Url non configurata in itclassmanager.ini');
        }
        
        //echo '<pre>';
        //print_r( $result );
        //die();
        
        return $result;
    }
    
}
