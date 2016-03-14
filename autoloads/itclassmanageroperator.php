<?php


/**
 * Classe per l'operatore di template
 * 
 * @author Stefano Ziller
 */
class ITClassManagerOperator{
    public $Operators;
    
    /** 
     * Nome dell'operatore
     * 
     * @param string $name
     */
    public function __construct( $name = 'classes' ){
        $this->Operators = array( $name );
    }
    
    /**
     * Elenco degli operatori
     * 
     * @return array
     */
    function operatorList(){
        return $this->Operators;
    }
    
    /**
     * Vero se la lista dei parametri esiste per operatore
     * 
     * @return boolean
     */
    public function namedParameterPerOperator(){
        return true;
    }
    
    /**
     * Parametri da assegnare agli operatori
     * 
     * @return type
     */
    public function namedParameterList(){
        return array( 'classes' => array( 'result_type' => array( 'type' => 'string',
                                                                  'required' => true,
                                                                  'default' => 'remote_list' ))
                      );
    }

    /**
     * Switch sui possibili operatori
     * 
     * @param type $tpl
     * @param type $operatorName
     * @param type $operatorParameters
     * @param type $rootNamespace
     * @param type $currentNamespace
     * @param type $operatorValue
     * @param type $namedParameters
     */
    public function modify( $tpl, $operatorName, $operatorParameters,  $rootNamespace, $currentNamespace, &$operatorValue, $namedParameters  ){
        
        $result_type = $namedParameters['result_type'];
        if( $result_type == 'remote_list' ){
            $operatorValue = ITClassManager::fetchRemoteClassList();
        }
    }
    
}

