<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../css/styleRequired.css" rel="stylesheet">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../../libs/adm_lte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../libs/adm_lte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../libs/adm_lte/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../libs/adm_lte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../libs/adm_lte/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../../libs/adm_lte/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../../libs/adm_lte/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet"
          href="../../libs/adm_lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../libs/adm_lte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet"
          href="../../libs/adm_lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!--AXIOS-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.1/axios.min.js"></script>
    <!--VALIDATE-->
    <script src="https://cdn.jsdelivr.net/npm/vee-validate@2.0.9/dist/vee-validate.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/vee-validate/2.0.9/locale/pt_BR.js"></script>
    <!--MASK-->
    <script src="https://cdn.jsdelivr.net/npm/v-mask/dist/v-mask.min.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div id="root">
    <div class="wrapper">

        <!--COMECO MODAL -->
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
             v-if="showingdeleteModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span
                                    aria-hidden="true" @click="showingdeleteModal = false;">&times;</span>
                        </button>
                        <h4 class="modal-title" id="modalLabel">Excluir</h4>
                    </div>
                    <div class="modal-body">
                        Deseja realmente excluir a escolaridade?
                        <h5 class="modal-header">{{clickedEscolaridade.escolaridade}}</h5>
                    </div>
                    <div class="modal-footer">
                        <button id="idSim" class="btn btn-danger btn-sm" name="modR"
                                @click="showingdeleteModal = false; deleteEscolaridade()"
                                data-toggle="modal" data-target="#delete-modal">Sim
                        </button>
                        <button class="btn btn-default" data-dismiss="modal"
                                @click="showingdeleteModal = false;">N&atilde;o
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--FIM MODAL-->

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Formulário -
                    Cadastro de Escolaridade
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-mortar-board"></i> Nova Escolaridade</a></li>
                    <li class="active">Cadastro de Escolaridade</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <!--EDICAO-->
                <div class="box" v-if="editarEscolaridade">
                    <form id="apps" @submit.prevent="validateBeforeSubmit" ref="formsVue" novalidate>
                        <fieldset>
                            <div class="form-group">
                                <label for="escolaridade">Editar Escolaridade</label>

                                <input type="text" name="Escolaridade" placeholder="Informe o Grau de Escolaridade"
                                       class="form-control"
                                       v-model="clickedEscolaridade.escolaridade"
                                       v-validate="'required|min:3'"
                                       v-on:keydown.right="getCountEscolaridade()">
                                <span v-show="errors.has('Escolaridade')"
                                      class="msg-erro msg-nome">{{ errors.first('Escolaridade') }}</span>
                            </div>

                            <button class="btn btn-primary" @click="updateEscolaridade(); editarEscolaridade = false" :disabled="isValidUpdate">Salvar</button>

                            <button class="btn btn-danger" @click="editarEscolaridade = false; clearInput(); getAllEscolaridades()">Cancelar Edição</button>
                        </fieldset>
                    </form>
                </div>
                <!--FIM EDICAO-->

                <!--INSERCAO-->
                <div class="box" v-else>
                    <form id="apps" @submit.prevent="validateBeforeSubmit" ref="formsVue" novalidate>
                        <fieldset>
                            <div class="form-group">
                                <label for="escolaridade">Nova Escolaridade</label>

                                <input type="text" name="Escolaridade" placeholder="Informe o Grau de Escolaridade"
                                       class="form-control"
                                       v-model="newEscolaridade.escolaridade"
                                       v-validate="'required|min:3'"
                                       v-on:change="getCountEscolaridade()">
                                <span v-show="errors.has('Escolaridade')"
                                      class="msg-erro msg-nome">{{ errors.first('Escolaridade') }}</span>
                            </div>

                            <button class="btn btn-primary" @click="saveEscolaridade(); editarEscolaridade = false" :disabled="!isValidSave">Inserir</button>

                            <button class="btn btn-danger" @click="editarEscolaridade = false; clearInput(); getAllEscolaridades()">Cancelar</button>
                        </fieldset>
                    </form>
                </div>
                <!--FIM INSERCAO-->

                <p class="alert alert-danger" role="alert" v-if="errorMessage" v-on:click="clearMessage()">{{errorMessage}}</p>
                <p class="alert alert-success" role="alert" v-if="successMessage" v-on:click="clearMessage()">{{successMessage}}</p>

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Escolaridade</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="escola in escolaridades">
                            <td>{{escola.id}}</td>
                            <td>{{escola.escolaridade}}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" title="Editar" @click.self="editarEscolaridade = true; selectEscolaridade(escola)"><span
                                            class="glyphicon glyphicon-pencil"></span></button>
                                <button class="btn btn-danger link_exclusao btn-sm"
                                        data-toggle="modal" data-target="#delete-modal"
                                        @click="selectEscolaridade(escola); showingdeleteModal = true"
                                        title="Excluir"><span class="glyphicon glyphicon-floppy-remove"></span></button>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- rodapé do sistema -->
    </div>
</div>

<!-- VUE -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.js"></script>
<!-- SISTEMA -->
<script src="config.js"></script>
<script type="text/javascript" src="app_escolaridade.js"></script>

<!-- jQuery 3 -->
<script src="../../libs/adm_lte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../libs/adm_lte/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 3.3.7 -->
<script src="../../libs/adm_lte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../libs/adm_lte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../libs/adm_lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../../libs/adm_lte/bower_components/raphael/raphael.min.js"></script>
<script src="../../libs/adm_lte/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../../libs/adm_lte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- daterangepicker -->
<script src="../../libs/adm_lte/bower_components/moment/min/moment.min.js"></script>
<script src="../../libs/adm_lte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Slimscroll -->
<script src="../../libs/adm_lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="../../libs/adm_lte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../libs/adm_lte/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../libs/adm_lte/dist/js/demo.js"></script>
<!-- page script -->
<script>
    $(function () {
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            "scrollY": 200,
            "scrollX": true
        })
    })
</script>

</body>
</html>
