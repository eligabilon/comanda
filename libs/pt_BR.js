!function (e, n) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = n() : "function" == typeof define && define.amd ? define(n) : (e.__vee_validate_locale__pt_BR = e.__vee_validate_locale__pt_BR || {}, e.__vee_validate_locale__pt_BR.js = n())
}(this, function () {
    "use strict";
    var e, n = {
        name: "pt_BR", messages: {
            _default: function (e) {
                return "O valor do campo " + e + " nÃ£o Ã© vÃ¡lido."
            }, after: function (e, n) {
                return "O campo " + e + " deve estar depois do campo " + n[0] + "."
            }, alpha_dash: function (e) {
                return "O campo " + e + " deve conter letras, nÃºmeros e traÃ§os."
            }, alpha_num: function (e) {
                return "O campo " + e + " deve conter somente letras e nÃºmeros."
            }, alpha_spaces: function (e) {
                return "O campo " + e + " sÃ³ pode conter caracteres alfabÃ©ticos e espaÃ§os."
            }, alpha: function (e) {
                return "O campo " + e + " deve conter somente letras."
            }, before: function (e, n) {
                return "O campo " + e + " deve estar antes do campo " + n[0] + "."
            }, between: function (e, n) {
                return "O campo " + e + " deve estar entre " + n[0] + " e " + n[1] + "."
            }, confirmed: function (e, n) {
                return "Os campos " + e + " e " + n[0] + " devem ser iguais."
            }, credit_card: function (e) {
                return "O campo " + e + " Ã© invÃ¡lido."
            }, date_between: function (e, n) {
                return "O campo " + e + " deve estar entre " + n[0] + " e " + n[1] + "."
            }, date_format: function (e, n) {
                return "O campo " + e + " deve estar no formato " + n[0] + "."
            }, decimal: function (e, n) {
                void 0 === n && (n = []);
                var o = n[0];
                return void 0 === o && (o = "*"), "O campo " + e + " deve ser numÃ©rico e deve conter " + (o && "*" !== o ? o : "") + " casas decimais."
            }, digits: function (e, n) {
                return "O campo " + e + " deve ser numÃ©rico e ter exatamente " + n[0] + " dÃ­gitos."
            }, dimensions: function (e, n) {
                return "O campo " + e + " deve ter " + n[0] + " pixels de largura por " + n[1] + " pixels de altura."
            }, email: function (e) {
                return "O campo " + e + " deve ser um email vÃ¡lido."
            }, ext: function (e) {
                return "O campo " + e + " deve ser um arquivo vÃ¡lido."
            }, image: function (e) {
                return "O campo " + e + " deve ser uma imagem."
            }, in: function (e) {
                return "O campo " + e + " deve ter um valor vÃ¡lido."
            }, integer: function (e) {
                return "O campo " + e + " deve ser um nÃºmero inteiro."
            }, ip: function (e) {
                return "O campo " + e + " deve ser um endereÃ§o IP vÃ¡lido."
            }, length: function (e, n) {
                var o = n[0], r = n[1];
                return r ? "O tamanho do campo " + e + " estÃ¡ entre " + o + " e " + r + "." : "O tamanho do campo " + e + " deve ser " + o + "."
            }, max: function (e, n) {
                return "O campo " + e + " nÃ£o deve ter mais que " + n[0] + " caracteres."
            }, max_value: function (e, n) {
                return "O campo " + e + " precisa ser " + n[0] + " ou menor."
            }, mimes: function (e) {
                return "O campo " + e + " deve ser um tipo de arquivo vÃ¡lido."
            }, min: function (e, n) {
                return "O campo " + e + " deve conter pelo menos " + n[0] + " caracteres."
            }, min_value: function (e, n) {
                return "O campo " + e + " precisa ser " + n[0] + " ou maior."
            }, not_in: function (e) {
                return "O campo " + e + " deve ser um valor vÃ¡lido."
            }, numeric: function (e) {
                return "O campo " + e + " deve conter apenas nÃºmeros"
            }, regex: function (e) {
                return "O campo " + e + " possui um formato invÃ¡lido."
            }, required: function (e) {
                return "O campo " + e + " Ã© obrigatÃ³rio."
            }, size: function (e, n) {
                var o, r, t, a = n[0];
                return "O campo " + e + " deve ser menor que " + (o = a, r = 1024, t = 0 == (o = Number(o) * r) ? 0 : Math.floor(Math.log(o) / Math.log(r)), 1 * (o / Math.pow(r, t)).toFixed(2) + " " + ["Byte", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"][t]) + "."
            }, url: function (e) {
                return "O campo " + e + " nÃ£o Ã© uma URL vÃ¡lida."
            }
        }, attributes: {}
    };
    return "undefined" != typeof VeeValidate && VeeValidate.Validator.localize(((e = {})[n.name] = n, e)), n
});