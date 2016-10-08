//controllers
App.controller("taskController", ["dataService", "$scope", "$filter", "$location", "$http",
    function(dataService, $scope, $filter, $location, $http) {

        $scope.tasks = [];

        dataService.getLabels()
            .then(function(data) {
                $scope.labels = data;
                console.log($scope.labels);
            });

        $http.get('CI/index.php/tasks/')
            .then(function(res) {
                //  console.log(res);
                if (res.data.success) {
                    $scope.tasks = res.data.task;
                } else {
                    $location.path('/login');
                }
            });

        $scope.addNew = function() {
            $scope.newTask.t_due_date = new Date($scope.dt);
            $http.post('CI/index.php/tasks/', $scope.newTask)
                .then(function(data) {
                    console.log(data);
                    $scope.tasks.push({
                        t_subject: $scope.newTask.t_subject,
                        lb_name: data.data.lb_name,
                        t_id: data,
                        t_due_date: $scope.newTask.t_due_date,

                    });
                    $scope.newTask = '';
                });

        };
        $scope.editTask = function(todo) {
            var id = todo.t_id;
            $http.put('CI/index.php/tasks/' + id, todo)
                .then(function(res) {
                    if (res.data.success) {
                        console.log(res);
                    } else {}

                });

        };

        $scope.deleteTask = function(t_id) {
            console.log(t_id);
            $scope.tasks.splice(this.$index, 1);
            $http.delete('CI/index.php/tasks/' + t_id)
                .success(function(data) {

                })
                .error(function(data) {
                    console.log('Error: ' + data);
                });

        };

        $scope.today = function() {
            $scope.dt = new Date();
        };
        $scope.today();

        $scope.clear = function() {
            scope.dt = null;
        };

        $scope.dateOptions = {
            showWeeks: false,
            formatYear: 'yy',
            maxDate: new Date(2020, 5, 22),
            minDate: new Date(),
            startingDay: 1
        };

        $scope.open = function() {
            $scope.popup.opened = true;
        };

        $scope.openEditDate = function() {
            $scope.popupEditDate.opened = true;
        };

        $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
        $scope.format = $scope.formats[0];
        $scope.altInputFormats = ['M!/d!/yyyy'];

        $scope.popup = {
            opened: false
        };

        $scope.popupEditDate = {
            opened: false
        };

    }
]);
