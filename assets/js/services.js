'use strict';

/* Services */

angular.module('app.services', ['ngResource', 'ngCookies']).
    factory('CPF', ['$resource', '$http',
        function ($resource, $http) {
            return $resource('/api/cpf/:_id', {}, {
                query: {
                    method: 'GET',
                    isArray: true
                },
                get: {
                    method: 'GET'
                },
                save: {
                    method: 'POST'
                },
                update: {
                    method: 'PUT'
                }
            });
        }
    ]);
