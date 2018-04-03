'use strict';

var app = angular.module('app', [
    'app.services',
    'ngRoute',
    'ngSanitize'
])
    .config(function ($routeProvider, $locationProvider) {
        $routeProvider
            .when('/', {templateUrl: '/views/consultaCPF.html', controller: CPFCtrl})
            .when('/novo', {templateUrl: '/views/novoCPF.html', controller: CPFCtrl})
        .otherwise({ redirectTo: '/' });
    });


app.directive('cpf', ['$filter', function ($filter) {
    return {
        require: '?ngModel',
        link: function (scope, elem, attrs, ctrl) {
            if (!ctrl) return;

            ctrl.$formatters.unshift(function (a) {
                elem.inputmask({
                    alias: "999.999.999-99",
                    "clearIncomplete": true,
                    "oncomplete": function (e) {
                        if (!CPF.isValid(elem[0].value)) {
                            elem[0].value = elem[0].value.substring(0, elem[0].value.length - 1) + '_';
                        }
                    }
                });
                return CPF.format(ctrl.$modelValue || '');
            });

            ctrl.$parsers.unshift(function (viewValue) {
                var v = elem[0].value.replace(/\./g, '').replace(/\-/g, '').replace(/\//g, '').replace(/\_/g, '');
                return CPF.isValid(v) ? v : null;
            });
        }
    };
}]);

app.directive('integer', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    var transformedInput = text.replace(/[^0-9]/g, '');

                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});

app.run(function ($rootScope, $http) {

});

// Apoio a diretiva cpf
!function (a) { var b = ["00000000000", "11111111111", "22222222222", "33333333333", "44444444444", "55555555555", "66666666666", "77777777777", "88888888888", "99999999999", "12345678909"], c = /[.-]/g, d = /[^\d]/g, e = function (a) { a = a.split("").map(function (a) { return parseInt(a, 10) }); var b = a.length + 1, c = a.map(function (a, c) { return a * (b - c) }), d = c.reduce(function (a, b) { return a + b }) % 11; return d < 2 ? 0 : 11 - d }, f = {}; f.format = function (a) { return this.strip(a).replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, "$1.$2.$3-$4") }, f.strip = function (a, b) { var e = b ? c : d; return (a || "").toString().replace(e, "") }, f.isValid = function (a, c) { var d = this.strip(a, c); if (!d) return !1; if (11 !== d.length) return !1; if (b.indexOf(d) >= 0) return !1; var f = d.substr(0, 9); return f += e(f), f += e(f), f.substr(-2) === d.substr(-2) }, f.generate = function (a) { for (var b = "", c = 0; c < 9; c++) b += Math.floor(9 * Math.random()); return b += e(b), b += e(b), a ? this.format(b) : b }, a ? module.exports = f : window.CPF = f }("undefined" != typeof exports), function (a) { var b = ["00000000000000", "11111111111111", "22222222222222", "33333333333333", "44444444444444", "55555555555555", "66666666666666", "77777777777777", "88888888888888", "99999999999999"], c = /[-\/.]/g, d = /[^\d]/g, e = function (a) { var b = 2, c = a.split("").reduce(function (a, b) { return [parseInt(b, 10)].concat(a) }, []), d = c.reduce(function (a, c) { return a += c * b, b = 9 === b ? 2 : b + 1, a }, 0), e = d % 11; return e < 2 ? 0 : 11 - e }, f = {}; f.format = function (a) { return this.strip(a).replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, "$1.$2.$3/$4-$5") }, f.strip = function (a, b) { var e = b ? c : d; return (a || "").toString().replace(e, "") }, f.isValid = function (a, c) { var d = this.strip(a, c); if (!d) return !1; if (14 !== d.length) return !1; if (b.indexOf(d) >= 0) return !1; var f = d.substr(0, 12); return f += e(f), f += e(f), f.substr(-2) === d.substr(-2) }, f.generate = function (a) { for (var b = "", c = 0; c < 12; c++) b += Math.floor(9 * Math.random()); return b += e(b), b += e(b), a ? this.format(b) : b }, a ? module.exports = f : window.CNPJ = f }("undefined" != typeof exports);
