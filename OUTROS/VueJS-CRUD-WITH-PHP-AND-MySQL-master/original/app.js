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
        errorMessage: "",
        successMessage: "",
        countEmail: "",
        validaEmail: "",
        users: [],
        newUser: {username: "", email: "", mobile: ""},
        clickedUser: {},
    },
    mounted: function () {
        this.getAllUsers();
    },
    computed: {
        isValidSave: function () {
            return app.newUser.username != '' && app.newUser.email != '' && app.newUser.mobile != '' && !this.errors.any() && !app.validaEmail;
        },
        isValidUpdate: function () {
            return app.clickedUser.username != '' && app.clickedUser.email != '' && app.clickedUser.mobile != '' && !this.errors.any();
        }
    },
    methods: {
        validateBeforeSubmit: function(){
            this.$validator.validateAll();
        },

        getAllUsers: function () {
            axios.get(url + "api.php?action=read")
                .then(function (response) {
                    if (response.data.error) {
                        app.errorMessage = response.data.message;
                    } else {
                        app.users = response.data.users;
                    }
                });
        },

        getCountEmail: function () {
            var formData = app.toFormData(app.newUser);
            axios.post(url + "api.php?action=count-email", formData)
                .then(function (response) {
                    if (response.data.error) {
                        app.errorMessage = response.data.message;
                        app.validaEmail = true;
                    }else{
                        app.errorMessage = response.data.message;
                        app.validaEmail = false;
                    }
                });
        },

        saveUser: function () {
            var formData = app.toFormData(app.newUser);
            axios.post(url + "api.php?action=create", formData)
                .then(function (response) {
                    app.newUser = {username: "", email: "", mobile: ""};
                    if (response.data.error) {
                        app.errorMessage = response.data.message;
                    } else {
                        app.successMessage = response.data.message;
                        app.getAllUsers();
                    }
                });
        },

        updateUser: function () {
            var formData = app.toFormData(app.clickedUser);
            axios.post(url + "api.php?action=update", formData)
                .then(function (response) {
                    app.clickedUser = {};
                    if (response.data.error) {
                        app.errorMessage = response.data.message;
                    } else {
                        app.successMessage = response.data.message;
                        app.getAllUsers();
                    }
                });
        },

        deleteUser: function () {
            var formData = app.toFormData(app.clickedUser);
            axios.post(url + "api.php?action=delete", formData)
                .then(function (response) {
                    app.clickedUser = {};
                    if (response.data.error) {
                        app.errorMessage = response.data.message;
                    } else {
                        app.successMessage = response.data.message;
                        app.getAllUsers();
                    }
                });
        },

        selectUser(user) {
            app.clickedUser = user;
        },

        toFormData: function (obj) {
            var form_data = new FormData();
            for (var key in obj) {
                form_data.append(key, obj[key]);
            }
            return form_data;
        },
        clearMessage: function () {
            app.errorMessage = "";
            app.successMessage = "";
        },

    }
});
