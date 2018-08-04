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
</head>

<body>


<div id="root">
    <?php
    include("menu_header.php");
    ?>
    <div class="main" v-if="!varClienteFull">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget ">
                            <div class="widget-header">
                                <i class="icon-user"></i>
                                <h3>NOVO CLIENTE</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">


                                <div class="tabbable">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#jscontrols" data-toggle="tab">FORMULÁRIO</a>
                                        </li>
                                    </ul>

                                    <br>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="jscontrols">
                                            <form id="apps" name="apps" @submit.prevent="validateBeforeSubmit"
                                                  ref="formsVue"
                                                  novalidate>
                                                <fieldset>

                                                    <div class="control-group">
                                                        <label class="control-label" for="firstname">Nome</label>
                                                        <div class="controls">
                                                            <input type="text" class="span6" name="Nome" id="nome"
                                                                   v-model="newCliente.nome"
                                                                   v-validate="'required|alpha_spaces|min:3'"
                                                                   placeholder="Nome do Cliente">
                                                            <span v-show="errors.has('Nome')"
                                                                  class="error">{{ errors.first('Nome') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="email">Email</label>
                                                        <div class="controls">
                                                            <input type="email" class="span4" id="email" name="Email"
                                                                   v-model="newCliente.email"
                                                                   v-validate="'email|min:6'"
                                                                   placeholder="email@gmail.com">
                                                            <span v-show="errors.has('Email')"
                                                                  class="error">{{ errors.first('Email') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">

                                                        <div class="alert alert-error" v-if="errorMessage">
                                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                            <strong>{{errorMessage}}</strong>
                                                        </div>

                                                        <label class="control-label" for="cpf_cnpj">Cpf/Cnpj</label>
                                                        <div class="controls">
                                                            <input type="text" class="span4"
                                                                   name="cpf_cnpj"
                                                                   id="cpf_cnpj"
                                                                   v-on:change="validarCpfCnpj()"
                                                                   v-mask="'################'"
                                                                   v-model="newCliente.cpf_cnpj"
                                                                   placeholder="Cpf ou Cnpj">
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="insc_estadual">Insc.
                                                            Estadual</label>
                                                        <div class="controls">
                                                            <input type="text" class="span4" name="Insc. Estadual"
                                                                   v-mask="'################'"
                                                                   id="insc_estadual"
                                                                   maxlength="20"
                                                                   v-model="newCliente.insc_estadual"
                                                                   placeholder="Incrição Estadual">
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="tel">Telefone</label>
                                                        <div class="controls">
                                                            <input type="text" class="span4" name="Telefone" id="tel"
                                                                   v-model="newCliente.tel"
                                                                   v-mask="'(##) #####-####'"
                                                                   placeholder="(67) 3333-3333">
                                                            <span v-show="errors.has('Telefone')"
                                                                  class="error">{{ errors.first('Telefone') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="cel">Celular</label>
                                                        <div class="controls">
                                                            <input type="text" class="span4" name="Celular" id="cel"
                                                                   v-model="newCliente.cel"
                                                                   v-mask="'(##) #####-####'"
                                                                   placeholder="(67) 99999-9999">
                                                        </div>
                                                    </div>

                                                    <br/>

                                                    <div class="form-actions">
                                                        <button class="btn btn-primary"
                                                                @click="selectCliente(newCliente); saveCliente();"
                                                                :disabled="!isValidSave">
                                                            Salvar
                                                        </button>
                                                        <button class="btn">Cancelar</button>
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

    <?php include("clientes_alter_full.php") ?>

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
