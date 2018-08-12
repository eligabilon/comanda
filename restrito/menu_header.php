<?php include('sessao.php');?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                        class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a
                    class="brand" href="dashboard.php"><?= $SUB_TITLE ?></a>

            <div class="nav-collapse">
                <ul class="nav pull-right">
                    <li class="dropdown"><a href="logout.php" class="dropdown-toggle">Bem vindo <u><?=$_SESSION['nome']?></u> | <i
                                    class="icon-eye-close"></i><b>  Sair </b></a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
<div class="subnavbar">
    <div class="subnavbar-inner">
        <div class="container">
            <ul class="mainnav">
                <li class="active"><a href="dashboard.php"><i class="icon-dashboard"></i><span>INÍCIO</span> </a></li>
                <li><a href="usuario.php"><i class="icon-user"></i><span>CADASTRAR USUÁRIO</span> </a></li>
                <li><a href="clientes.php"><i class="icon-group"></i><span>CADASTRAR CLIENTES</span> </a></li>
                <li><a href="orcamento_recibo.php"><i class="icon-file"></i><span>CRIAR ORÇAMENTO/RECIBO</span> </a></li>
                <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-print"></i><span>RELATÓRIOS</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
<!--                        <li><a href="javascript:;" @click="getImprimirRelatorioManual()">Orçamento/Recibo Manual</a></li>-->
                        <li><a href="javascript:;" @click="getImprimirRelatorioClean()">Orçamento/Recibo Limpo</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>