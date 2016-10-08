App.run(function(defaultErrorMessageResolver) {
    defaultErrorMessageResolver.getErrorMessages().then(function(errorMessages) {
        errorMessages['bademail'] = 'Please enter a valid email address';
    });
});

App.controller('loginController', ["$scope", "$location", "$http", "$window", "dataService",
    function($scope, $location, $http, $window, dataService) {
        $scope.regex = '^[a-z0-9-._]+@[a-z0-9-]+.[a-z]{3}$';
        $scope.email = false;
        $scope.login = function() {
            $http.post('CI/index.php/login', $scope.formModel)

            .then(function(res) {
                if (res.data.success) {
                    dataService.getUserData()
                        .then(function(data) {

                            if (data.role) {
                                $scope.users = data.role;
                                $window.location.reload();
                                $location.path('/users');
                            } else {
                                $window.location.reload();
                                $location.path('/task');
                            }

                        });


                } else {
                    $scope.email = true;
                    $scope.error = "Your Password or eMail not correct";
                }

            });



        };
    }
]);
