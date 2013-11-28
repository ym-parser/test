'use strict';

/* App Module */
angular.module('adminka', []).
  config(['$routeProvider', function($routeProvider) {
  $routeProvider.
      when('/main', {templateUrl: '/admin/main',   controller: MainCtrl}).
	  when('/users', {templateUrl: '/admin/users',   controller: UsersCtrl}).
	  when('/users/create', {templateUrl: '/admin/usercreate',   controller: UserCreateCtrl}).
	  when('/users/detail/:userId', {templateUrl: '/admin/userdetail',   controller: UserDetailCtrl}).
	  when('/users/groups', {templateUrl: '/admin/usgroups',   controller: UserGroupCtrl}).
	  when('/users/groups/detail/:groupId', {templateUrl: '/admin/usergrdetail',   controller: UserGroupDetailCtrl}).
	  when('/brands', {templateUrl: '/admin/brands',   controller: BrandsCtrl}).
	  when('/brands/create', {templateUrl: '/admin/brandcreate',   controller: BrandsCreateCtrl}).
	  when('/brands/detail/:brandId', {templateUrl: '/admin/branddetail',   controller: BrandsDetailCtrl}).
	  when('/baners', {templateUrl: '/admin/baners',   controller: BanersCtrl}).
	  when('/baners/create', {templateUrl: '/admin/banercreate',   controller: BanersCreateCtrl}).
	  when('/baners/detail/:banerId', {templateUrl: '/admin/banerdetail',   controller: BanersDetailCtrl}).
	  when('/search', {templateUrl: '/admin/search',   controller: SearchCtrl}).
	  when('/search/analitik/:str/:brandId', {templateUrl: '/admin/searchanalitik',   controller: SearchAnalitikCtrl}).
	  when('/search/sklad', {templateUrl: '/admin/searchsklad',   controller: SearchSkladCtrl}).
	  when('/search/price', {templateUrl: '/admin/searchprice',   controller: SearchPriceCtrl}).
	  when('/sklads', {templateUrl: '/admin/sklads',   controller: SkladsCtrl}).
	  when('/sklads/create', {templateUrl: '/admin/skladscreate',   controller: SkladsCreateCtrl}).
	  when('/sklads/detail/:skladId', {templateUrl: '/admin/skladsdetail',   controller: SkladsDetailCtrl}).
      otherwise({redirectTo: '/main'});
}]);