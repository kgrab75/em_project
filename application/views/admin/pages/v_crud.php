<aside class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 crud" ng-init="init('<?php echo $table; ?>')">

    <button type="button" class="btn btn-success btn-lg add" ng-click="dataAdd()">
        <span class="glyphicon glyphicon-plus"></span> Ajouter un Eco-acteur
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th ng-repeat="table in tableInfos">
                    {{table.Field}}
                </th>
            </tr>
        </thead>
        <tbody>

            <tr ng-repeat="(keyData, data) in datas" ng-class="{'bg-danger': data.dataDelete == 1, 'bg-add': data.dataAdd == 1}">
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
                <td>
                    <button type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <button type="button" class="btn btn-orange btn-lg save pull-right" ng-click="dataSave('<?php echo $table; ?>')">
        <span class="glyphicon glyphicon-save"></span> Sauvegarder
    </button>

</aside>