<?php
require_once('../templates/header2.php');
$objRolCon = new RolController();
try {
    $rol = $objSession->getUsRol();
    $rol = $objSession->getUsRol();
    if ($rol != '') {
        if ($rol == 'Admin') {
            $lista = $objRolCon->listarTodo();
        } elseif ($rol == 'Cliente' || $rol == 'Deposito') {
            $lista = [];
        }
    }
} catch (\Throwable $th) {
    $rol = '';
    $lista = []; //  ['idproducto' => '', 'pronombre' => '', 'sinopsis'=>'', 'procantstock'=>'', 'autor'=>'', 'precio'=>'', 'isbn'=>'', 'categoria'=>''];
}

?>
<!-- <!DOCTYPE html>
<html lang="en"> -->
<!-- <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Vendor/themes/default/easyui.css">
    <link rel="stylesheet" href="../../Vendor/themes/icon.css">
    <link rel="stylesheet" href="../../Vendor/themes/color.css">
    <link rel="stylesheet" href="../../Vendor/demo/demo.css">
    <script src="../../Vendor/jquery.min.js"></script>
    <script src="../../Vendor/jquery.easyui.min.js"></script>
    <title>Prueba isiUI</title>
</head> -->

<table id="dg" title="Administrador de Roles" class="easyui-datagrid" style="width:700px;height:600px" url="accion/listar_rol.php" toolbar="#toolbar" pagination="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="idrol" width="50">Id</th>
            <th field="rodescripcion" width="50">Descripción</th>
        </tr>
    </thead>
</table>
<div id="toolbar">
    <?php
    if ($rol == 'Admin') {
        echo "<a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" iconCls=\"icon-add\" plain=\"true\" onclick=\"newRol()\">Nuevo Rol</a>
                <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" iconCls=\"icon-edit\" plain=\"true\" onclick=\"editRol()\">Editar Rol</a>
                <a href=\"javascript:void(0)\" class=\"easyui-linkbutton\" iconCls=\"icon-remove\" plain=\"true\" onclick=\"destroyRol()\">Deshabilitar Rol</a>";
    }
    ?>
    <!-- <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newRol()">Nuevo Rol</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editRol()">Editar Rol</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyRol()">Deshabilitar Rol</a>  -->
</div>
<div id="dlg" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="POST" novalidate style="margin:0,padding:20px 50px;">
        <h3>Rol Información</h3>
        <!-- <div style="margin-bottom:10px;">
        <input name="idusuario" id="idusuario" class="easyui-textbox" required="true" label="Id usuario" style="width:100%;">
    </div> -->
        <div style="margin-bottom:10px;">
            <input name="rodescripcion" id="rodescripcion" class="easyui-textbox" required="true" label="Nombre" style="width:100%;">
        </div>
        <!-- <div style="margin-bottom:10px;">
        <input name="uspass" id="uspass" class="easyui-textbox" required="true" label="Password" style="width:100%;">
    </div>
    <div style="margin-bottom:10px;">
        <input name="usmail" id="usmail" class="easyui-textbox" required="true" label="Email" style="width:100%;">
    </div> -->


    </form>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarRol()" style="width:90px">Aceptar</a>
        <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script>
        var url;

        function newRol() {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo rol');
            $('#fm').form('clear');
            url = 'accion/insertar_rol.php';
        }

        function editRol() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar rol');
                $('#fm').form('load', row);
                url = 'accion/edit_rol.php?idrol=' + row.idrol;
            }
        }

        function guardarRol() {
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

        function destroyRol() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('confirm', 'Seguro desea eliminar el rol?', function(r) {
                    if (r) {
                        $.post('accion/destroy_rol.php?idrol=' + row.idrol, {
                            idrol: row.id
                        }, function(result) {
                            alert('Volvio servidor');
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