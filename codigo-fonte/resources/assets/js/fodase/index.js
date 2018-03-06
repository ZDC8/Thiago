var oTable = configTable();//Seta a configuração do datatables

$(document).ready(function() {

    $(document).on('click', '.destroyTr', destroyTr);
    $('.pesquisar_form').on('click', onSearchForm);
    $('#limparFiltros').on('click', onResetForm);
    
    $('#data_table_filter').find('select').change(function(e){    
        var table = $('#data_table').DataTable().draw();
    });
});

/**
 * Destroy o item da modelo
 * @returns {undefined}
 */
function destroyTr() {
    var id = $(this).attr('data-rel');
    
    appUtil.confirmBox('Deseja realmente excluir este Fodase?', function(retorno) {
        if (retorno) {
            $.ajax({
                url: APP.controller_url + '/destroy/'+id
            }).done(function(data) {
                appUtil.createFlashMesseger(data.msg, data.success);
                oTable.draw();
            });
        } 
     });
}

/**
 * Reseta o formulário de pesquisa
 * @param event Evento
 */
function onResetForm(e) {
    $(this).closest('form')[0].reset();
    $(this).closest('form').find('select').select2();
    oTable.draw();
}

/**
 * Realiza o ajax do datatable em seguida atualiza o datatables da tela
 * @param event Evento
 */
function onSearchForm(e){
    oTable.draw();
}

/**
 * Monta config do DataTables
 * @returns {unresolved}
 */
function configTable() {
    return $('#data_table').DataTable({
        ajax: {
            url: APP.controller_url + '/index',
            data: function (data) {
                
                $.each($('.search_form').serializeArray(), function(index, obj){
                    data[obj.name] = obj.value;
                });
            }
        },
        columns: [
        
            {data:'nome', name:'nome', className:'text-left'},
        
            {data:'carro', name:'carro', className:'text-left'},
        
            {data:'teste', name:'teste', className:'text-left'},
            {data:'acoes', name:'botoes', className:'text-center'}
        ]
    });
}