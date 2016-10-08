App.run(function(defaultErrorMessageResolver) {
    defaultErrorMessageResolver.getErrorMessages().then(function(errorMessages) {
        errorMessages['bademail'] = 'Please enter a valid email address';
    });
});

App.controller('registerController', ["$scope", "$location", "$http",
    function($scope, $location, $http) {
        $scope.regex = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
        $scope.formModel = {};
        $scope.email = false;
        $scope.onSubmit = function() {
            $http.post('CI/index.php/register/', $scope.fromModel)
                .then(function(res) {
                    if (res.data.success) {
                        $location.path('/login');
                    } else {
                        $scope.email = true;
                    }

                });
        };
    }
]);
