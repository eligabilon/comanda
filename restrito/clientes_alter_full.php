<div class="main" v-if="varClienteFull">

    <div class="alert alert-error" v-if="errorMessage">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{errorMessage}}</strong>
    </div>

    <div class="alert alert-success" v-if="successMessage">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{successMessage}}</strong>
    </div>


    <!-- MODAL EDITAR ENDERECO -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Editar Endereço</h3>
        </div>
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label" for="cel">Local
                    Endereço</label>
                <div class="controls">
                    <input type="text" class="span2" id="local"
                           v-model="clickedEndereco.tipo_endereco"
                           maxlength="50"
                           placeholder="Minha Casa, Serviço, etc.">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="cel">Cep</label>
                <div class="controls">
                    <input type="text" class="span2" id="cep"
                           v-model="clickedEndereco.cep"
                           v-validate="'number'"
                           v-mask="'#####-###'"
                           placeholder="79090-000">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="insc_estadual">Rua</label>
                <div class="controls">
                    <input type="text" class="span4" id="rua"
                           v-validate="'required'"
                           v-model="clickedEndereco.rua"
                           maxlength="500"
                           placeholder="Rua Iria Loureiro">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="tel">Número</label>
                <div class="controls">
                    <input type="text" class="span1" id="num"
                           v-validate="'number'"
                           v-mask="'#####'"
                           maxlength="5"
                           v-model="clickedEndereco.numero"
                           placeholder="206">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="cel">Bairro</label>
                <div class="controls">
                    <input type="text" class="span4" id="bairro"
                           v-model="clickedEndereco.bairro"
                           maxlength="250"
                           placeholder="Centro">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="cel">Cidade</label>
                <div class="controls">
                    <input type="text" class="span4" id="cidade"
                           v-model="clickedEndereco.cidade"
                           maxlength="100"
                           placeholder="Campo Grande">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="cel">Estado</label>
                <div class="controls">
                    <input type="text" class="span1" id="estado"
                           v-model="clickedEndereco.estado"
                           maxlength="2"
                           placeholder="MS">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
            <button data-dismiss="modal" aria-hidden="true" class="btn btn-primary" @click="updateEndereco(); getEnderecosIdCliente();">Salvar</button>
        </div>
    </div>
    <!-- FIM MODAL ENDERECO -->

    <!-- MODAL EDITAR CARRO -->
    <div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Editar Carro</h3>
        </div>
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label" for="cel">Placa</label>
                <div class="controls">
                    <input type="text" class="span2" id="placa"
                           v-model="clickedCarro.placa"
                           placeholder="Placa do Veículo">
                </div> <!-- /controls -->
            </div>
            <div class="control-group">
                <label class="control-label" for="cel">Marca</label>
                <div class="controls">
                    <input type="text" class="span2" id="marca"
                           v-model="clickedCarro.marca"
                           placeholder="Marca do Veículo">
                </div> <!-- /controls -->
            </div>
            <div class="control-group">
                <label class="control-label" for="cel">Modelo</label>
                <div class="controls">
                    <input type="text" class="span4" id="modelo"
                           v-model="clickedCarro.modelo"
                           placeholder="Modelo do Veículo">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="cel">Obs.</label>
                <div class="controls">
                  <textarea rows="5" cols="10" class="span4"
                            v-model="clickedCarro.obs"
                            id="obs"
                            placeholder="Campo para alguma observação sobre o cliente."></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
            <button data-dismiss="modal" aria-hidden="true" class="btn btn-primary"
                    @click="updateCarro(); getCarrosIdCliente();">Salvar
            </button>
        </div>
    </div>
    <!-- FIM MODAL CARRO -->

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
                                        <form id="apps" @submit.prevent="validateBeforeSubmit" ref="formsVue"
                                              novalidate>
                                            <fieldset>

                                                <div class="control-group">
                                                        <label class="control-label">Cód. Cliente</label>
                                                    <div class="controls">
                                                        <label class="control-label btn btn-info" v-if="!habilitaEdicao"><b>{{clickedCliente.id}}</b></label>
                                                        <label class="control-label btn btn-info" v-else><b>{{clickedCliente.id_cliente}}</b></label>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="firstname">Nome</label>
                                                    <div class="controls">
                                                        <input type="text" class="span6" name="Nome" id="nome"
                                                               v-model="clickedCliente.nome"
                                                               v-validate="'required|alpha_spaces|min:3'"
                                                               :disabled="!habilitaEdicao"
                                                               placeholder="Nome do Cliente">
                                                        <span v-show="errors.has('Nome')"
                                                              class="error">{{ errors.first('Nome') }}</span>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="email">Email</label>
                                                    <div class="controls">
                                                        <input type="email" class="span4" id="email" name="Email"
                                                               v-model="clickedCliente.email"
                                                               v-validate="'email|min:6'"
                                                               :disabled="!habilitaEdicao"
                                                               placeholder="email@gmail.com">
                                                        <span v-show="errors.has('Email')"
                                                              class="error">{{ errors.first('Email') }}</span>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="cpf_cnpj">Cpf/Cnpj</label>
                                                    <div class="controls">
                                                        <input type="text" class="span4" name="Cpf/Cnpj"
                                                               v-on:change="validarCpfCnpj()"
                                                               v-validate="'number'"
                                                               v-mask="'################'"
                                                               id="cpf_cnpj"
                                                               :disabled="!habilitaEdicao"
                                                               v-model="clickedCliente.cpf_cnpj"
                                                               placeholder="Cpf ou Cnpj">
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="insc_estadual">Insc.
                                                        Estadual</label>
                                                    <div class="controls">
                                                        <input type="text" class="span4" name="Insc. Estadual"
                                                               v-validate="'number'"
                                                               v-mask="'################'"
                                                               id="insc_estadual"
                                                               :disabled="!habilitaEdicao"
                                                               v-model="clickedCliente.insc_estadual"
                                                               placeholder="Incrição Estadual">
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="tel">Telefone</label>
                                                    <div class="controls">
                                                        <input type="text" class="span4" name="Telefone" id="tel"
                                                               v-model="clickedCliente.tel"
                                                               v-validate="'number'"
                                                               v-mask="'(##) #####-####'"
                                                               :disabled="!habilitaEdicao"
                                                               placeholder="(67) 3333-3333">
                                                        <span v-show="errors.has('Telefone')"
                                                              class="error">{{ errors.first('Telefone') }}</span>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="cel">Celular</label>
                                                    <div class="controls">
                                                        <input type="text" class="span4" name="Celular" id="cel"
                                                               v-model="clickedCliente.cel"
                                                               v-validate="'number'"
                                                               v-mask="'(##) #####-####'"
                                                               :disabled="!habilitaEdicao"
                                                               placeholder="(67) 99999-9999">
                                                    </div>
                                                </div>

                                                <br/>

                                                <div class="form-actions" v-show="habilitaEdicao">
                                                    <button type="submit" class="btn btn-primary"
                                                            @click="updateCliente(clickedCliente);">
                                                        Alterar dados
                                                    </button>
                                                    <button class="btn">Cancelar</button>
                                                </div>

                                            </fieldset>

                                            <fieldset>
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        <h2 class="panel-title"><b>Endereço(s) do Cliente</b></h2>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="cel">Local
                                                            Endereço</label>
                                                        <div class="controls">
                                                            <input type="text" class="span2" id="local"
                                                                   v-model="newEndereco.tipo_endereco"
                                                                   maxlength="50"
                                                                   placeholder="Minha Casa, Serviço, etc.">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="cel">Cep</label>
                                                        <div class="controls">
                                                            <input type="text" class="span2" id="cep"
                                                                   v-model="newEndereco.cep"
                                                                   v-validate="'number'"
                                                                   v-mask="'#####-###'"
                                                                   placeholder="79090-000">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="insc_estadual">Rua</label>
                                                        <div class="controls">
                                                            <input type="text" class="span6" id="rua"
                                                                   v-validate="'required'"
                                                                   v-model="newEndereco.rua"
                                                                   maxlength="500"
                                                                   placeholder="Rua Iria Loureiro">
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="tel">Número</label>
                                                        <div class="controls">
                                                            <input type="text" class="span1" id="num"
                                                                   v-validate="'number'"
                                                                   v-mask="'#####'"
                                                                   maxlength="5"
                                                                   v-model="newEndereco.numero"
                                                                   placeholder="206">
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="cel">Bairro</label>
                                                        <div class="controls">
                                                            <input type="text" class="span4" id="bairro"
                                                                   v-model="newEndereco.bairro"
                                                                   maxlength="250"
                                                                   placeholder="Centro">
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="cel">Cidade</label>
                                                        <div class="controls">
                                                            <input type="text" class="span4" id="cidade"
                                                                   v-model="newEndereco.cidade"
                                                                   maxlength="100"
                                                                   placeholder="Campo Grande">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="cel">Estado</label>
                                                        <div class="controls">
                                                            <input type="text" class="span1" id="estado"
                                                                   v-model="newEndereco.estado"
                                                                   maxlength="2"
                                                                   placeholder="MS">

                                                            <input type="text" v-model="newEndereco.id_cliente" v-show="false"/>

                                                            <a href="javascript:;" class="btn btn-small btn-success"
                                                               title="Adicionar Endereço(s)"
                                                               @click="saveEndereco(); getEnderecosIdCliente();"><i
                                                                        class="btn-icon-only icon-plus"> </i></a>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <div class="widget-content">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th> Cep</th>
                                                                <th> Local Endereço</th>
                                                                <th> Rua</th>
                                                                <th> Número</th>
                                                                <th> Bairro</th>
                                                                <th> Cidade</th>
                                                                <th> Estado</th>
                                                                <th class="td-actions"></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr v-for="endereco in enderecos">
                                                                <td> {{endereco.cep}}</td>
                                                                <td> {{endereco.tipo_endereco}}</td>
                                                                <td> {{endereco.rua}}</td>
                                                                <td> {{endereco.numero}}</td>
                                                                <td> {{endereco.bairro}}</td>
                                                                <td> {{endereco.cidade}}</td>
                                                                <td> {{endereco.estado}}</td>
                                                                <td class="td-actions">
                                                                    <a href="#myModal" role="button"
                                                                       data-toggle="modal"
                                                                       class="btn btn-small btn-success"
                                                                       @click="selectEndereco(endereco);"><i
                                                                                class="btn-icon-only icon-pencil"
                                                                                title="Editar Item"> </i></a>

                                                                    <a href="javascript:;"
                                                                       class="btn btn-danger btn-small"><i
                                                                                class="btn-icon-only icon-remove"
                                                                                title="Excluir Item"
                                                                                @click="selectEndereco(endereco); deleteEndereco(); getEnderecosIdCliente();"> </i></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <fieldset>
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        <h2 class="panel-title"><b>Carro(s) do Cliente</b></h2>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="cel">Placa</label>
                                                        <div class="controls">
                                                            <input type="text" class="span2" id="placa"
                                                                   v-model="newCarro.placa"
                                                                   placeholder="Placa do Veículo">
                                                        </div> <!-- /controls -->
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="cel">Marca</label>
                                                        <div class="controls">
                                                            <input type="text" class="span2" id="marca"
                                                                   v-model="newCarro.marca"
                                                                   placeholder="Marca do Veículo">
                                                        </div> <!-- /controls -->
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="cel">Modelo</label>
                                                        <div class="controls">
                                                            <input type="text" class="span4" id="modelo"
                                                                   v-model="newCarro.modelo"
                                                                   placeholder="Modelo do Veículo">
                                                        </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="control-label" for="cel">Obs.</label>
                                                        <div class="controls">
                                                              <textarea rows="5" cols="10" class="span4"
                                                                        v-model="newCarro.obs"
                                                                        id="obs"
                                                                        placeholder="Campo para alguma observação sobre o cliente."></textarea>

                                                            <input type="text" v-model="newCarro.id_cliente" v-show="false"/>

                                                            <a href="javascript:;" class="btn btn-small btn-success"
                                                               title="Adicionar Carro(s)"
                                                               @click="saveCarro(); getCarrosIdCliente();" ><i
                                                                        class="btn-icon-only icon-plus"> </i></a>
                                                        </div>
                                                    </div>

                                                    <br/>
                                                    <div class="widget-content">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th> Placa</th>
                                                                <th> Marca</th>
                                                                <th> Modelo</th>
                                                                <th> Obs</th>
                                                                <th class="td-actions"></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr v-for="carro in carros">
                                                                <td> {{carro.placa}}</td>
                                                                <td> {{carro.marca}}</td>
                                                                <td> {{carro.modelo}}</td>
                                                                <td> {{carro.obs}}</td>
                                                                <td class="td-actions">
                                                                    <a href="#myModal2" role="button"
                                                                       data-toggle="modal"
                                                                       @click="selectCarro(carro);"
                                                                       class="btn btn-small btn-success"><i
                                                                                class="btn-icon-only icon-pencil"
                                                                                title="Editar Item"> </i></a>

                                                                    <a href="javascript:;"
                                                                       class="btn btn-danger btn-small"
                                                                       @click="selectCarro(carro); deleteCarro(); getCarrosIdCliente();"><i
                                                                                class="btn-icon-only icon-remove"
                                                                                title="Excluir Item"> </i></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <br>
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
