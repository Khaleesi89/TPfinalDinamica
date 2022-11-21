<?php
require_once('../../config.php');
//Hacer controlador de menu y traer todos los menues
/* $objUsuCon = new UsuarioController();
$objUsuRolCon = new UsuarioRolController();
$arrayRoles = $objUsuRolCon->getRoles();
$lista = $objUsuCon->listarTodo(); */
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
    <title>ABM Menu</title>
</head>

<body>
    <table id="dg" title="Administrador de Menúes" class="easyui-datagrid" style="width:700px;height:600px" url="accion/listar_menu.php" toolbar="#toolbar" pagination="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idmenu" width="50">Id</th>
                <th field="menombre" width="50">Nombre</th>
                <th field="medescripcion" width="50">Descripción</th>
                <th field="idpadre" width="50">Menu Padre</th>
                <th field="medeshabilitado" width="50">Fecha Deshabilitado</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newMenu()">Nuevo Menú</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editMenu()">Editar Menú</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyMenu()">Deshabilitar Menú</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="newRol()">Ver Roles</a>
    </div>
    <div id="dlg" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="POST" novalidate style="margin:0,padding:20px 50px;">
            <h3>Menú Información</h3>
            <!-- <div style="margin-bottom:10px;">
        <input name="idusuario" id="idusuario" class="easyui-textbox" required="true" label="Id usuario" style="width:100%;">
    </div> -->
            <div style="margin-bottom:10px;">
                <input name="menombre" id="menombre" class="easyui-textbox" required="true" label="Nombre" style="width:100%;">
            </div>
            <div style="margin-bottom:10px;">
                <input name="medescripcion" id="medescripcion" class="easyui-textbox" required="true" label="Descripcion" style="width:100%;">
            </div>
            <!-- Hacer combobox de menues -->
            <!-- <div style="margin-bottom:10px;">
                <input name="usmail" id="usmail" class="easyui-textbox" required="true" label="Email" style="width:100%;">
            </div> -->


        </form>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarMenu()" style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
        </div>
        <!--MODAL FORMULARIO DE ROLES-->
        <div id="dlg1" class="easyui-dialog" style="width:600px;" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg1-buttons'">
            <form id="fm1" method="POST" novalidate style="margin:0,padding:20px 50px;" enctype="multipart/form-data">
                <h3>Información de Roles</h3>
                <!-- <div style="margin-bottom:10px;">
        <input name="idusuario" id="idusuario" class="easyui-textbox" required="true" label="Id usuario" style="width:100%;">
    </div> 

    ARMAR LA RESPUESTA DE LOS ROLES-->
                <?php
                $stringArr = "<script>let arrayF = [";
                foreach ($arrayRoles as $key => $value) {
                    $texto = $value->dameDatos();
                    $id = $texto['idrol'];
                    $rodescripcion = $texto['rodescripcion'];
                    $value = 'true';
                    echo "<div style=\"margin-bottom:20px\">
            <label for=\"$id\" class=\"textbox-label\">$rodescripcion:</label>
            <input id=rol$id type=\"checkbox\" name=\"rol$id\">
        </div>";
                    $stringArr.="'rol$id',";
                }
                $stringArr = substr($stringArr, 0, -1);
                $stringArr .= '];</script>';
                echo $stringArr;
                ?>


            </form>
            <div id="dlg1-buttons">
                <a href="javascript:void(0)" class="easyui-button c6" iconCls="icon-ok" onclick="guardarRoles()" style="width:90px">Aceptar</a>
                <a href="javascript:void(0)" class="easyui-button" iconCls="icon-cancel" onclick="javascript:$('#dlg1').dialog('close')" style="width:90px">Cancelar</a>
            </div>


            <script>
                var url;
                var urlr;
                var datos;
                var arralgo;
                var arrkeys;
                var algo;

                function newMenu() {
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Nuevo Menu');
                    $('#fm').form('clear');
                    url = 'accion/insertar_menu.php';
                }

                function cargarDatos(datos){
                    arralgo = Object.values(datos.data);
                    arrkeys = Object.keys(datos.data);
                    for (key in arrkeys){
                        algo = arrkeys[key];
                        //console.log(arralgo[key]);
                        if(arralgo[key] == 'true'){
                            document.getElementById(algo).click();
                        }
                    }
                }

                function newRol() {
                    var row = $('#dg').datagrid('getSelected');
                    if (row) {
                        urlr = row.idmenu;
                        $('#dlg1').dialog('open').dialog('center').dialog('setTitle', 'Roles');
                        $('#fm1').form('clear');
                        $('#fm1').form('load', 'accion/roles_menu?idmenu=' + row.idmenu);
                        datos = fetch('accion/roles_menu?idmenuo=' + row.idmenu, {
                            method: "POST",
                            body: JSON.stringify(datos),
                            headers: {
                                "Content-Type": "application/json"
                            }
                        }).then((e) => {
                            return e.json();
                        }).then(data => {
                            cargarDatos(data);
                        });
                                                
                    }

                }

                function guardarRoles() {
                    $('#fm1').form('submit', {
                        url: 'accion/guardar_roles.php?idmenu='+urlr,
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
                            }
                        }
                    })
                }

                function editMenu() {
                    var row = $('#dg').datagrid('getSelected');
                    if (row) {
                        $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Editar Menu');
                        $('#fm').form('load', row);
                        url = 'accion/edit_menu.php?idmenu=' + row.idmenu;
                    }
                }

                function guardarMenu() {
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

                function destroyMenu() {
                    var row = $('#dg').datagrid('getSelected');
                    if (row) {
                        $.messager.confirm('confirm', 'Seguro desea deshabilitar el menu?', function(r) {
                            if (r) {
                                $.post('accion/destroy_menu.php?idmenu=' + row.idmenu, {
                                    idusuario: row.id
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