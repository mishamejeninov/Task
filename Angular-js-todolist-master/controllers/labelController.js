App.controller('labelController', ["dataService", "$scope", "$location", "$http",
    function(dataService, $scope, $location, $http) {

        $scope.labels = [];

        dataService.getLabels()
            .then(function(data) {
                if (data) {
                    $scope.labels = data;
                } else {
                    $location.path('/login');
                }
            });

        $scope.editLLabel = function(label) {
            var id = label.lb_id;
            // console.log(todo);
            $http.put('CI/index.php/label/' + id, label)
                .then(function(res) {
                    if (res.data.success) {
                        console.log(res);
                    } else {

                    }
                });
        };

        $scope.addNew = function() {
            $http.post('CI/index.php/label/', $scope.newLabel)
                .success(function(data) {

                    $scope.labels.push({
                        lb_name: $scope.newLabel.lb_name,
                        l_id: data
                    });
                    $scope.newLabel = '';

                });

        };

        $scope.deleteLabel = function(lb_id) {

            $scope.labels.splice(this.$index, 1);
            $http.delete('CI/index.php/label/' + lb_id)
                .success(function(data) {

                })
                .error(function(data) {
                    console.log('Error: ' + data);
                });
        };

    }
]);
