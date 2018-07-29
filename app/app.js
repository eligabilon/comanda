//Form Validate
Vue.use(VeeValidate, {locale: 'pt_BR'});
//Mask
Vue.use(VueMask.VueMaskPlugin);
Vue.directive('mask', VueMask.VueMaskDirective);

var app = new Vue({
        el: "#root",
        data: {
            showingModal: false,
            showingeditModal: false,
            showingdeleteModal: false,
            varClienteFull: false,
            habilitaEdicao: false,
            comandaItem: false,
            orcamento: false,
            telaCarro: false,
            editarComanda: false,
            radioButtonComanda: "ORÇAMENTO",
            situacaoComanda: "ABERTA",
            errorMessage: "",
            successMessage: "",
            texto: "ORÇAMENTOS E RECIBOS CADASTRADOS",
            countsCi: [],
            countsCa: [],
            countsOr: [],
            countsRe: [],
            totalGeral: [],
            id: [],
            clientes: [],
            newCliente: {id_cliente: "", id: "", nome: "", cpf_cnpj: "", insc_estadual: "", email: "", tel: "", cel: "", termo: "", placa: "", id_carro: ""},
            clickedCliente: {},
            carros: [],
            newCarro: {id: "", marca: "", placa: "", modelo: "", obs: "", id_cliente: ""},
            clickedCarro: {},
            enderecos: [],
            newEndereco: {id: "", cep: "", rua: "", numero: "", bairro: "", cidade: "", estado: "", tipo_endereco: "", id_cliente: ""},
            clickedEndereco: {},
            comandas: [],
            newComanda: {id: "", tipo: "", qtd: "", descricao_servico: "", vlr_unt: "", data: "", obs: "", vlr_total:"", situacao:"",id_item_comanda:"", nome:"", id_carro: "", placa:""},
            clickedComanda: {},
            itemComandas: [],
            newItemComanda: {id: "", qtd: "", descricao_servico: "", vlr_unt: "", vlr_total:"",id_comanda:""},
            clickedItemComanda: {},
        },

        mounted: function () {
            this.getAllClientes();
        },

        computed: {
            isValidSave: function () {
                return !this.errors.any();
            },
            isValidUpdate: function () {
                return app.clickedCliente.nome != '' && app.clickedCliente.tel != '' && !this.errors.any();
            }
        },

        methods: {
            validateBeforeSubmit: function () {
                this.$validator.validateAll();
            },

            validarCpfCnpj: function () {
                if(app.habilitaEdicao){
                    app.newCliente.cpf_cnpj = app.clickedCliente.cpf_cnpj;
                }
                app.clearMessage();
                var formData = app.toFormData(app.newCliente);
                axios.post(url + "api.php?action=validar-cpfcnpj", formData)
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.clearMessage();
                        }
                    });
            },

            getAllClientes: function () {
                axios.get(url + "api.php?action=read")
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.clientes = response.data.clientes;
                            app.countsCi = response.data.countsCi.length < 1 ? response.data.countsCi[0] = 0 : response.data.countsCi[0];
                            app.countsCa = response.data.countsCa.length < 1 ? response.data.countsCa[0] = 0 : response.data.countsCa[0];
                            app.countsOr = response.data.countsOr.length < 1 ? response.data.countsOr[0] = 0 : response.data.countsOr[0];
                            app.countsRe = response.data.countsRe.length < 1 ? response.data.countsRe[0] = 0 : response.data.countsRe[0];
                        }
                    });
            },

            getClientes: function () {
                app.clickedCliente = {};
                var formData = app.toFormData(app.newCliente, formData);
                axios.get(url + "api.php?action=read-cliente")
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.clientes = response.data.clientes;
                        }
                    });
            },

            getBuscaClientCarro: function () {
                app.clickedCliente = {};
                var formData = app.toFormData(app.newCliente);
                axios.post(url + "api.php?action=query-cliente-carro", formData)
                    .then(function (response) {
                        if (!response.data.error) {
                            app.clientes = response.data.clientes;
                        }
                    });
            },

            getBuscaIndexClient: function () {
                var formData = app.toFormData(app.newCliente);
                axios.post(url + "api.php?action=query-cliente", formData)
                    .then(function (response) {
                        if (!response.data.error) {
                            app.clientes = response.data.clientes;
                            app.newCliente = response.data.clientes;
                        }
                    });
            },

            saveCliente: function () {
                var formData = app.toFormData(app.newCliente);
                axios.post(url + "api.php?action=create-cliente", formData)
                    .then(function (response) {
                        app.newCliente = {nome: "", cpf_cnpj: "", insc_estadual: "", email: "", tel: "", cel: ""};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.varClienteFull = response.data.id[0] != "";
                            app.clickedCliente.id = response.data.id[0];
                        }
                    });
            },

            updateCliente: function () {
                var formData = app.toFormData(app.clickedCliente);
                axios.post(url + "api.php?action=update-cliente", formData)
                    .then(function (response) {
                        app.clickedCliente = {};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                        }
                    });
            },

            deleteCliente: function () {
                var formData = app.toFormData(app.clickedCliente);
                axios.post(url + "api.php?action=delete", formData)
                    .then(function (response) {
                        app.clickedCliente = {};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.getAllClientes();
                        }
                    });
            },

            selectCliente(cliente) {
                app.clickedCliente = cliente;
            },

            carregaIdCliente(cliente) {
                app.varClienteFull = cliente;
                app.habilitaEdicao = cliente;
                app.clickedCliente = cliente;
                app.getEnderecosIdCliente();
                app.getCarrosIdCliente();
            },

            /////////////////////////////////////ENDERECO///////////////////////////////////////////////////////////////
            getEnderecosIdCliente: function () {
                if(app.habilitaEdicao){
                    app.newEndereco.id_cliente = app.clickedCliente.id_cliente;
                }else{
                    app.newEndereco.id_cliente = app.clickedCliente.id;
                }
                var formData = app.toFormData(app.newEndereco);
                axios.post(url + "api.php?action=query-endereco", formData)
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.enderecos = response.data.enderecos;
                        }
                    });
            },

            saveEndereco: function () {
                if(app.habilitaEdicao) {
                    app.newEndereco.id_cliente = app.clickedCliente.id_cliente;
                }else{
                    app.newEndereco.id_cliente = app.clickedCliente.id;
                }
                var formData = app.toFormData(app.newEndereco);
                axios.post(url + "api.php?action=create-endereco", formData)
                    .then(function (response) {
                        app.newEndereco = {cep: "", rua: "", numero: "", bairro: "", cidade: "", estado: "", tipo_endereco: "", id_cliente: ""};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.clickedEndereco.id = response.data.id[0];
                        }
                    });
            },

            updateEndereco: function () {
                var formData = app.toFormData(app.clickedEndereco);
                axios.post(url + "api.php?action=update-endereco", formData)
                    .then(function (response) {
                        app.clickedEndereco = {};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.getAllEnderecos();
                        }
                    });
            },

            deleteEndereco: function () {
                var formData = app.toFormData(app.clickedEndereco);
                axios.post(url + "api.php?action=delete-endereco", formData)
                    .then(function (response) {
                        app.clickedEndereco = {};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.getEnderecosIdCliente();
                        }
                    });
            },

            selectEndereco(endereco) {
                app.clickedEndereco = endereco;
            },

            /////////////////////////////////////CARRO//////////////////////////////////////////////////////////////////
            getBuscaCincoCarroClient: function () {
                axios.post(url + "api.php?action=read-carros")
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.carros = response.data.carros;
                        }
                    });
            },

            getBuscaCarroClientAll: function () {
                axios.post(url + "api.php?action=read-carro-cliente")
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.carros = response.data.carros;
                        }
                    });
            },

            getCarrosIdCliente: function () {
                if(app.habilitaEdicao){
                    app.newCarro.id_cliente = app.clickedCliente.id_cliente;
                }else{
                    app.newCarro.id_cliente = app.clickedCliente.id;
                }
                var formData = app.toFormData(app.newCarro);
                axios.post(url + "api.php?action=query-carro", formData)
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.carros = response.data.carros;
                        }
                    });
            },

            getBuscaCarroClientTermo: function () {
                var formData = app.toFormData(app.newCliente);
                axios.post(url + "api.php?action=query-carro-cliente", formData)
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.carros = response.data.carros;
                        }
                    });
            },

            saveCarro: function () {
                if(app.habilitaEdicao) {
                    app.newCarro.id_cliente = app.clickedCliente.id_cliente;
                }else{
                    app.newCarro.id_cliente = app.clickedCliente.id;
                }
                var formData = app.toFormData(app.newCarro);
                axios.post(url + "api.php?action=create-carro", formData)
                    .then(function (response) {
                        app.newCarro = {marca: "", placa: "", modelo: "", obs: "", id_cliente: ""};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.clickedCarro.id = response.data.id[0];
                        }
                    });
            },

            updateCarro: function () {
                var formData = app.toFormData(app.clickedCarro);
                axios.post(url + "api.php?action=update-carro", formData)
                    .then(function (response) {
                        app.clickedCarro = {id: "", marca: "", placa: "", modelo: "", obs: "", id_cliente: ""};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.getCarrosIdCliente();
                        }
                    });
            },

            deleteCarro: function () {
                var formData = app.toFormData(app.clickedCarro);
                axios.post(url + "api.php?action=delete-carro", formData)
                    .then(function (response) {
                        app.clickedCarro = {};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.getCarrosIdCliente();
                        }
                    });
            },

            selectCarro(carro) {
                app.clickedCarro = carro;
            },

            /////////////////////////////////////COMANDA///////////////////////////////////////////////////////////////

            getReadComandas: function () {
                axios.get(url + "api.php?action=read-comanda")
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.comandas = response.data.comandas;
                        }
                    });
            },

            getReadFullComandas: function () {
                axios.get(url + "api.php?action=read-comanda-todos")
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.comandas = response.data.comandas;
                        }
                    });
            },

            getReadAbertaComandas: function () {
                axios.get(url + "api.php?action=read-comanda-aberta")
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.comandas = response.data.comandas;
                        }
                    });
            },

            getReadFechadaComandas: function () {
                axios.get(url + "api.php?action=read-comanda-fechada")
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.comandas = response.data.comandas;
                        }
                    });
            },

            getComandasIdCarro: function () {
                var formData = app.toFormData(app.newComanda);
                axios.post(url + "api.php?action=query-comanda", formData)
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.comandas = response.data.comandas;
                        }
                    });
            },

            getComandasTodosCampos: function () {
                var formData = app.toFormData(app.newComanda);
                axios.post(url + "api.php?action=query-comanda-todos", formData)
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.comandas = response.data.comandas;
                        }
                    });
            },

            saveComanda: function () {
                app.newComanda.id_carro = app.clientes[0].id_carro;
                app.newComanda.tipo = app.radioButtonComanda;
                app.newComanda.situacao = app.situacaoComanda;
                app.clickedComanda = app.newComanda;
                var formData = app.toFormData(app.newComanda);
                axios.post(url + "api.php?action=create-comanda", formData)
                    .then(function (response) {
                        app.newComanda = {id: "", tipo: "", data: "", obs: "", situacao:"", id_carro: ""};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.clickedComanda.id = response.data.id[0];
                        }
                    });
            },

            updateComanda: function () {
                var formData = app.toFormData(app.clickedComanda);
                axios.post(url + "api.php?action=update-comanda", formData)
                    .then(function (response) {
                        app.clickedComanda = {};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.getComandasIdCarro();
                        }
                    });
            },

            deleteComanda: function () {
                var formData = app.toFormData(app.clickedComanda);
                axios.post(url + "api.php?action=delete-comanda", formData)
                    .then(function (response) {
                        app.clickedComanda = {};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.getComandasIdCarro();
                        }
                    });
            },

            selectComanda(comanda) {
                app.newCliente.termo = comanda.placa;
                app.radioButtonComanda = comanda.tipo;
                app.situacaoComanda = comanda.situacao;
                app.data = comanda.data;
                app.clickedItemComanda.id_comanda = comanda.id;
                app.newComanda.obs = comanda.obs;
                app.clickedComanda = comanda;
            },

            /////////////////////////////////ITEM-COMANDA///////////////////////////////////////////////////////////////

            getItemComandasIdCarro: function () {
                app.clickedItemComanda.id_comanda = app.clickedComanda.id;
                var formData = app.toFormData(app.clickedItemComanda);
                axios.post(url + "api.php?action=query-comanda-item", formData)
                    .then(function (response) {
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.itemComandas = response.data.itemComandas;
                            app.clickedItemComanda.id = response.data.id[0];
                        }
                    });
            },

            saveComandaItem: function () {
                app.newItemComanda.id_comanda = app.clickedComanda.id;
                var formData = app.toFormData(app.newItemComanda);
                axios.post(url + "api.php?action=create-comanda-item", formData)
                    .then(function (response) {
                        app.newItemComanda = {id: "", qtd: "", descricao_servico: "", vlr_unt: "", id_comanda: ""};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.clickedItemComanda.id = response.data.id[0];
                            app.getItemComandasIdCarro();
                        }
                    });
            },

            updateItemComanda: function () {
                var formData = app.toFormData(app.clickedItemComanda);
                axios.post(url + "api.php?action=update-comanda-item", formData)
                    .then(function (response) {
                        app.clickedItemComanda = {};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.getItemComandasIdCarro();
                        }
                    });
            },

            deleteItemComanda: function () {
                var formData = app.toFormData(app.clickedItemComanda);
                axios.post(url + "api.php?action=delete-comanda-item", formData)
                    .then(function (response) {
                        app.clickedItemComanda = {};
                        if (response.data.error) {
                            app.errorMessage = response.data.message;
                        } else {
                            app.successMessage = response.data.message;
                            app.getItemComandasIdCarro();
                        }
                    });
            },

            selectItemComanda(itemComanda) {
                app.clickedItemComanda = itemComanda;
            },
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////

            numberToReal(numero) {
                var numero = (numero == null ? numero = 0 : numero).toLocaleString('pt-br', {minimumFractionDigits: 2});
                return numero;
            },

            toFormData: function (obj) {
                var form_data = new FormData();
                for (var key in obj) {
                    form_data.append(key, obj[key]);
                }
                return form_data;
            },

            dataDia: function () {
                var data = new Date();
                var dia = data.getDate();
                if (dia.toString().length == 1)
                    dia = "0"+dia;
                var mes = data.getMonth()+1;
                if (mes.toString().length == 1)
                    mes = "0"+mes;
                var ano = data.getFullYear();
                return dia+"/"+mes+"/"+ano;
            },

            clearMessage: function () {
                app.errorMessage = "";
                app.successMessage = "";
            },

            clearObjs: function () {
                app = new Vue();
                id = "",
                clientes = "",
                newCliente = "",
                clickedCliente = "",
                carros = "",
                newCarro = "",
                clickedCarro = "",
                comandas = "",
                newComanda = "",
                clickedComanda = "",
                enderecos = "",
                newEndereco = "",
                clickedEndereco = ""
            },

        }
    })
;
