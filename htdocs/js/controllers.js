'use strict';

/* Controllers */
function MainCtrl($scope, $http) {
	$scope.name ='test';
}
function UsersCtrl($scope, $http) {
}
function UserCreateCtrl($scope, $http) {
}
function UserGroupCtrl($scope, $http) {
}
function BrandsCtrl($scope, $http) {
}
function BrandsCreateCtrl($scope, $http) {
}
function BanersCtrl($scope, $http) {
}
function BanersCreateCtrl($scope, $http) {
}
function SearchCtrl($scope, $http) {
	$scope.ShowOriginals = function(search){
		$scope.result = search;
		var url = '/admin/GetOriginals';
		$http({method: 'POST',url: url,data: search,headers: {'Content-Type': 'application/x-www-form-urlencoded'}}).success(function(response){
			$scope.result = response+' '+search;
			$scope.originals = response;
			$scope.loading = false;
		});
	};
}
function SearchAnalitikCtrl($scope, $routeParams,$http) {
	$scope.brandId = $routeParams.brandId;
	$scope.str = $routeParams.str;
	var data = {str:$scope.str,brand_id:$scope.brandId};
	$http({method: 'POST',url: '/admin/GetAnalogs/1',data: data,headers: {'Content-Type': 'application/x-www-form-urlencoded'}}).success(function(response){
			$scope.original_numbers = response;
			$scope.loading = false;
		});
	$http({method: 'POST',url: '/admin/GetAnalogs/2',data: data,headers: {'Content-Type': 'application/x-www-form-urlencoded'}}).success(function(response){
			$scope.tecdok_cross = response;
			$scope.loading = false;
		});
	$http({method: 'POST',url: '/admin/GetAnalogs/3',data: data,headers: {'Content-Type': 'application/x-www-form-urlencoded'}}).success(function(response){
			$scope.rik_sklad = response;
			$scope.loading = false;
		});
	$http({method: 'POST',url: '/admin/GetAnalogs/4',data: data,headers: {'Content-Type': 'application/x-www-form-urlencoded'}}).success(function(response){
			$scope.result = response;
			$scope.rik_alt = response;
			$scope.loading = false;
		});
	$scope.changUse = function(item){
		alert(item);
	};
}
function SearchSkladCtrl($scope, $http) {
}
function SearchPriceCtrl($scope, $http) {
}
function SkladsCtrl($scope, $http) {
}
function SkladsCreateCtrl($scope, $http) {
}

function UserDetailCtrl($scope, $routeParams,$http,$location) {
}
function BrandsDetailCtrl($scope, $routeParams,$http,$location) {
}
function BanersDetailCtrl($scope, $routeParams,$http,$location) {
}
function SkladsDetailCtrl($scope, $routeParams,$http,$location) {
}
function UserGroupDetailCtrl($scope, $routeParams,$http,$location) {
}