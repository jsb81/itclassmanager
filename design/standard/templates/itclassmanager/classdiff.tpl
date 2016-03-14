<div class="global-view-full">
    
    {ezscript_require( array( 'ezjsc::jquery', 'jquery.tablesorter.min.js' ) )}
    <script type="text/javascript">
    var OpenpaClassBaseUrl = {'/openpa/class'|ezurl()};
    {literal}
    $(document).ready(function() {
        $("table.table").tablesorter();
        $("table.table th").css( 'cursor', 'pointer' );
        $("table.table tr").each( function(){
            var self = $(this);
            var id = $(this).attr( 'id' );
            var url = OpenpaClassBaseUrl + '/' + id + '?format=json';
            
            $.get( url, function(data){
                var diff = '';
                
                $.each( data, function( index, value){
                    
                    if (value) {
                        if(index==='hasMissingAttributes'){
                            diff += '<div class="label label-danger">Attributi Mancanti</div><br>';
                        }
                        else if(index==='hasExtraAttributes'){
                            diff += '<div class="label label-danger">Attributi aggiuntivi</div><br>';
                        }
                        else if(index==='hasDiffProperties'){
                            diff += '<div class="label label-danger">Proprietà non sincronizzate</div><br>';
                        }
                        else if(index==='hasDiffAttributes'){
                            diff += '<div class="label label-danger">Attributi non sincronizzati</div><br>';
                        }
                        else if(index==='hasError'){
                            diff += '<div class="label label-danger">Richiede controllo</div><br>';
                        }
                        else if(index==='error'){
                            diff += '<div class="label label-danger">' + value + '</div><br>';
                        }
                    }
                });
                
                if (self.find( 'td.diff' ).length > 0) {
                    if( diff === ''){
                        self.find( 'td.diff' ).html( '<div class="label label-success">Nessuna</div>' );
                    }
                    else{
                        self.find( 'td.diff' ).html( diff );
                    }

                    $("table.table").trigger("update"); 
                }
            });
        });
    });
    {/literal}
    </script>

    {*def $classList = fetch( 'class', 'list', hash( 'sort_by', array( 'name', true() ) ) )*}
    
    {def $classList = classes('remote_list')}
    
    <table class="table table-striped">
        <thead>                
            <tr>
                <th style="vertical-align: middle">Classe</th>
                <th style="vertical-align: middle">Differenze</th>
            </tr>
        </thead>
        <tbody>
            {foreach $classList as $class}
                <tr id="{$class.Identifier}">      
                    <td style="vertical-align: middle">
                        <a target="_blank" href={concat('/openpa/class/',$class.Identifier)|ezurl()}>
                            {if is_set($class.NameList.NameList.ita-IT)}
                                {$class.NameList.NameList.ita-IT}
                            {else}
                                {$class.NameList.NameList.eng-GB}
                            {/if}
                            
                            ({$class.Identifier})
                        </a>
                    </td>
                    <td class="diff">
                        <em>caricamento</em>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    
    
</div>