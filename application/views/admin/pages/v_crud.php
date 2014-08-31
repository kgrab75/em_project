<aside class="col-sm-9 col-sm-offset-3 crud" ng-init="init('<?php echo $table; ?>')">

    <div class="form-inline col-sm-12" role="form">
        <div class="form-group has-feedback">
            <input type="text" ng-model="query" ng-change="search()" ng-model-options="{ debounce: 1000 }" class="form-control" placeholder="Search">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="col-sm-4 no-padding_left">
            <button type="button" class="btn btn-success btn-lg add pull-left" ng-click="dataAdd()">
                <span class="glyphicon glyphicon-plus"></span> Ajouter un Eco-acteur
            </button>
        </div>
        <div class="col-sm-offset-1">
            <ul class="pagination">
                <li ng-class="{disabled: currentPage == 0}">
                    <a href ng-click="prevPage()">« Prev</a>
                </li>
                <li ng-repeat="n in range(pagedItems.length)"
                    ng-class="{active: n == currentPage}"
                    ng-click="setPage()">
                    <a href ng-bind="n + 1">1</a>
                </li>
                <li ng-class="{disabled: currentPage == pagedItems.length - 1}">
                    <a href ng-click="nextPage()">Next »</a>
                </li>
            </ul>
        </div>
    </div>


    <div class="table-responsive col-sm-12">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th ng-repeat="table in tableInfos" class="{{table.Field}}">
                        <a ng-click="sort_by(table.Field)"><i class="fa fa-sort"> {{table.Field}}&nbsp;</i></a>
                    </th>
                </tr>
            </thead>
            <tbody>

            <tr ng-repeat="(keyData, data) in datas | filter:{ id: '#' }" ng-class="{'bg-danger': data.dataDelete == 1, 'bg-add': data.dataAdd == 1}">
                <td>
                    <div>
                        <span>{{data.id}}</span>
                    </div>
                </td>
                <td ng-repeat="(key, value) in tableInfos" ng-show="!$first" ng-click="updateData()" ng-class="{'bg-success': data.dataUpdated[value.Field] == 1, 'bg-danger': data.dataDelete == 1}">



                    <span ng-if="value.Field != 'id'" class="fa fa-pencil" ></span>

                    <div class="data" ng-show="!clicked">
                        <span>{{data[value.Field]|limitTo:15}}</span>
                        <span ng-if="data[value.Field].length > 15">...</span>
                    </div>


                    <input type="text" ng-show="clicked" ng-blur="dataUpdated(value.Field, data[value.Field], keyData)" value="{{data[value.Field]}}" size="{{data[value.Field].length > 15 ? 15 : data[value.Field].length}}" ng-model="data[value.Field]" />


                </td>

                <td>
                    <button type="button" class="btn btn-danger" ng-click="dataDelete(value.Field, data[value.Field], keyData)" ng-show="!data.dataDelete">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button>
                    <button type="button" class="btn btn-success" ng-click="dataUndelete(value.Field, data[value.Field], keyData)" ng-show="data.dataDelete">
                        <span class="glyphicon glyphicon-export"></span>
                    </button>
                </td>
                <!--td>
                    <button type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                </td-->
            </tr>

                <tr ng-repeat="(keyData, data) in pagedItems[currentPage] | orderBy:sortingOrder:reverse" ng-class="{'bg-danger': data.dataDelete == 1, 'bg-add': data.dataAdd == 1}">


                    <td>
                        <button type="button" class="btn btn-danger" ng-click="dataDelete(value.Field, data[value.Field], keyData)" ng-show="!data.dataDelete">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                        <button type="button" class="btn btn-success" ng-click="dataUndelete(value.Field, data[value.Field], keyData)" ng-show="data.dataDelete">
                            <span class="glyphicon glyphicon-export"></span>
                        </button>
                    </td>
                    <td>
                        <div>
                            <span>{{data.id}}</span>
                        </div>
                    </td>
                    <td ng-repeat="(key, value) in tableInfos" ng-show="!$first" ng-click="updateData()" ng-class="{'bg-success': data.dataUpdated[value.Field] == 1, 'bg-danger': data.dataDelete == 1}">



                            <span ng-if="value.Field != 'id'" class="fa fa-pencil" ></span>

                            <div class="data" ng-show="!clicked">
                                <span>{{data[value.Field]|limitTo:15}}</span>
                                <span ng-if="data[value.Field].length > 15">...</span>
                            </div>


                            <input type="text" ng-show="clicked" ng-blur="dataUpdated(value.Field, data[value.Field], keyData)" value="{{data[value.Field]}}" size="{{data[value.Field].length > 15 ? 15 : data[value.Field].length}}" ng-model="data[value.Field]" />


                    </td>
                    <!--td>
                        <button type="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </button>
                    </td-->
                </tr>
            </tbody>

        </table>
    </div>

    <div class="col-sm-12">

        <div class="col-sm-4  no-padding_left">
            <button type="button" class="btn btn-orange btn-lg save pull-left" ng-click="dataSave('<?php echo $table; ?>')">
                <span class="glyphicon glyphicon-save"></span> Sauvegarder
            </button>
        </div>

        <div class="col-sm-offset-1">
            <ul class="pagination">
                <li ng-class="{disabled: currentPage == 0}">
                    <a href ng-click="prevPage()">« Prev</a>
                </li>
                <li ng-repeat="n in range(pagedItems.length)"
                    ng-class="{active: n == currentPage}"
                    ng-click="setPage()">
                    <a href ng-bind="n + 1">1</a>
                </li>
                <li ng-class="{disabled: currentPage == pagedItems.length - 1}">
                    <a href ng-click="nextPage()">Next »</a>
                </li>
            </ul>
        </div>

    </div>

</aside>