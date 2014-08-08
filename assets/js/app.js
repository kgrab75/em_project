//Define an angular module for our app
var app = angular.module('crud', []);

app.controller('crudController', function($scope, $http) {

    $scope.init = function(table)
    {
        $scope.table = table;
        getTableInfos(table);
        getData(table);


    };

    function getTableInfos(table) {
        $http.get("/em_project/index.php/ajax/gettableinfos/"+table).success(function(data){
            $scope.tableInfos = data;
        });
    };

    function getData(table) {
        $http.get("/em_project/index.php/ajax/getdata/"+table).success(function(data){
            $scope.datas = data;
        });
    };

    $scope.addTask = function (task) {
        $http.get("ajax/addTask.php?task="+task).success(function(data){
            getTask();
            $scope.taskInput = "";
        });
    };

    $scope.deleteTask = function (task) {
        if(confirm("Are you sure to delete this line?")){
            $http.get("ajax/deleteTask.php?taskID="+task).success(function(data){
                getTask();
            });
        }
    };

    $scope.toggleStatus = function(item, status, task) {
        if(status=='2'){status='0';}else{status='2';}
        $http.get("ajax/updateTask.php?taskID="+item+"&status="+status).success(function(data){
            getTask();
        });
    };

    app.directive('focusIf', function () {
        return function focusIf(scope, element, attr) {
            scope.$watch(attr.focusIf, function (newVal) {
                console.log('test');
                if (newVal) {
                    element[0].focus();
                    // You can write element.focus() if jQuery is available
                }
            });
        }
    });




});