'use strict';

function CPFCtrl($scope, $location, CPF) {

    $scope.$on('$viewContentLoaded', function () {
        $scope.status = 1;
    });
    
    $scope.novo = function(){
        $location.path("/novo");     
    };

    $scope.cancelar = function(){
        $location.path("/");     
    };

    $scope.salvar = function(){ 
        CPF.save({_id: 'new'}, { numero: $scope.cpf, status: $scope.status}, 
            function (success) {
                //
                $scope.cancelar();
            }, 
            function (error) {
                console.log(error.data.message);
                $scope.errorMessage = error.data.message;
                
                angular.element('.alert-warning').addClass('show');
                angular.element('.close').on('click', function(e){
                    angular.element('.alert-warning').removeClass('show');                    
                });
            }
        );   
    };

    $scope.consultar = function(){
        CPF.get({ _id: $scope.cpf}, function (success) {
            if(success.items){
                $scope.items = success.items;    
            }
        }, function (error) {
            console.log(error.data.message);
        });      
    };

    $scope.alterar = function(cpf, status){
        status = (status == 'FREE') ? 2 : 1;
        CPF.update({ _id: $scope.cpf}, { numero: cpf, status: status}, 
            function (success) {
                if(success.items){
                    $scope.items = success.items;    
                }
            }, 
            function (error) {
                console.log(error.data.message);
            }
        );      
    };

}
CPFCtrl.$inject = ['$scope', '$location', 'CPF'];