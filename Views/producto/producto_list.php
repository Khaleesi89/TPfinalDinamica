<?php
require_once('../templates/header2.php');
$objConPro = new ProductoController();
$arrBuPro = [];
//var_dump($_SESSION);
/* try {
    $rol = $objSession->getUsRol();
    $rol = $objSession->getUsRol();
    if ($rol != '') {
        if ($rol == 'Admin' || $rol == 'Deposito') {

            $lista = $objConPro->listarTodo($arrBuPro);
        } elseif ($rol == 'Cliente') {
            $arrBuPro['prdeshabilitado'] = NULL;
            $lista = $objConPro->listarTodo($arrBuPro);
        }
    }
} catch (\Throwable $th) {
    $rol = '';
    $lista = []; //  ['idproducto' => '', 'pronombre' => '', 'sinopsis'=>'', 'procantstock'=>'', 'autor'=>'', 'precio'=>'', 'isbn'=>'', 'categoria'=>''];
} */
?>

<table id="dg" title="Productos" class="easyui-datagrid" style="width:700px;height:600px" url="accion/listar_producto.php" toolbar="#toolbar" pagination="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="idproducto" width="30">Id producto</th>
            <th field="pronombre" width="50">Nombre producto</th>
            <th field="sinopsis" width="50">Sinopsis</th>
            <th field="procantstock" width="50">Stock</th>
            <th field="autor" width="50">Autor</th>
            <th field="precio" width="50">Precio</th>
            <th field="isbn" width="50">ISBN</th>
            <th field="categoria" width="50">Categoría</th>
        </tr>
    </thead>
</table>
<div id="toolbar">
    <?php
    if ($rol == 'Admin' || $rol == 'Deposito') {
        echo "<a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" iconCls=\"icon-add\" plain=\"true\" onclick=\"newProducto()\">Nuevo producto</a>
                <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" iconCls=\"icon-edit\" plain=\"true\" onclick=\"editProducto()\">Editar producto</a>
                <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" iconCls=\"icon-remove\" plain=\"true\" onclick=\"destroyProducto()\">Eliminar producto</a>";
    } elseif ($rol == 'Cliente') {
        echo "<a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" iconCls=\"icon-remove\" plain=\"true\" onclick=\"comprar()\">Comprar</a>";
    }
    ?>
    <!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newProducto()">Nuevo producto</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editProducto()">Editar producto</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyProducto()">Eliminar producto</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="comprar()">Comprar</a> -->
</div>
<div id="dlg" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="POST" novalidate style="margin:0;padding:20px 50px;">
        <h3>Producto información</h3>
        <div style="margin-bottom:10px;">
            <input name="pronombre" id="pronombre" class="easyui-textbox" required="true" label="Nombre" style="width:100%;">
        </div>
        <div style="margin-bottom:10px;">
            <input name="sinopsis" id="sinopsis" class="easyui-textbox" required="true" label="Sinopsis" style="width:100%;">
        </div>
        <div style="margin-bottom:10px;">
            <input name="procantstock" id="procantstock" class="easyui-textbox" required="true" label="Stock" style="width:100%;">
        </div>
        <div style="margin-bottom:10px;">
            <input name="autor" id="autor" class="easyui-textbox" required="true" label="Autor" style="width:100%;">
        </div>
        <div style="margin-bottom:10px;">
            <input name="precio" id="precio" class="easyui-textbox" required="true" label="Precio" style="width:100%;">
        </div>
        <div style="margin-bottom:10px;">
            <input name="isbn" id="isbn" class="easyui-textbox" required="true" label="ISBN" style="width:100%;">
        </div>
        <div style="margin-bottom:10px;">
            <input name="categoria" id="categoria" class="easyui-textbox" required="true" label="Categoria" style="width:100%;">
        </div>


    </form>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarProducto()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    <!-- Formulario de compra -->
    <div id="dlg1" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg1-buttons'">
        <form id="fm1" method="POST" novalidate style="margin:0;padding:20px 50px;">
            <h3>Producto información</h3>
            <div style="margin-bottom:10px;">
                <input name="pronombre" id="pronombre" class="easyui-textbox" required="true" label="Nombre" style="width:100%;" readonly>
            </div>
            <div style="margin-bottom:10px;">
                <input name="sinopsis" id="sinopsis" class="easyui-textbox" required="true" label="Sinopsis" style="width:100%;" readonly>
            </div>
            <div style="margin-bottom:10px;">
                <input name="procantstock" id="procantstock" class="easyui-textbox" required="true" label="Stock" style="width:100%;" readonly>
            </div>
            <div style="margin-bottom:10px;">
                <input name="autor" id="autor" class="easyui-textbox" required="true" label="Autor" style="width:100%;" readonly>
            </div>
            <div style="margin-bottom:10px;">
                <input name="precio" id="precio" class="easyui-textbox" required="true" label="Precio" style="width:100%;" readonly>
            </div>
            <div style="margin-bottom:10px;">
                <input name="isbn" id="isbn" class="easyui-textbox" required="true" label="ISBN" style="width:100%;" readonly>
            </div>
            <div style="margin-bottom:10px;">
                <input name="categoria" id="categoria" class="easyui-textbox" required="true" label="Categoria" style="width:100%;" readonly>
            </div>
            <!-- Input de la cantidad a comprar -->

            <!-- <div style="margin-bottom:20px">
                    <input class="easyui-numberbox" min="0" max="5" name="cicantidad" required="true" id="cicantidad" style="width:100%;">
                </div> -->
            <div style="margin-bottom:10px;margin-top:15px;">
                <label for="cicantidad" style="width:20%; display:inline;">Cantidad a comprar:</label>
                <input type="number" name="cicantidad" id="cicantidad" class="easyui-number" label="Cantidad de compra:" required="true" style="width:60%;display:inline;" min="1">
            </div>
        </form>
        <div id="dlg1-buttons">
            <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarCompra()" style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
        </div>
        <script>
            var url;
            var number = document.getElementById('cicantidad');
            var cantStock;

            function newProducto() {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo producto');
                $('#fm').form('clear');
                url = 'accion/insertar_producto.php';
            }

            function editProducto() {
                var row = $('#dg').datagrid('getSelected');
                if (row) {
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar producto');
                    $('#fm').form('load', row);
                    url = 'accion/edit_producto.php?idproducto=' + row.idproducto;
                }
            }

            function guardarProducto() {
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

            function comprar() {
                var row = $('#dg').datagrid('getSelected');
                if (row) {
                    $('#dlg1').dialog('open').dialog('center').dialog('setTitle', 'Comprar');
                    cantStock = row.procantstock;
                    //data-options
                    //label:'Cantidad a comprar:',labelPosition:'top', min:0
                    document.getElementById('cicantidad').max = cantStock;
                    /* $('#cicantidad').data-options({
                        "label": 'Cantidad a comprar:',
                        "labelPosition": 'left',
                        "max": cantStock, // substitute your own
                        "min": 0 // values (or variables) here
                    }); */
                    console.log(cantStock);
                    //document.getElementById('cicantidad').max = cantStock;
                    $('#fm1').form('load', row);
                    url = 'accion/edit_stock.php?idproducto=' + row.idproducto;
                }
            }

            function guardarCompra() {
                $('#fm1').form('submit', {
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
                            $('#dlg1').dialog('close');
                            $('#dg').datagrid('reload');
                        }
                    }
                })
            }

            function destroyProducto() {
                var row = $('#dg').datagrid('getSelected');
                if (row) {
                    $.messager.confirm('confirm', 'Seguro desea eliminar el producto?', function(r) {
                        if (r) {
                            $.post('accion/destroy_producto.php?idproducto=' + row.idproducto, {
                                idproducto: row.id
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
    </div>
    <?php require_once('../templates/footer.php') ?>
    </body>
    </html>