webpackJsonp([0],{

/***/ 0:
/***/ function(module, exports, __webpack_require__) {

	"use strict";
	var platform_browser_dynamic_1 = __webpack_require__(1);
	var app_module_1 = __webpack_require__(23);
	platform_browser_dynamic_1.platformBrowserDynamic().bootstrapModule(app_module_1.AppModule);


/***/ },

/***/ 23:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(__decorate) {"use strict";
	var core_1 = __webpack_require__(3);
	var platform_browser_1 = __webpack_require__(21);
	var forms_1 = __webpack_require__(25);
	var app_routing_1 = __webpack_require__(29);
	var app_component_1 = __webpack_require__(69);
	var feature_list_component_1 = __webpack_require__(60);
	var feature_component_1 = __webpack_require__(65);
	var feature_service_1 = __webpack_require__(62);
	var home_component_1 = __webpack_require__(67);
	var AppModule = (function () {
	    function AppModule() {
	    }
	    return AppModule;
	}());
	AppModule = __decorate([
	    core_1.NgModule({
	        imports: [
	            platform_browser_1.BrowserModule,
	            forms_1.FormsModule,
	            app_routing_1.routing
	        ],
	        declarations: [
	            app_component_1.AppComponent,
	            feature_list_component_1.FeatureListComponent,
	            feature_component_1.FeatureComponent,
	            home_component_1.HomeComponent
	        ],
	        providers: [
	            app_routing_1.appRoutingProviders,
	            feature_service_1.FeatureService
	        ],
	        bootstrap: [
	            app_component_1.AppComponent
	        ]
	    })
	], AppModule);
	exports.AppModule = AppModule;
	
	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(24)))

/***/ },

/***/ 24:
/***/ function(module, exports) {

	function __decorate(decorators, target, key, desc) {
	    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
	    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
	    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
	    return c > 3 && r && Object.defineProperty(target, key, r), r;
	};
	
	if (typeof module !== 'undefined' && module.exports) {
	    exports = module.exports = __decorate;
	}
	
	exports.__decorate = __decorate;

/***/ },

/***/ 29:
/***/ function(module, exports, __webpack_require__) {

	"use strict";
	var router_1 = __webpack_require__(30);
	var feature_list_component_1 = __webpack_require__(60);
	var feature_component_1 = __webpack_require__(65);
	var home_component_1 = __webpack_require__(67);
	var appRoutes = [
	    { path: '', component: home_component_1.HomeComponent },
	    { path: 'features', component: feature_list_component_1.FeatureListComponent },
	    { path: 'features/:id', component: feature_component_1.FeatureComponent }
	];
	exports.appRoutingProviders = [];
	exports.routing = router_1.RouterModule.forRoot(appRoutes);


/***/ },

/***/ 60:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(__decorate, __metadata) {"use strict";
	var core_1 = __webpack_require__(3);
	var feature_service_1 = __webpack_require__(62);
	var FeatureListComponent = (function () {
	    function FeatureListComponent(_featureService) {
	        this._featureService = _featureService;
	    }
	    FeatureListComponent.prototype.ngOnInit = function () {
	        this.features = this._featureService.getFeatures();
	    };
	    return FeatureListComponent;
	}());
	FeatureListComponent = __decorate([
	    core_1.Component({
	        template: __webpack_require__(63),
	        styles: [__webpack_require__(64)]
	    }),
	    __metadata("design:paramtypes", [feature_service_1.FeatureService])
	], FeatureListComponent);
	exports.FeatureListComponent = FeatureListComponent;
	
	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(24), __webpack_require__(61)))

/***/ },

/***/ 61:
/***/ function(module, exports) {

	function __metadata(k, v) {
	    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
	};
	
	if (typeof module !== 'undefined' && module.exports) {
	    exports = module.exports = __metadata;
	}
	
	exports.__metadata = __metadata;

/***/ },

/***/ 62:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(__decorate) {"use strict";
	var core_1 = __webpack_require__(3);
	var Feature = (function () {
	    function Feature(id, description) {
	        this.id = id;
	        this.description = description;
	    }
	    return Feature;
	}());
	exports.Feature = Feature;
	var FeatureService = (function () {
	    function FeatureService() {
	        this._features = [
	            new Feature(1, 'Easy installation via script'),
	            new Feature(2, 'Bundling with Webpack'),
	            new Feature(3, 'Require Angular templates and styles external files')
	        ];
	    }
	    FeatureService.prototype.getFeatures = function () { return this._features; };
	    FeatureService.prototype.getFeature = function (id) {
	        return this._features.find(function (feature) { return feature.id === +id; });
	    };
	    return FeatureService;
	}());
	FeatureService = __decorate([
	    core_1.Injectable()
	], FeatureService);
	exports.FeatureService = FeatureService;
	
	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(24)))

/***/ },

/***/ 63:
/***/ function(module, exports) {

	module.exports = "<p>Feature list:</p>\n<ul>\n\t<li *ngFor=\"let feature of features\">\n\t\t<a [routerLink]=\"['/features', feature.id]\">{{ feature.description }}</a>\n\t</li>\n</ul>\n<hr>\n<p><a routerLink='/'>Go to homepage</a></p>"

/***/ },

/***/ 64:
/***/ function(module, exports) {

	module.exports = "li {\n  font-size: 80%; }\n"

/***/ },

/***/ 65:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(__decorate, __metadata) {"use strict";
	var core_1 = __webpack_require__(3);
	var feature_service_1 = __webpack_require__(62);
	var router_1 = __webpack_require__(30);
	var FeatureComponent = (function () {
	    function FeatureComponent(_route, _router, _featureService) {
	        this._route = _route;
	        this._router = _router;
	        this._featureService = _featureService;
	    }
	    FeatureComponent.prototype.ngOnInit = function () {
	        var _this = this;
	        this._sub = this._route.params.subscribe(function (params) {
	            var id = +params['id'];
	            _this.feature = _this._featureService.getFeature(id);
	        });
	    };
	    FeatureComponent.prototype.ngOnDestroy = function () {
	        this._sub.unsubscribe();
	    };
	    return FeatureComponent;
	}());
	FeatureComponent = __decorate([
	    core_1.Component({
	        template: __webpack_require__(66)
	    }),
	    __metadata("design:paramtypes", [router_1.ActivatedRoute,
	        router_1.Router,
	        feature_service_1.FeatureService])
	], FeatureComponent);
	exports.FeatureComponent = FeatureComponent;
	
	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(24), __webpack_require__(61)))

/***/ },

/***/ 66:
/***/ function(module, exports) {

	module.exports = "<div>\n\t<label>Feature description: </label>\n\t<input [(ngModel)]='feature.description' placeholder=\"description\">\n</div>\n<p><button routerLink='/features'>Back to features</button></p>"

/***/ },

/***/ 67:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(__decorate) {"use strict";
	var core_1 = __webpack_require__(3);
	var HomeComponent = (function () {
	    function HomeComponent() {
	    }
	    return HomeComponent;
	}());
	HomeComponent = __decorate([
	    core_1.Component({
	        template: __webpack_require__(68)
	    })
	], HomeComponent);
	exports.HomeComponent = HomeComponent;
	
	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(24)))

/***/ },

/***/ 68:
/***/ function(module, exports) {

	module.exports = ""

/***/ },

/***/ 69:
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(__decorate) {"use strict";
	var core_1 = __webpack_require__(3);
	var AppComponent = (function () {
	    function AppComponent() {
	    }
	    return AppComponent;
	}());
	AppComponent = __decorate([
	    core_1.Component({
	        selector: 'my-app',
	        template: __webpack_require__(70)
	    })
	], AppComponent);
	exports.AppComponent = AppComponent;
	
	/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(24)))

/***/ },

/***/ 70:
/***/ function(module, exports) {

	module.exports = "<div class=\"container body\">\n\t<div class=\"main_container\">\n\t\t<div class=\"col-md-3 left_col\">\n\t\t\t<div class=\"left_col scroll-view\">\n\t\t\t\t<div class=\"navbar nav_title\">\n\t\t\t\t\t<a href=\"index.html\" class=\"site_title\"><i class=\"fa fa-paw\"></i> <span>LTTng Web View</span></a>\n\t\t\t\t</div>\n\t\t\t    <div class=\"clearfix\"></div>\n\t\t\t\t<!-- sidebar menu -->\n\t\t\t\t<div id=\"sidebar-menu\" class=\"main_menu_side hidden-print main_menu\">\n\t\t\t\t\t<div class=\"menu_section active\">\n\t\t\t\t\t\t<h3>Dashboards</h3>\n\t\t\t\t\t\t<ul class=\"nav side-menu\" style=\"\">\n\t\t\t\t\t\t\t<li class=\"active\"><a><i class=\"fa fa-home\"></i> Home <span class=\"fa fa-chevron-down\"></span></a>\n\t\t\t\t\t\t\t\t<ul class=\"nav child_menu\" style=\"display: block;\">\n\t\t\t\t\t\t\t\t\t<li class=\"current-page\"><a href=\"index.html\">Dashboard</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"index2.html\">Dashboard2</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"index3.html\">Dashboard3</a></li>\n\t\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t<li><a><i class=\"fa fa-edit\"></i> Forms <span class=\"fa fa-chevron-down\"></span></a>\n\t\t\t\t\t\t\t\t<ul class=\"nav child_menu\">\n\t\t\t\t\t\t\t\t\t<li><a href=\"form.html\">General Form</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"form_advanced.html\">Advanced Components</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"form_validation.html\">Form Validation</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"form_wizards.html\">Form Wizard</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"form_upload.html\">Form Upload</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"form_buttons.html\">Form Buttons</a></li>\n\t\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t<li><a><i class=\"fa fa-desktop\"></i> UI Elements <span class=\"fa fa-chevron-down\"></span></a>\n\t\t\t\t\t\t\t\t<ul class=\"nav child_menu\">\n\t\t\t\t\t\t\t\t\t<li><a href=\"general_elements.html\">General Elements</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"media_gallery.html\">Media Gallery</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"typography.html\">Typography</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"icons.html\">Icons</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"glyphicons.html\">Glyphicons</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"widgets.html\">Widgets</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"invoice.html\">Invoice</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"inbox.html\">Inbox</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"calendar.html\">Calendar</a></li>\n\t\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t<li><a><i class=\"fa fa-table\"></i> Tables <span class=\"fa fa-chevron-down\"></span></a>\n\t\t\t\t\t\t\t\t<ul class=\"nav child_menu\">\n\t\t\t\t\t\t\t\t\t<li><a href=\"tables.html\">Tables</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"tables_dynamic.html\">Table Dynamic</a></li>\n\t\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t<li><a><i class=\"fa fa-bar-chart-o\"></i> Data Presentation <span class=\"fa fa-chevron-down\"></span></a>\n\t\t\t\t\t\t\t\t<ul class=\"nav child_menu\">\n\t\t\t\t\t\t\t\t\t<li><a href=\"chartjs.html\">Chart JS</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"chartjs2.html\">Chart JS2</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"morisjs.html\">Moris JS</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"echarts.html\">ECharts</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"other_charts.html\">Other Charts</a></li>\n\t\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t<li><a><i class=\"fa fa-clone\"></i>Layouts <span class=\"fa fa-chevron-down\"></span></a>\n\t\t\t\t\t\t\t\t<ul class=\"nav child_menu\">\n\t\t\t\t\t\t\t\t\t<li><a href=\"fixed_sidebar.html\">Fixed Sidebar</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"fixed_footer.html\">Fixed Footer</a></li>\n\t\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t</ul>\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"menu_section\">\n\t\t\t\t\t\t<h3>Live On</h3>\n\t\t\t\t\t\t<ul class=\"nav side-menu\">\n\t\t\t\t\t\t\t<li><a><i class=\"fa fa-bug\"></i> Additional Pages <span class=\"fa fa-chevron-down\"></span></a>\n\t\t\t\t\t\t\t\t<ul class=\"nav child_menu\">\n\t\t\t\t\t\t\t\t\t<li><a href=\"e_commerce.html\">E-commerce</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"projects.html\">Projects</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"project_detail.html\">Project Detail</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"contacts.html\">Contacts</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"profile.html\">Profile</a></li>\n\t\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t<li><a><i class=\"fa fa-windows\"></i> Extras <span class=\"fa fa-chevron-down\"></span></a>\n\t\t\t\t\t\t\t\t<ul class=\"nav child_menu\">\n\t\t\t\t\t\t\t\t\t<li><a href=\"page_403.html\">403 Error</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"page_404.html\">404 Error</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"page_500.html\">500 Error</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"plain_page.html\">Plain Page</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"login.html\">Login Page</a></li>\n\t\t\t\t\t\t\t\t\t<li><a href=\"pricing_tables.html\">Pricing Tables</a></li>\n\t\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t<li><a><i class=\"fa fa-sitemap\"></i> Multilevel Menu <span class=\"fa fa-chevron-down\"></span></a>\n\t\t\t\t\t\t\t\t<ul class=\"nav child_menu\">\n\t\t\t\t\t\t\t\t\t<li><a href=\"#level1_1\">Level One</a>\n\t\t\t\t\t\t\t\t\t</li><li><a>Level One<span class=\"fa fa-chevron-down\"></span></a>\n\t\t\t\t\t\t\t\t\t\t<ul class=\"nav child_menu\">\n\t\t\t\t\t\t\t\t\t\t\t<li class=\"sub_menu\"><a href=\"level2.html\">Level Two</a>\n\t\t\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#level2_1\">Level Two</a>\n\t\t\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"#level2_2\">Level Two</a>\n\t\t\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t</ul>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t\t<!-- /sidebar menu -->\n\t\t\t</div>\n\t\t</div>\n\n\t\t<!-- top navigation -->\n\t\t<div class=\"top_nav\">\n\t\t\t<div class=\"nav_menu\">\n\t\t\t\t<nav class=\"\" role=\"navigation\">\n\t\t\t\t\t<div class=\"nav toggle\">\n\t\t\t\t\t\t<a id=\"menu_toggle\"><i class=\"fa fa-bars\"></i></a>\n\t\t\t\t\t</div>\n\t\t\t\t</nav>\n\t\t\t</div>\n\t\t</div>\n\t\t<!-- /top navigation -->\n\n\t\t<!-- page content -->\n\t\t<div class=\"right_col\" role=\"main\" style=\"min-height: 1647px;\">\n\t\t\t<!-- top tiles -->\n\t\t\t<div class=\"row tile_count\">\n\t\t\t\t<div class=\"col-md-2 col-sm-4 col-xs-6 tile_stats_count\">\n\t\t\t\t\t<span class=\"count_top\"><i class=\"fa fa-user\"></i> Total Users</span>\n\t\t\t\t\t<div class=\"count\">2500</div>\n\t\t\t\t\t<span class=\"count_bottom\"><i class=\"green\">4% </i> From last Week</span>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"col-md-2 col-sm-4 col-xs-6 tile_stats_count\">\n\t\t\t\t\t<span class=\"count_top\"><i class=\"fa fa-clock-o\"></i> Average Time</span>\n\t\t\t\t\t<div class=\"count\">123.50</div>\n\t\t\t\t\t<span class=\"count_bottom\"><i class=\"green\"><i class=\"fa fa-sort-asc\"></i>3% </i> From last Week</span>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"col-md-2 col-sm-4 col-xs-6 tile_stats_count\">\n\t\t\t\t\t<span class=\"count_top\"><i class=\"fa fa-user\"></i> Total Males</span>\n\t\t\t\t\t<div class=\"count green\">2,500</div>\n\t\t\t\t\t<span class=\"count_bottom\"><i class=\"green\"><i class=\"fa fa-sort-asc\"></i>34% </i> From last Week</span>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"col-md-2 col-sm-4 col-xs-6 tile_stats_count\">\n\t\t\t\t\t<span class=\"count_top\"><i class=\"fa fa-user\"></i> Total Females</span>\n\t\t\t\t\t<div class=\"count\">4,567</div>\n\t\t\t\t\t<span class=\"count_bottom\"><i class=\"red\"><i class=\"fa fa-sort-desc\"></i>12% </i> From last Week</span>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"col-md-2 col-sm-4 col-xs-6 tile_stats_count\">\n\t\t\t\t\t<span class=\"count_top\"><i class=\"fa fa-user\"></i> Total Collections</span>\n\t\t\t\t\t<div class=\"count\">2,315</div>\n\t\t\t\t\t<span class=\"count_bottom\"><i class=\"green\"><i class=\"fa fa-sort-asc\"></i>34% </i> From last Week</span>\n\t\t\t\t</div>\n\t\t\t\t<div class=\"col-md-2 col-sm-4 col-xs-6 tile_stats_count\">\n\t\t\t\t\t<span class=\"count_top\"><i class=\"fa fa-user\"></i> Total Connections</span>\n\t\t\t\t\t<div class=\"count\">7,325</div>\n\t\t\t\t\t<span class=\"count_bottom\"><i class=\"green\"><i class=\"fa fa-sort-asc\"></i>34% </i> From last Week</span>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t\t<!-- /top tiles -->\n        </div>\n\t\t<!-- /page content -->\n\t</div>\n</div>\n<router-outlet></router-outlet>"

/***/ }

});
//# sourceMappingURL=app.js.map