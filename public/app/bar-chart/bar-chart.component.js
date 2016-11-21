System.register(['@angular/core', './chart.service'], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
        var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
        if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
        else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
        return c > 3 && r && Object.defineProperty(target, key, r), r;
    };
    var __metadata = (this && this.__metadata) || function (k, v) {
        if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
    };
    var core_1, chart_service_1;
    var BarChartComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (chart_service_1_1) {
                chart_service_1 = chart_service_1_1;
            }],
        execute: function() {
            BarChartComponent = (function () {
                function BarChartComponent(_chartService) {
                    this._chartService = _chartService;
                    this.type = 'bar';
                    this.legend = true;
                    this.options = {
                        scaleShowVerticalLines: false,
                        responsive: true
                    };
                    this.labels = new Array();
                    this.datasets = new Array();
                    this.datasets.push({
                        data: new Array(),
                        label: ""
                    });
                }
                BarChartComponent.prototype.ngOnInit = function () {
                    var _this = this;
                    this._chartService.getChart(this.name)
                        .subscribe(function (chart) {
                        _this.labels = chart.labels;
                        _this.datasets = chart.datasets;
                    });
                };
                // events
                BarChartComponent.prototype.chartClicked = function (e) {
                    //console.log(e);
                };
                BarChartComponent.prototype.chartHovered = function (e) {
                    //console.log(e);
                };
                __decorate([
                    core_1.Input(), 
                    __metadata('design:type', String)
                ], BarChartComponent.prototype, "name", void 0);
                BarChartComponent = __decorate([
                    core_1.Component({
                        selector: 'bar-chart',
                        templateUrl: './views/bar-chart/bar-chart.component.html',
                    }), 
                    __metadata('design:paramtypes', [chart_service_1.ChartService])
                ], BarChartComponent);
                return BarChartComponent;
            }());
            exports_1("BarChartComponent", BarChartComponent);
        }
    }
});

//# sourceMappingURL=bar-chart.component.js.map
