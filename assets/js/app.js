angular.module("test-app", ['ngRoute'])
    .config(function($routeProvider, $locationProvider) {
        
        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });
        
        $routeProvider.
                when('/login', {
                    templateUrl: "/template/get/login",
                    controller: "LoginController"
                })
                .when('/cabinet', {
                    templateUrl: "/template/get/cabinet",
                    controller: "CabinetController"
                })
                .otherwise({
                    redirectTo: '/login'
                });

    }).factory('isAuthorized', function($http){
        
        return $http.get('/api/user/is_authorized');
                    
    }).controller('MainController', function($scope, $location, isAuthorized, $rootScope){
       
        isAuthorized.then(
            function success(response) {
                if(response.data.success){
                    $rootScope.profile = response.data.data;
                    $location.url('/cabinet');
                } else{
                    $location.url('/login');
                }
            }, 
            function error(response){
                console.error(response);
            }
        );

    }).controller('LoginController', function($scope, $http, $location, $rootScope){

        $scope.profile = {
            email: null,
            password: null,
            remember: null
        };
        
        $scope.authorize = function(profileData){
                        
            $http.post("/api/user/login", profileData)
                 .then(
                    function (response){
                        if(response.data.success){
                            $location.url('/cabinet');
                            $rootScope.profile = response.data.data;
                        } else {
                            alert(response.data.error);
                        }
                    },
                    function (response){
                        console.error(response);
                    }
                );   
        };

    }).controller('CabinetController', function($scope, $http, $location){

        $scope.view = 'profile';
        
        $scope.logout = function(){
            $http.get('/api/user/logout')
                 .then(
                    function (response){
                        if(response.data.success){
                            $location.url('/login');
                        } else {
                            alert(response.data.error);
                        }
                    },
                    function (response){
                        console.error(response);
                    }
                );
            
        };

    }).controller('ProfileController', function($scope, $http, $rootScope){

        $scope.profileMode = 'viewing';
        $scope.profile = {
            email: $rootScope.profile.email,
            name: $rootScope.profile.name,
            newEmail: null,
            newName: null
        };
        
        $scope.switchMode = function(mode){
            $scope.profileMode = mode;
        };
        $scope.profileSave = function(){
            
            if($scope.profile.email === $scope.profile.newEmail &&
               $scope.profile.name === $scope.profile.newName ) {
               $scope.switchMode('viewing');
               return;
            }

            $http.post("/api/user/profile/edit", $scope.profile)
                 .then(
                    function (response){
                        if(response.data.success){
                            var newName = response.data.data.name,
                                newEmail= response.data.data.email;
                        
                            $scope.profile.email = newEmail;
                            $scope.profile.name = newName;
                            $scope.profile.newEmail = null;
                            $scope.profile.newName = null;
                            
                            $rootScope.profile.name = newName;
                            $rootScope.profile.email = newEmail;
                            
                            $scope.switchMode('viewing');
                            
                        } else {
                            alert(response.data.error);
                        }
                    },
                    function (response){
                        console.error(response);
                    }
                );  
        }; 

    }).controller('OrdersController', function($scope){
        
        $scope.record = {
            rawData: {
                schema: ['ID', 'Products count', 'Price'],
                data:[  
                    [3254, 10, '1000 P.'],
                    [3255, 10, '1000 P.'],
                    [3256, 10, '1000 P.'],
                    [3257, 10, '1000 P.'],
                    [3258, 10, '1000 P.'],
                    [3259, 10, '1000 P.'],
                    [3260, 10, '1000 P.'],
                    [3261, 10, '1000 P.'],
                    [3262, 10, '1000 P.'],
                    [3263, 10, '1000 P.'],
                    [3264, 10, '1000 P.'],
                    [3265, 10, '1000 P.'],
                    [3266, 10, '1000 P.'],
                    [3267, 10, '1000 P.'],
                    [3268, 10, '1000 P.'],
                    [3269, 10, '1000 P.'],
                    [3270, 10, '1000 P.'],
                    [3271, 10, '1000 P.'],
                    [3272, 10, '1000 P.']
                ]
            },
            getRange: function(range){
                var min = range[0],
                    max = range[1];
            
                return this.rawData.data.slice(min, max + 1);
            },
            getItems: function(){
                return this.rawData.data;
            },
            getSchema: function(){
                return this.rawData.schema;
            }
        };

        $scope.sliceRanges = function(listSize, record) {

            var input = [],
                itemsNum = record.getItems().length;

            for (var i = 0; i <= itemsNum; ) {
                input.push([ i, i += listSize ]);
            }
            return input;
        };
                
        $scope.filterOrders = function(range, rangeKey) {
            $scope.orders = $scope.record.getRange(range);
            $scope.rangeKey = rangeKey; 
        };
        
        $scope.rangeKey = 0;    
        $scope.ranges = $scope.sliceRanges(7, $scope.record);
        $scope.orders = $scope.record.getRange($scope.ranges[0]);

    });


