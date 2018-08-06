<?php include("constantes.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $TITLE ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
          rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/pages/dashboard.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--AXIOS-->
    <script type="text/javascript" src="libs/axios.min.js"></script>

    <!--VALIDATE-->
    <script src="libs/vee-validate.min.js"></script>
    <script type="text/javascript"
            src="libs/pt_BR.js"></script>

    <!--MASK-->
    <script src="libs/v-mask.min.js"></script>

</head>
<body>

<?php
include("menu_header.php");
?>

<div id="root">

    <div class="main" v-if="!varClienteFull">
        <div class="main-inner">
            <div class="container">
                <div class="row">

                    <div class="span12">
                        <form action="" method="get" id='form-contato' class="form-horizontal col-md-10">
                            <div class="control-group">
                                <label class="control-label" for="termo">Pesquisar </label> &nbsp;
                                <input type="text" class="span8" id="termo" name="termo"
                                       placeholder="Buscar por Nome, Cnpj/Cpf, Email, Placa, Nº Orçamento/Recibo"
                                       maxlength="100" v-model="newCliente.termo"
                                       @keydown.enter.stop.prevent="getBuscaIndexClient()">

                                <a href="javascript:;" class="btn btn-small btn-info" title="Buscar">
                                    <i class="btn-icon-only icon-search"
                                       @click="getBuscaIndexClient(newCliente.termo)"> </i></a>

                                <a href="javascript:;" class="btn btn-small btn-info" title="Todos os Clientes">
                                    <i class="btn-icon-only icon-search"
                                       @click="getClientes()"> Todos os Clientes</i></a>
                            </div>
                        </form>
                    </div>

                    <div class="span12">
                        <div class="widget widget-table action-table">
                            <div class="widget-header"><i class="icon-th-list"></i>
                                <h3>Clientes Cadastrados</h3>
                            </div>
                            <div class="widget-content">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th> Cód.Cliente</th>
                                        <th> Cliente</th>
                                        <th> Cpf/Cnpj</th>
                                        <th> Tel/Cel</th>
                                        <th> Data</th>
                                        <th> Placa do Carro</th>
                                        <th class="td-actions"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="cliente in clientes">
                                        <td> {{cliente.id_cliente}}</td>
                                        <td> {{cliente.nome}}</td>
                                        <td> {{cliente.cpf_cnpj}}</td>
                                        <td> {{cliente.tel}}/{{cliente.cel}}</td>
                                        <td> {{cliente.data}}</td>
                                        <td> {{cliente.placa}}</td>
                                        <td class="td-actions">

                                            <input type="text" v-model="cliente.id_cliente" v-show="false"/>

                                            <button @click="carregaIdCliente(cliente); getEnderecosIdCliente(); getCarrosIdCliente();"
                                                    class="btn btn-small btn-success" title="Editar Cliente">
                                                <i class="btn-icon-only icon-edit"></i></button>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php @include("clientes_alter_full.php") ?>

</div>

<?php include("rodape.php"); ?>

<script type="text/javascript" src="libs/vue.js"></script>
<script src="app/config.js"></script>
<script type="text/javascript" src="app/app.js"></script>
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>

</body>
</html>
