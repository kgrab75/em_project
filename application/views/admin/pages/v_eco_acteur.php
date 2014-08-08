<aside class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 crud">

    <button type="button" class="btn btn-success btn-lg add">
        <span class="glyphicon glyphicon-plus"></span> Ajouter un Eco-acteur
    </button>

    <button type="button" class="btn btn-success btn-lg add" ng-init="init('<?php echo $table; ?>')">
        <span class="glyphicon glyphicon-plus"></span> Infomartion table
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
            <tr ng-repeat="data in datas">
                <td ng-repeat="(key, value) in tableInfos">
                    <div class="data" ng-show="!clicked" ng-click="clicked=true">
                        <span ng-if="value.Field != 'id'" class="fa fa-pencil" ></span>
                        <span>{{data[value.Field]|limitTo:20}}</span>
                        <span ng-if="data[value.Field].length >= 20">...</span>
                    </div>

                    <div class="update" ng-show="clicked">
                        <input type="text" ng-blur="clicked=false" value="{{data[value.Field]}}" focus-if="clicked"/>
                    </div>
                </td>

                <td>
                    <button type="button" class="btn btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
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

    <button type="button" class="btn btn-orange btn-lg save pull-right">
        <span class="glyphicon glyphicon-save"></span> Sauvegarder
    </button>

</aside>