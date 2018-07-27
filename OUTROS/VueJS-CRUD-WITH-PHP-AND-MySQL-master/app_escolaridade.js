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
        editarEscolaridade: false,
        errorMessage: "",
        successMessage: "",
        countEscolaridade: "",
        validaEscolaridade: "",
        escolaridades: [],
        newEscolaridade: {escolaridade: ""},
        clickedEscolaridade: {},
    },
    mounted: function () {
        this.getAllEscolaridades();
    },
    computed: {
        isValidSave: function () {
            return  this.newEscolaridade.escolaridade != '' && !this.errors.any() && !this.validaEscolaridade;
        },
        isValidUpdate: function () {
            return this.clickedEscolaridade.escolaridade != '' && !this.errors.any();
        }
    },
    methods: {
        validateBeforeSubmit: function(){
            this.$validator.validateAll();
        },

        getAllEscolaridades: function () {
            axios.get(url + "api_escolaridade.php?action=read")
                .then(function (response) {
                    if (response.data.error) {
                        app.errorMessage = response.data.message;
                    } else {
                        app.escolaridades = response.data.escolaridades;
                    }
                });
        },

        getCountEscolaridade: function () {
            var formData = app.toFormData(app.newEscolaridade);
            axios.post(url + "api_escolaridade.php?action=count-escolaridade", formData)
                .then(function (response) {
                    if (response.data.error) {
                        app.errorMessage = response.data.message;
                        app.validaEscolaridade = true;
                    }else{
                        app.errorMessage = response.data.message;
                        app.validaEscolaridade = false;
                    }
                });
        },

        saveEscolaridade: function () {
            var formData = app.toFormData(app.newEscolaridade);
            axios.post(url + "api_escolaridade.php?action=create", formData)
                .then(function (response) {
                    app.newEscolaridade = {escolaridade: ""};
                    if (response.data.error) {
                        app.errorMessage = response.data.message;
                    } else {
                        app.successMessage = response.data.message;
                        app.getAllEscolaridades();
                    }
                });
        },

        updateEscolaridade: function () {
            var formData = app.toFormData(app.clickedEscolaridade);
            axios.post(url + "api_escolaridade.php?action=update", formData)
                .then(function (response) {
                    app.clickedEscolaridade = {};
                    if (response.data.error) {
                        app.errorMessage = response.data.message;
                    } else {
                        app.successMessage = response.data.message;
                        app.getAllEscolaridades();
                    }
                });
        },

        deleteEscolaridade: function () {
            var formData = app.toFormData(app.clickedEscolaridade);
            axios.post(url + "api_escolaridade.php?action=delete", formData)
                .then(function (response) {
                    app.clickedEscolaridade = {};
                    if (response.data.error) {
                        app.errorMessage = response.data.message;
                    } else {
                        app.successMessage = response.data.message;
                        app.getAllEscolaridades();
                    }
                });
        },

        selectEscolaridade(escolaridade) {
            app.clickedEscolaridade = escolaridade;
        },

        toFormData: function (obj) {
            var form_data = new FormData();
            for (var key in obj) {
                form_data.append(key, obj[key]);
            }
            return form_data;
        },

        clearInput: function () {
          app.clickedEscolaridade.escolaridade = "";
          app.newEscolaridade.escolaridade = "";
          app.clearMessage();
        },

        clearMessage: function () {
            app.errorMessage = "";
            app.successMessage = "";
        },

    }
});
