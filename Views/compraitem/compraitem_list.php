

<?php
require_once('../../config.php');
$objComItem = new CompraitemController();
$lista = $objComItem->listarTodo();
//var_dump ($lista);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Vendor/themes/default/easyui.css">
    <link rel="stylesheet" href="../../Vendor/themes/icon.css">
    <link rel="stylesheet" href="../../Vendor/themes/color.css">
    <link rel="stylesheet" href="../../Vendor/demo/demo.css">
    <script src="../../Vendor/jquery.min.js"></script>
    <script src="../../Vendor/jquery.easyui.min.js"></script>
    <!-- <link rel="stylesheet" href="../../Public/cssPuro/paracuadros.css"> -->
    <title>CARRITO DE COMPRA</title>
</head>
<body>
    <table id="dg" title="Administrador del carrito" class="easyui-datagrid" style="width:700px;height:600px" url="accion/listar_compraitem.php" toolbar="#toolbar" pagination="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idcompraitem" width="50">Id ítem</th>
                <th field="idproducto" width="50">Id producto</th>
                <th field="pronombre" width="50">Nombre producto</th>
                <th field="idcompra" width="50">Id compra</th>
                <th field="cicantidad" width="50">Cantidad comprada</th>
                
                
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editCantidad()">Editar cantidad</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Eliminar ítem</a>  
    </div>
    <div id="dlg" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="POST" novalidate style="margin:0,padding:20px 50px;">
    <h3>Pedido información</h3>
    <div style="margin-bottom:10px;">
        <input readonly  name="idcompraitem" id="idcompraitem" class="easyui-textbox" required="true" label="ITEM" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input readonly  name="idproducto" id="idproducto" class="easyui-textbox" required="true" label="ID PRODUCTO" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input  readonly name="pronombre" id="pronombre" class="easyui-textbox" required="true" label="PRODUCTO" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input readonly name="idcompra" id="idcompra" class="easyui-textbox" required="true" label="NUMERO DE PEDIDO" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">

        <input name="cicantidad" id="cicantidad" required="true" label="CANTIDAD" style="width:100%;">
        <p>Sólo puede modificar la cantidad</p>
    </div>
        
        
    </form>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarProducto()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script>
        var url;
        /*
        function newProducto(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo producto');
            $('#fm').form('clear');
            url='accion/insertar_producto.php';
        }
        */
        function editCantidad(){
            //dg es la tabla y getselect es el que esta seleccionado
            var row = $('#dg').datagrid('getSelected');
            if(row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar cantidad');
                //traerme el stock con el id de producto (desp del = pongo el valor que me venga de la funcion d ecantidad)
                document.getElementById('cicantidad').max =
                $('#fm').form('load', row);
                url='accion/editarCantidad.php?idcompraitem='+row.idcompraitem;
            }
        }
        function guardarProducto(){
            $('#fm').form('submit', {
                url:url,
                onSubmit:function(){
                    return $(this).form('validate');
                },
                success:function(result){
                    var result=eval('('+result+')');
                    //alert('Volvio servidor');
                    if(!result.respuesta){
                        $.messager.show({
                            title:'Error',
                            msg:result.errorMsg
                        });
                    }else{
                        $('#dlg').dialog('close');
                        $('#dg').datagrid('reload');
                    }
                }
            })
        }
        function destroyItem(){
            var row=$('#dg').datagrid('getSelected');
            if(row){
                $.messager.confirm('confirm', 'Seguro desea eliminar la compra?', function(r){
                    if(r){
                        $.post('accion/destroy_compraitem.php?idcompraitem='+row.idcompraitem,{idcompraitem:row.id}, function(result){
                            //alert('Volvio servidor');
                            if(result.respuesta){
                                $('#dg').datagrid('reload');
                            }else{
                                $.messager.show({
                                    title:'Error',
                                    msg:result.errorMsg
                                });
                            }
                        }, 'json');
                    }
                })
            }
        }


        function StockSuficiente(){
            //dg es la tabla y getselect es el que esta seleccionado
            var row = $('#dg').datagrid('getSelected');
            if(row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar cantidad');
                //traerme el stock con el id de producto
                $('#fm').form('load', row);
                url='accion/editarCantidad.php?idcompraitem='+row.idcompraitem;
            }
        }
    </script>
        
    </div>
</body>
</html>