
App.factory('dataService', function($http) {
    var getLabels = function() {
        return $http.get('CI/index.php/Label/')
            .then(function(res) {
                return res.data.label;
            });
    };

    var getUserData = function() {
        return $http.get('CI/index.php/Data/')
            .then(function(res) {
                return res.data;
            });
    };


    return {
        getLabels: getLabels,
        getUserData: getUserData

    };
});
