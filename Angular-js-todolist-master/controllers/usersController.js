  App.controller('usersController', ["$scope", "$location", "$http", "dataService",
      function($scope, $location, $http, dataService) {

          $scope.isActive = function(viewLocation) {
              return viewLocation === $location.path();
          };

          $scope.users = [];

          $http.get('CI/index.php/users/', $scope.new)
              .then(function(res) {

                  if (res.data.success) {
                      $scope.users = res.data.users;

                  } else {
                      $location.path('/login');
                  }
              });

          $scope.editUser = function(user) {
              var id = user.u_id;

              $http.put('CI/index.php/users/' + id, user)
                  .then(function(res) {
                      if (res.data.success) {
                          console.log(res);
                      } else {

                      }
                  });
          };

          $scope.deleteTask = function(u_id) {
              console.log(u_id);

              $scope.users.splice(this.$index, 1);
              $http.delete('CI/index.php/users/' + u_id)
                  .success(function(data) {

                  })
                  .error(function(data) {
                      console.log('Error: ' + data);
                  });
          };
      }
  ]);
