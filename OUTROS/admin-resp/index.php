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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.1/axios.min.js"></script>

    <!--VALIDATE-->
    <script src="https://cdn.jsdelivr.net/npm/vee-validate@2.0.9/dist/vee-validate.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/vee-validate/2.0.9/locale/pt_BR.js"></script>

    <!--MASK-->
    <script src="https://cdn.jsdelivr.net/npm/v-mask/dist/v-mask.min.js"></script>

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
                    <div class="span6">
                        <div class="widget widget-nopad">
                            <div class="widget-header"><i class="icon-list-alt"></i>
                                <h3> Informativos de Clientes, Carros, Orçamentos e Recibos</h3>
                            </div>
                            <!-- /widget-header -->
                            <div class="widget-content">
                                <div class="widget big-stats-container">
                                    <div class="widget-content">
                                        <div id="big_stats" class="cf">
                                            <div class="stat" title="Clientes Cadastrados"><i class="icon-group"></i>
                                                <span
                                                        class="value">{{countsCi}}</span>
                                            </div>

                                            <div class="stat" title="Carros Cadastrados"><i class="icon-truck"></i>
                                                <span
                                                        class="value">{{countsCa}}</span></div>

                                            <div class="stat" title="ORÇAMENTOS"><i class="icon-file"></i> <span
                                                        class="value">{{countsOr}}</span></div>

                                            <div class="stat" title="RECIBOS"><i class="icon-barcode"></i> <span
                                                        class="value">{{countsRe}}</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <div class="widget">
                            <div class="widget-header"><i class="icon-bookmark"></i>
                                <h3>Atalhos</h3>
                            </div>
                            <!-- /widget-header -->
                            <div class="widget-content">
                                <div class="shortcuts">

                                    <a href="clientes_all.php" class="shortcut"><i
                                                class="shortcut-icon icon-user"></i>
                                        <span class="shortcut-label">Todos os Clientes</span> </a>

                                    <a href="carros_all.php" class="shortcut"><i
                                                class="shortcut-icon icon-truck"
                                                @click="telaCarro=true; execut();"></i>
                                        <span class="shortcut-label">Todos os Carros</span> </a>

                                    <a href="javascript:;" class="shortcut"
                                       @click="comandaItem=true; getReadComandas()">
                                        <i class="shortcut-icon icon-file"></i>
                                        <span class="shortcut-label">Orçamento/Recibo</span> </a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--inicio -->
                    <div class="span12" v-if="comandaItem && editarComanda==false">
                        <div class="widget ">
                            <div class="widget-header">
                                <i class="icon-user"></i>
                                <h3>{{texto}}</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">


                                <div class="tabbable">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#jscontrols" data-toggle="tab">ORÇAMENTO/RECIBO</a>
                                        </li>
                                    </ul>

                                    <br>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="jscontrols">
                                            <form id="edit-profile" class="form-horizontal">

                                                <div class="control-group">
                                                    <label class="control-label" for="termo">Pesquisar </label> &nbsp;
                                                    <input type="text" class="span8" id="termo" name="termo"
                                                           placeholder="Buscar por Nome do cliente, Placa do Veículo, Nº Orçamento/Recibo, Tipo, Data"
                                                           maxlength="100" v-model="newComanda.termo" @keydown.enter.stop.prevent="getComandasTodosCampos()">
                                                    <a href="javascript:;" class="btn btn-small btn-info" title="Buscar">
                                                        <i class="btn-icon-only icon-search" @click="getComandasTodosCampos(newCliente.termo)"> </i></a>
                                                </div>

                                                <fieldset>

                                                    <a href="javascript:;" class="btn btn-small btn-primary"
                                                       @click="comandaItem=true; getReadFullComandas(); texto='TODAS AS COMANDAS'"><i
                                                                class="btn-icon-only  icon-asterisk"> </i>Todas Comandas</a>

                                                    <a href="javascript:;" class="btn btn-small btn-warning"
                                                       @click="comandaItem=true; getReadAbertaComandas(); texto='COMANDAS ABERTAS'"><i
                                                                class="btn-icon-only icon-folder-open"> </i>Comandas Abertas</a>

                                                    <a href="javascript:;" class="btn btn-small btn-success"
                                                       @click="comandaItem=true; getReadFechadaComandas(); texto='COMANDAS FECHADAS'"><i
                                                                class="btn-icon-only icon-folder-close"> </i>Comandas Fechadas</a>

                                                    <div class="widget-content">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th> N. Comanda</th>
                                                                <th> Cliente</th>
                                                                <th> Descrição do Serviço</th>
                                                                <th> Placa</th>
                                                                <th> Data</th>
                                                                <th> Vlr. Unitário</th>
                                                                <th> Obs</th>
                                                                <th> Tipo</th>
                                                                <th> Situação</th>
                                                                <th class="td-actions"></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr v-for="comanda in comandas">
                                                                <td> {{comanda.id}}</td>
                                                                <td> {{comanda.nome}}</td>
                                                                <td> {{comanda.descricao_servico}}</td>
                                                                <td> {{comanda.placa}}</td>
                                                                <td><b> {{comanda.data}}</b></td>
                                                                <td>R$ {{comanda.vlr_unt}}</td>
                                                                <td> {{comanda.obs}}</td>
                                                                <td> {{comanda.tipo}}</td>
                                                                <td> {{comanda.situacao}}</td>
                                                                <td class="td-actions">
                                                                    <a href="javascript:;"
                                                                       class="btn btn-small btn-success"
                                                                       title="Editar Item"
                                                                       @click="selectComanda(comanda);editarComanda=true; "><i
                                                                                class="btn-icon-only icon-pencil"> </i></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /widget-content -->
                        </div> <!-- /widget -->
                    </div> <!-- /span8 -->
                    <!--fim -->

                    <div id="render" v-if="comandaItem==false">
                    <div class="span12">
                        <form action="" method="get" id='form-contato' class="form-horizontal col-md-10">
                            <div class="control-group">
                                <label class="control-label" for="termo">Pesquisar </label> &nbsp;
                                <input type="text" class="span8" id="termo" name="termo"
                                       placeholder="Buscar por Nome, Cnpj/Cpf, Email, Placa, Nº Orçamento/Recibo"
                                       maxlength="100" v-model="newCliente.termo" @keydown.enter.stop.prevent="getBuscaIndexClient()">
                                <a href="javascript:;" class="btn btn-small btn-info" title="Buscar">
                                    <i class="btn-icon-only icon-search" @click="getBuscaIndexClient(newCliente.termo)"> </i></a>
                            </div>
                        </form>
                    </div>

                    <div class="span12">
                        <div class="widget widget-table action-table">
                            <div class="widget-header"><i class="icon-th-list"></i>
                                <h3>Últimos 5 Clientes</h3>
                            </div>
                            <div class="widget-content">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th> Cód.Cliente</th>
                                        <th> Cliente</th>
                                        <th> Cpf/Cnpj</th>
                                        <th> Tel/Cel</th>
                                        <th> Orçamento/Recibo</th>
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
                                        <td> {{cliente.id}}</td>
                                        <td> {{cliente.data}}</td>
                                        <td> {{cliente.placa}}</td>
                                        <td class="td-actions">

                                            <input type="text" v-model="cliente.id_cliente" v-show="false"/>

                                            <button @click="carregaIdCliente(cliente); getEnderecosIdCliente(); getCarrosIdCliente();" class="btn btn-small btn-success" title="Editar Cliente">
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
        <?php @include("teste.php") ?>
    </div>

    <?php @include("clientes_alter_full.php") ?>

</div>

<?php include("rodape.php"); ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.js"></script>
<script src="app/config.js"></script>
<script type="text/javascript" src="app/app.js"></script>
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>

</body>
</html>
