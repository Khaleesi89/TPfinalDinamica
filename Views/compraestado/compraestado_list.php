<?php

require_once('../templates/header2.php');
$objConCompraestado = new CompraestadoController();
$objcompraestadotipo = new CompraestadotipoController();
$tiposestado = $objcompraestadotipo->listarTodo();
//$arraydeldescripcion = sacarDescripcion($tiposestado);
$lista = $objConCompraestado->listarTodo();

?>

    <table id="dg" title="Administrador de compras estado" class="easyui-datagrid" style="width:700px;height:600px" url="accion/listar_compraestado.php" toolbar="#toolbar" pagination="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idcompraestado" width="50">Id</th>
                <th field="idcompra" width="50">n° pedido/compra</th>
                <th field="idcompraestadotipo" width="50">Id compra estado tipo</th>
                <th field="cetdescripcion" width="50">descripcion</th>
                <th field="cefechaini" width="50">Ce fecha ini</th>
                <th field="cefechafin" width="50">Ce fecha fin</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editCompraEstado()">Editar estado de compra</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyCompraEstado()">Destroy estado de compra</a>
    </div>
    <div id="dlg" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="POST" novalidate style="margin:0;padding:20px 50px;">
            <h3>Compra estado información</h3>
            <div style="margin-bottom:10px;">
                <input readonly name="idcompraestado" id="idcompraestado" class="easyui-textbox" required="true" label="Id compra estado" style="width:100%;">
            </div>
            <div style="margin-bottom:10px;">
                <input readonly name="idcompra" id="idcompra" class="easyui-textbox" required="true" label="N° pedido/compra" style="width:100%;">
            </div>
            <div style="margin-bottom:10px;">
                <input readonly name="cefechaini" id="cefechaini" class="easyui-textbox" required="true" label="fecha pedido/compra" style="width:100%;">
            </div>
            <!-- <div style="margin-bottom:10px;">
                <input readonly name="idcompraestadotipo" id="idcompraestadotipo" class="easyui-textbox" required="true" label="id compraestado" style="width:100%;">
            </div> -->
            
            <div style="margin-bottom:10px">
                <select class="easyui-combobox" name="cetdescripcion" label="cetdescripcion" style="width:100%">
                        <?php 
                        $cantidad = count($tiposestado);
                        for ($i=0; $i < $cantidad ; $i++) { ?>
                            
                        <option name="idcompraestadotipo" value="<?php echo $tiposestado[$i]->getIdcompraestadotipo() ?>" > <?php echo $tiposestado[$i]->getIdcompraestadotipo(). " - " .$tiposestado[$i]->getCetdescripcion() ?> </option>
                        <?php } ?>
                </select>
            </div>
            
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarCompraEstado()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script>
        var url;

        function newCompraEstado() {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo estado compra');
            $('#fm').form('clear');
            url = 'accion/insertar_compraestado.php';
        }

        function editCompraEstado() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar estado de compra');
                $('#fm').form('load', row);
                url = 'accion/edit_compraestado.php?idcompraestado='+row.idcompraestado;
            }
        }

        function guardarCompraEstado() {
            $('#fm').form('submit', {
                url: url,
                onSubmit: function() {
                    return $(this).form('validate');
                },
                success: function(result) {
                    var result = eval('(' + result + ')');
                    //alert('Volvio servidor');
                    if (!result.respuesta) {
                        $.messager.show({
                            title: 'Error',
                            msg: result.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');
                        $('#dg').datagrid('reload');
                    }
                }
            })
        }

        function destroyCompraEstado() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('confirm', 'Seguro desea eliminar el estado de compra?', function(r) {
                    if (r) {
                        $.post('accion/destroy_compraestado.php?idcompraestado=' + row.idcompraestado, {
                            compraestado: row.id
                        }, function(result) {
                            //alert('Volvio servidor');
                            if (result.respuesta) {
                                $('#dg').datagrid('reload');
                            } else {
                                $.messager.show({
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        }, 'json');
                    }
                })
            }
        }

    </script>

    </div>
</body>

</html>