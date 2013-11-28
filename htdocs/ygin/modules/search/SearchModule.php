<?php

class SearchModule extends DaWebModuleAbstract {

  const ROUTE_SEARCH_VIEW = 'search/search/index';
  const ROUTE_ARTICLES_VIEW = 'search/articles/index';
  const ROUTE_CATALOG = 'search/catalog/index';
  const ROUTE_CATALOG_MAIN_JSON = 'search/catalog/MainJson';
  const ROUTE_CATALOG_TREE = 'search/catalog/tree';
  const ROUTE_CATALOG_TREE_JSON = 'search/catalog/TreeJson';
  
  protected $_urlRules = array(
	'search' => SearchModule::ROUTE_SEARCH_VIEW,
	'search/articles' => SearchModule::ROUTE_ARTICLES_VIEW,
	'catalog/main' => SearchModule::ROUTE_CATALOG,
	'catalog/main/<mfaId:\d+>' => SearchModule::ROUTE_CATALOG,
	'catalog/main/<mfaId:\d+>/<modId:\d+>' => SearchModule::ROUTE_CATALOG,
	'catalog/mainJson' => SearchModule::ROUTE_CATALOG_MAIN_JSON,
	'catalog/treeJson' => SearchModule::ROUTE_CATALOG_TREE_JSON,
	'catalog/tree' => SearchModule::ROUTE_CATALOG_TREE,
	'catalog/tree/<typId:\d+>' => SearchModule::ROUTE_CATALOG_TREE,
	'catalog/tree/<typId:\d+>/<node:\d+>' => SearchModule::ROUTE_CATALOG_TREE,
  );
  public $lengthPreview = 200;
  public $queryMin = 3;
  public $queryMax = 255;
  public $highlight = '<span class="label label-info">%s</span>';
  public $pageSize = 20;
  public $logQuery = true;

  public $searchModeEnable = false;

  /**
   * @var int Количество данных, получаемых за один запрос, при полной переиндексации поискового индекса
   */
  public $searchDataPortion = 1000;

  public $objectNotSearch = array(
    512, 505, 504, 506,
  );
  public $objectSearchList = array();

  public function init() {
    $this->setImport(array(
        'search.models.Search',
        'search.models.SearchHistory',
        'search.widgets.search.SearchWidget',
        'search.components.SearchComponent',
    ));
  }

}
