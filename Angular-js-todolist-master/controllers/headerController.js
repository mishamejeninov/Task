App.controller('headerController', ["$scope", "$location", "$http", "$window", "dataService",
    function($scope, $location, $http, $window, dataService) {


        $scope.isActive = function(viewLocation) {
            return viewLocation === $location.path();
        };

        dataService.getUserData()
            .then(function(data) {
                $scope.user = data.name;
                // console.log(data.role);
                if (data.role) {
                    $scope.users = data.role;

                }
            });
        $scope.logout = function() {
            $http.get('CI/index.php/login/')
                .then(function(res) {
                    if (res.data.success) {
                        $window.location.reload();
                        $location.path('/login');
                    } else {

                    }

                });



        };
    }
]);
