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

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

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

    <script>
        window.setTimeout(function(){
            document.getElementById("botao").click();
        }, 1000);
    </script>

</head>

<body>


<div id="root">
    <?php
    include("menu_header.php");
    ?>
    <div class="main">

        <!-- MODAL DELETE COMANDA -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Deletar Usuário</h3>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <div class="controls">
                        <span><h3>Deseja realmente <b>deletar</b> o usuário <font color="red">{{clickedUsuario.nome}}</font></font>?</h3></span>
                    </div> <!-- /controls -->
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Não</button>
                <button data-dismiss="modal" aria-hidden="true" class="btn btn-primary"
                        @click="deleteUsuario(usuario); getReadUsuario();">Sim
                </button>
            </div>
        </div>
        <!-- FIM MODAL DELETE COMANDA -->


        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget ">
                            <div class="widget-header">
                                <i class="icon-user"></i>
                                <h3>NOVO USUÁRIO</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">


                                <div class="tabbable">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#jscontrols" data-toggle="tab">CONTAS</a>
                                        </li>
                                    </ul>

                                    <p class="alert alert-error" v-if="errorMessage">{{errorMessage}}</p>
                                    <p class="alert alert-success" v-if="successMessage">{{successMessage}}</p>

                                    <br>

                                    <div class="account-container register">

                                        <div class="content clearfix">

                                            <form id="apps" name="apps" @submit.prevent="validateBeforeSubmit"
                                                  ref="formsVue"
                                                  novalidate>

                                                <h1>Criar conta para Usuário</h1>

                                                <div class="login-fields">

                                                    <div class="field">
                                                        <label for="firstname">*Nome:</label>
                                                        <input type="text" id="firstname" name="Nome"
                                                               v-model="newUsuario.nome"
                                                               v-validate="'required|alpha_spaces|min:3'"
                                                               placeholder="Nome" class="login" />
                                                        <span v-show="errors.has('Nome')"
                                                              class="alert alert-error">{{ errors.first('Nome') }}</span>
                                                    </div> <!-- /field -->

                                                    <div class="field">
                                                        <label for="email">*Email:</label>
                                                        <input type="email" id="email" name="Email"
                                                               v-model="newUsuario.email"
                                                               v-validate="'required|email'"
                                                               placeholder="Email" class="login"/>
                                                        <span v-show="errors.has('Email')"
                                                              class="alert alert-error">{{ errors.first('Email') }}</span>
                                                    </div> <!-- /field -->

                                                    <div class="field">
                                                        <label for="password">*Senha:</label>
                                                        <input type="password" id="password" name="Senha"
                                                               v-model="newUsuario.senha"
                                                               v-validate="'required|min:3'"
                                                               placeholder="Senha" class="login"/>
                                                        <span v-show="errors.has('Senha')"
                                                              class="alert alert-error">{{ errors.first('Senha') }}</span>
                                                    </div> <!-- /field -->

                                                    <div class="field">
                                                        <label for="confirm_password">*Confirmação de Senha:</label>
                                                        <input type="password" id="confirm_password" name="Confirmação Senha"
                                                               v-model="newUsuario.conf_senha"
                                                               v-validate="'required|min:3'"
                                                               v-on:change="validaConfSenha()"
                                                               placeholder="Repita a Senha" class="login"/>
                                                        <span v-show="errors.has('Confirmação Senha')"
                                                              class="alert alert-error">{{ errors.first('Confirmação Senha') }}</span>
                                                    </div> <!-- /field -->
                                                </div> <!-- /login-fields -->
                                                    <br>
                                                <div class="login-actions">

                                                    <input type="button" id="botao" name="botao" @click="getReadUsuarios()" v-show="false">

                                                    <button class="button btn btn-primary btn-mini" @click="saveUsuario(); getReadUsuarios();" :disabled="!isValidSave">Criar</button>
                                                    <button class="button btn btn-danger btn-mini" @click="cancelarUsuario(); getReadUsuarios();">Cancelar</button>

                                                </div> <!-- .actions -->

                                            </form>

                                        </div> <!-- /content -->

                                    </div> <!-- /account-container -->

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="jscontrols">
                                            <form id="edit-profile" class="form-horizontal">

                                                <div class="control-group">
                                                    <label class="control-label" for="termo">Pesquisar </label> &nbsp;
                                                    <input type="text" class="span8" id="termo" name="termo"
                                                           placeholder="Buscar por Nome, Email, Código"
                                                           maxlength="100" v-model="newComanda.termo" @keydown.enter.stop.prevent="getBuscaIndexUsuario()">
                                                    <a href="javascript:;" class="btn btn-small btn-info" title="Buscar">
                                                        <i class="btn-icon-only icon-search" @click="getBuscaIndexUsuario(newUsuario.termo)"> </i></a>
                                                </div>

                                                <fieldset>
                                                    <div class="widget-content">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th> Cód.</th>
                                                                <th> Nome</th>
                                                                <th> Email</th>
                                                                <th> Data Cadastro</th>
                                                                <th class="td-actions"></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr v-for="user in usuarios">
                                                                <td> {{user.id}}</td>
                                                                <td> {{user.nome}}</td>
                                                                <td> {{user.email}}</td>
                                                                <td><b> {{user.data}}</b></td>
                                                                <td class="td-actions">
                                                                    <a href="javascript:;"
                                                                       class="btn btn-small btn-success"
                                                                       title="Editar Usuário"
                                                                       @click="selectUsuario(user); getReadUsuarios();">
                                                                        <i class="btn-icon-only icon-pencil"> </i>
                                                                    </a>

                                                                    <a href="#myModal" role="button"
                                                                       data-toggle="modal"
                                                                       class="btn btn-danger btn-small"
                                                                       @click="selectUsuario(user);"><i
                                                                                class="btn-icon-only icon-remove"
                                                                                title="Excluir Usuário"> </i></a>
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
                </div> <!-- /row -->
            </div> <!-- /container -->
        </div> <!-- /main-inner -->
    </div> <!-- /main -->
</div>

<?php include("rodape.php"); ?>

<script type="text/javascript" src="libs/vue.js"></script>
<script src="app/config.js"></script>
<script type="text/javascript" src="app/app.js"></script>

<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/base.js"></script>

</body>
</html>
