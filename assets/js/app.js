//Define an angular module for our app
var app = angular.module('crud', []);



app.controller('crudController', function($scope, $http, $timeout, $filter) {

    $scope.sortingOrder = 'id';
    $scope.reverse = false;
    $scope.filteredItems = [];
    $scope.groupedItems = [];
    $scope.itemsPerPage = 5;
    $scope.pagedItems = [];
    $scope.currentPage = 0;

    $scope.init = function(table)
    {
        $scope.table = table;
        getTableInfos(table);
        getData(table);


    };

    function getTableInfos(table) {
        $http.get("../../ajax/gettableinfos/"+table).success(function(data){
            $scope.tableInfos = data;
        });

    };

    function getData(table) {
        $http.get("../../ajax/getdata/"+table).success(function(data){
            $scope.datas = data;
            $scope.master= angular.copy(data);

            $scope.search();

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

            if(!this.data.dataUpdated){
                this.data.dataUpdated = {};
            }

            if(name != valueOrigin){
                this.data.dataUpdated[field] = 1;
            }else{
                this.data.dataUpdated[field] = 0;
            }
        }

        this.clicked = false;
    }

    $scope.dataDelete = function(field, name, key) {
        this.data.dataDelete = 1;

        if(this.data.dataAdd == 1){
            $scope.remove(this.data);
            nbNewData--;
        }
    }

    $scope.dataUndelete = function(field, name, key) {
        this.data.dataDelete = 0;
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
    }

    $scope.dataSave = function(table) {

        var postData = 'myDatas='+JSON.stringify($scope.datas);

        $http({
            method : 'POST',
            url : '../../ajax/savedata/' + table,
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

            $http.get("../../ajax/updatestatus/"+id).success(function(){
                console.log('status mise à jour');

            });

        }

    }

    var searchMatch = function (haystack, needle) {
        if (!needle) {
            return true;
        }
        if(!isNaN(haystack)){
            haystack = haystack.toString();
        }
        return haystack.toLowerCase().indexOf(needle.toLowerCase()) !== -1;

    };

    // init the filtered items
    $scope.search = function () {
        $scope.filteredItems = $filter('filter')($scope.datas, function (item) {
            for(var attr in item) {
                if (searchMatch(item[attr], $scope.query))
                    return true;
            }
            return false;
        });
        // take care of the sorting order
        if ($scope.sortingOrder !== '') {
            $scope.filteredItems = $filter('orderBy')($scope.filteredItems, $scope.sortingOrder, $scope.reverse);
        }
        $scope.currentPage = 0;
        // now group by pages
        $scope.groupToPages();
    };

    // calculate page in place
    $scope.groupToPages = function () {
        $scope.pagedItems = [];

        for (var i = 0; i < $scope.filteredItems.length; i++) {
            if (i % $scope.itemsPerPage === 0) {
                $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)] = [ $scope.filteredItems[i] ];
            } else {
                $scope.pagedItems[Math.floor(i / $scope.itemsPerPage)].push($scope.filteredItems[i]);
            }
        }
    };

    $scope.range = function (start, end) {
        var ret = [];
        if (!end) {
            end = start;
            start = 0;
        }
        for (var i = start; i < end; i++) {
            ret.push(i);
        }
        return ret;
    };

    $scope.prevPage = function () {
        if ($scope.currentPage > 0) {
            $scope.currentPage--;
        }
    };

    $scope.nextPage = function () {
        if ($scope.currentPage < $scope.pagedItems.length - 1) {
            $scope.currentPage++;
        }
    };

    $scope.setPage = function () {
        $scope.currentPage = this.n;
    };

    // functions have been describe process the data for display


    // change sorting order
    $scope.sort_by = function(newSortingOrder) {
        if ($scope.sortingOrder == newSortingOrder)
            $scope.reverse = !$scope.reverse;

        $scope.sortingOrder = newSortingOrder;

        $('th a i').each(function(){
            // icon reset
            $(this).removeClass().addClass('fa fa-sort');
        });

        if ($scope.reverse)
            $('th.'+newSortingOrder+' i').removeClass().addClass('fa fa-sort-desc');
        else
            $('th.'+newSortingOrder+' i').removeClass().addClass('fa fa-sort-asc');


    };

});