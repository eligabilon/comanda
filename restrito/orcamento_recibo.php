<?php include("constantes.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $TITLE ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">

    <link href="../css/style.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--AXIOS-->
    <script type="text/javascript" src="../libs/axios.min.js"></script>

    <!--VALIDATE-->
    <script src="../libs/vee-validate.min.js"></script>
    <script type="text/javascript"
            src="../libs/pt_BR.js"></script>

    <!--MASK-->
    <script src="../libs/v-mask.min.js"></script>
    <script src="../js/mascaraMoeda.js"></script>

</head>

<body>


<div id="root">
    <?php
    include("menu_header.php");
    ?>
    <div class="main">

        <!-- MODAL ITEM COMANDA -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Editar Item Comanda</h3>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <label class="control-label" for="cel">Qtd.</label>
                    <div class="controls">
                        <input type="text" class="span2" id="qtd"
                               v-model="clickedItemComanda.qtd"
                               placeholder="Qtd.">
                    </div> <!-- /controls -->
                </div>
                <div class="control-group">
                    <label class="control-label" for="cel">Descrição do Serviço</label>
                    <div class="controls">
                        <input type="text" class="span2" id="serv"
                               v-model="clickedItemComanda.descricao_servico"
                               placeholder="Descrição do Serviço">
                    </div> <!-- /controls -->
                </div>
                <div class="control-group">
                    <label class="control-label" for="cel">Vlr. Unt.</label>
                    <div class="controls">
                        <input type="text" class="span4" id="unt"
                               v-model="clickedItemComanda.vlr_unt"
                               placeholder="Valor Unitário">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
                <button data-dismiss="modal" aria-hidden="true" class="btn btn-primary"
                        @click="updateItemComanda(); getItemComandasIdCarro(); getTotalGeral();">Salvar
                </button>
            </div>
        </div>
        <!-- FIM MODAL ITEM COMANDA -->

            <div class="main-inner">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            <div class="widget ">
                                <div class="widget-header">
                                    <i class="icon-user"></i>
                                    <h3>NOVO ORÇAMENTO / RECIBO</h3>
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
                                                <fieldset>
                                                    <form id="edit-profile" class="form-horizontal" name="apps"
                                                          @submit.prevent="validateBeforeSubmit"
                                                          novalidate>
                                                        <div class="control-group">
                                                            <label class="control-label" for="firstname">Busque
                                                                pela Placa</label>
                                                            <div class="controls">
                                                                <input type="text" class="span6" id="cliente"
                                                                       name="Pesquisar Cliente"
                                                                       @keydown.enter.stop.prevent="getBuscaClientCarro(); selectCliente(newCliente);"
                                                                       v-model.lazy="newCliente.termo"
                                                                       placeholder="Digite a Placa do Veículo">

                                                                <a href="" class="btn btn-small btn-info"
                                                                   title="Pesquisar"
                                                                   :disabled="!isValidSave"
                                                                   @click.prevent="getBuscaClientCarro();orcamento=true;"><i
                                                                            class="btn-icon-only icon-search"> </i></a>

                                                                <a href="clientes.php" class="btn btn-small btn-warning"
                                                                   @click="clearObjs()"
                                                                   title="Adicionar Cliente"><i
                                                                            class="btn-icon-only icon-user"> </i></a>
                                                            </div> <!-- /controls -->
                                                        </div>

                                                        <div class="control-group">
                                                            <div class="controls">
                                                            <span v-show="errors.has('Pesquisar Cliente')"
                                                                  class="error">{{ errors.first('Pesquisar Cliente') }}</span>
                                                            </div>
                                                        </div>

                                                        <div id="confirma" v-for="cliente in clientes" v-if="orcamento">

                                                            <div class="control-group">
                                                                <label class="control-label">Situação da Comanda</label>
                                                                <div class="controls">
                                                                    <input type="input" class="span2 disabled"
                                                                           name="data"
                                                                           disabled v-model="situacaoComanda">
                                                                </div>    <!-- /controls -->
                                                            </div>

                                                            <div class="control-group">
                                                                <label class="control-label">Data</label>
                                                                <div class="controls">
                                                                    <input type="input" class="span2 disabled"
                                                                           name="data"
                                                                           disabled v-model="dataDia()">
                                                                </div>    <!-- /controls -->
                                                            </div> <!-- /control-group -->

                                                            <div class="control-group">
                                                                <label class="control-label">Cliente</label>
                                                                <div class="controls">
                                                                    <input type="text" class="span4 disabled"
                                                                           v-model="cliente.nome" disabled>
                                                                    <input type="text" class="span2 disabled"
                                                                           v-model="cliente.placa" disabled>
                                                                </div> <!-- /controls -->
                                                            </div> <!-- /control-group -->

                                                            <div class="control-group">
                                                                <label class="control-label">Tipo</label>
                                                                <div class="controls">
                                                                    <label class="radio inline">
                                                                        <input type="radio" name="comanda"
                                                                               value="ORÇAMENTO"
                                                                               v-model="radioButtonComanda"> ORÇAMENTO
                                                                    </label>

                                                                    <label class="radio inline">
                                                                        <input type="radio" name="comanda"
                                                                               value="RECIBO"
                                                                               v-model="radioButtonComanda"> RECIBO
                                                                    </label>
                                                                </div>    <!-- /controls -->
                                                            </div>

                                                            <div class="control-group">
                                                                <label class="control-label">Obs.</label>
                                                                <div class="controls">
                                                                        <textarea rows="2" cols="10" class="span7"
                                                                                  id="obs"
                                                                                  v-validate="'min:5|max:500'"
                                                                                  v-model.lazy="newComanda.obs"
                                                                                  placeholder="Observação sobre o veículo"></textarea>

                                                                    <a href="" class="btn btn-small btn-info" v-if="clickedComanda.id == null"
                                                                       title="Salvar Comanda"
                                                                       @click.prevent="saveComanda(); comandaItem=true;"><i
                                                                                class="btn-icon-only icon-save"> </i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <div id="item" v-if="comandaItem">
                                                        <form id="edit-comanda" class="form-horizontal" name="appsI"
                                                              @submit.prevent="validateBeforeSubmit"
                                                              novalidate>

                                                            <div class="control-group">
                                                                <label class="control-label"
                                                                       for="firstname">Serviço</label>
                                                                <div class="controls">
                                                                    <input type="text" class="span2" id="qtd"
                                                                           name="Qtd"
                                                                           v-validate="'required'"
                                                                           v-mask="'#####'"
                                                                           v-model="newItemComanda.qtd"
                                                                           placeholder="Quantidade">

                                                                    <input type="text" class="span4"
                                                                           id="descricao_servico"
                                                                           name="Descrição Serviço"
                                                                           v-model="newItemComanda.descricao_servico"
                                                                           v-validate="'required'"
                                                                           placeholder="Descrição do Serviço">


                                                                    <div class="input-prepend input-append">
                                                                        <span class="add-on">R$</span>
                                                                        <input class="span2" id="vlr_unitario"
                                                                               type="text"
                                                                               name="Vlr Unt"
                                                                               v-model="newItemComanda.vlr_unt"
                                                                               v-validate="'required'"
                                                                               title="Valor Unitário">

                                                                        <a href=""
                                                                           class="btn btn-small btn-success"
                                                                           title="Adicionar"
                                                                           @click.prevent="saveComandaItem(); selectItemComanda(clickedItemComanda);"><i
                                                                                    class="btn-icon-only icon-plus"> </i></a>
                                                                    </div>
                                                                </div> <!-- /controls -->
                                                            </div> <!-- /control-group -->

                                                            <div class="widget-content">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th> Qtd</th>
                                                                        <th> Descrição do Serviço</th>
                                                                        <th> Vlr. Unitário</th>
                                                                        <th> Vlr. Total</th>
                                                                        <th class="td-actions"></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr v-for="item in itemComandas">
                                                                        <td> {{item.qtd}}</td>
                                                                        <td> {{item.descricao_servico}}</td>
                                                                        <td>R$ {{numberToReal(item.vlr_unt)}}</td>
                                                                        <td>R$ {{numberToReal(item.qtd * item.vlr_unt)}}</td>
                                                                        <td class="td-actions">
                                                                            <a href="#myModal" role="button"
                                                                               data-toggle="modal"
                                                                               class="btn btn-small btn-success"
                                                                               @click="selectItemComanda(item);"><i
                                                                                        class="btn-icon-only icon-pencil"
                                                                                        title="Editar Item"> </i></a>

                                                                            <a href="javascript:;"
                                                                               class="btn btn-danger btn-small"
                                                                               @click="deleteItemComanda(item); selectItemComanda(item);"><i
                                                                                        class="btn-icon-only icon-remove"
                                                                                        title="Excluir Item"> </i></a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><b> Total Geral:</b></td>
                                                                        <td><b>R$ {{numberToReal(totalGeral)}}</b></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </form>

                                                        <div class="form-actions">
                                                            <a href="javascript:;" class="btn btn-primary">
                                                                <i class="btn-icon-only icon-print"
                                                                   @click="selectComanda(clickedComanda); getimprimirOrcamentoRecibo();"
                                                                   title="Imprimir Orçamento/Recibo"> Imprimir </i>
                                                            </a> Ao Imprimir a Comanda será fechada.
                                                        </div> <!-- /form-actions -->
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- /widget-content -->
                            </div> <!-- /widget -->
                        </div> <!-- /span8 -->
                    </div> <!-- /row -->
                </div> <!-- /container -->
            </div> <!-- /main-inner -->
        </div> <!-- /main -->

        <?php include("rodape.php"); ?>
    </div>

    <script type="text/javascript" src="../libs/vue.js"></script>
    <script src="../app/config.js"></script>
    <script type="text/javascript" src="../app/app.js"></script>

    <script src="../js/jquery-1.7.2.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/base.js"></script>

</body>
</html>
