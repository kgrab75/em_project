//Define an angular module for our app
var app = angular.module('crud', []);



app.controller('crudController', function($scope, $http, $timeout) {

    $scope.init = function(table)
    {
        $scope.table = table;
        getTableInfos(table);
        getData(table);


    };

    function getTableInfos(table) {
        $http.get("/ajax/gettableinfos/"+table).success(function(data){
            $scope.tableInfos = data;
        });

    };

    function getData(table) {
        $http.get("/ajax/getdata/"+table).success(function(data){
            $scope.datas = data;
            $scope.master= angular.copy(data);

        });
    };

    $scope.updateData = function() {
        if(this.data.dataDelete != 1){
            this.clicked = true;
            $timeout(function(){
                $('input').focus();
            },0);
        }
    };

    $scope.dataUpdated = function(field, name, key) {


        if(this.data.dataAdd != 1){
            valueOrigin = $scope.master[key-nbNewData][field];

            console.log('valueOrigin = ' + valueOrigin);
            console.log('name = ' + name);

            if(!this.data.dataUpdated){
                this.data.dataUpdated = {};
            }

            if(name != valueOrigin){
                this.data.dataUpdated[field] = 1;
            }else{
                this.data.dataUpdated[field] = 0;
            }
        }

        console.log($scope.datas[key]);

        this.clicked = false;
    }

    $scope.dataDelete = function(field, name, key) {
        this.data.dataDelete = 1;

        if(this.data.dataAdd == 1){
            $scope.remove(this.data);
            nbNewData--;
        }
        console.log($scope.datas[key]);
    }

    $scope.dataUndelete = function(field, name, key) {
        this.data.dataDelete = 0;
        console.log($scope.datas[key]);
    }

    nbNewData = 0;

    $scope.dataAdd = function() {
        nbNewData++;
        x={};

        for (index = 0; index < $scope.tableInfos.length; ++index){
            if([$scope.tableInfos[index]['Field']] == 'id'){
                x['id'] = '#';
            }else{
                x[$scope.tableInfos[index]['Field']] = '';
            }
        }
        x['dataAdd'] = 1;
        x['dataDelete'] = 0;

        $scope.datas.unshift(x);
        console.log($scope.datas);
    }

    $scope.dataSave = function(table) {

        var postData = 'myDatas='+JSON.stringify($scope.datas);

        $http({
            method : 'POST',
            url : '/ajax/savedata/' + table,
            data: postData,
            headers : {'Content-Type': 'application/x-www-form-urlencoded'}

        }).success(function(res){
            $scope.dataSaved = 1;
            getData(table);
        }).error(function(error){
            console.log(error);

        });
    }

    $scope.remove = function(item) {
        var index=$scope.datas.indexOf(item)
        $scope.datas.splice(index,1);
    }

    $scope.toggleMessage = function(id) {
        if(this.data.status == 0){

            this.data.status = 1;

            $http.get("/ajax/updatestatus/"+id).success(function(){
                console.log('status mise à jour');

            });

        }

    }

});