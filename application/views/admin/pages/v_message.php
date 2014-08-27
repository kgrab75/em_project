<aside class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 crud" ng-init="init('<?php echo $table; ?>')">

    <table class="table table-bordered">
        <thead>
            <tr class="message">
                <td>Statut</td>
                <td ng-repeat="field in ['prénom', 'nom', 'email', 'objet']">
                    {{field}}
                </td>
                <td>
                    &nbsp;
                </td>

            </tr>
        </thead>
    </table>

    <div class="panel-group" id="accordion">
        <div class="panel panel-default"  ng-repeat="(keyData, data) in datas">
            <div class="panel-heading">
                <table class="table table-bordered">
                    <tbody>
                        <tr class="message" ng-class="{'bg-danger': data.status == 0, 'bg-success': data.status == 1}">

                            <td ng-if="data.status == 0">Non-lu</td>
                            <td ng-if="data.status == 1">Lu</td>


                            <td ng-repeat="field in ['prenom', 'nom', 'email', 'objet']" ng-class="{'bg-success': data.dataUpdated[value.Field] == 1, 'bg-danger': data.dataDelete == 1}">

                                <div class="data">
                                    <span>{{data[field]}}</span>
                                </div>

                            </td>

                            <td>
                                <a data-toggle="collapse" data-parent="#accordion" href="#id_{{data.id}}" class="btn btn-primary" ng-click="toggleMessage(data.id)">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                            </td>

                        </tr>
                    <tbody>
                </table>
            </div>
            <div id="id_{{data.id}}" class="panel-collapse collapse">
                <div class="panel-body">
                    {{data.message}}
                </div>
            </div>
        </div>
    </div>

</aside>