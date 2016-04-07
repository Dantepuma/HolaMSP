
var helloEstepona = angular.module( "helloEstepona", ['ui.bootstrap'] );
helloEstepona.controller( "OrderCtrl", [ '$scope', '$http', function($scope, $http) {

    //Set menu and assign active the first element
    $scope.menuItems = ['Ewallet', 'Transaction info', 'Payment Details', 'Customer info', 'Customer delivery', 'Shopping cart'];
    $scope.activeMenu = $scope.menuItems[0];

    $scope.menulinks = {'Ewallet': 'ewallet', 'Transaction info': 'transaction', 'Payment Details': 'paymentdetails',
                        'Customer info': 'customer', 'Customer delivery': 'customer-delivery',
                        'Shopping cart': 'checkoutdata'}

    //Set the active class and load data
    $scope.setActive = function(menuItem) {
    $scope.activeMenu = menuItem;
    $scope.xmldata = $scope.fulldata[$scope.menulinks[menuItem]];
      if(menuItem === "Shopping cart") {
        $scope.xmldata = $scope.xmldata['shopping-cart']['items']['item'];
      }
    }

    $http({
    url: 'module/getdata.php',
    method: "GET"
    }).then(function(res) {
          // upload the first ewalett and the data to an array
          $scope.xmldata = res.data.ewallet;
          $scope.fulldata = res.data;
          console.log('Data successfully loaded');
    });

}]);
