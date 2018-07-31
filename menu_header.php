<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                        class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a
                    class="brand" href="index.php"><?= $SUB_TITLE ?></a>
        </div>
    </div>
</div>
<div class="subnavbar">
    <div class="subnavbar-inner">
        <div class="container">
            <ul class="mainnav">
                <li class="active"><a href="index.php"><i class="icon-dashboard"></i><span>INÍCIO</span> </a></li>
                <li><a href="clientes.php"><i class="icon-group"></i><span>CADASTRAR CLIENTES</span> </a></li>
                <li><a href="orcamento_recibo.php"><i class="icon-file"></i><span>CADASTRAR ORÇAMENTO/RECIBO</span> </a></li>
                <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-print"></i><span>RELATÓRIOS</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:;" @click="getImprimirRelatorioClean()">Orçamento/Recibo Manual</a></li>
                        <li><a href="javascript:;" @click="comandaItem=true; getReadComandas();">Orçamento/Recibo Automático</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>