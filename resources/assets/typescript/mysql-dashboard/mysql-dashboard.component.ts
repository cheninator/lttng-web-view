import { Component } from '@angular/core';
import { ChartGridItem } from './../gridstack/gridstack.model';

@Component({
    selector: 'mysql-dashboard',
    templateUrl: './templates/mysql-dashboard/mysql-dashboard.component.html',
})
export class MySQLDashboardComponent {

    private chartTiles: ChartGridItem[];
    
    constructor() { 
        
        this.chartTiles = [
            {
                title: "",
                chartType: "horizontalBar",
                name: "mysqltop:Database-Duration",
                count: 8,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "",
                chartType: "horizontalBar",
                name: "mysqltop:Return_values_count-Average_call_duration",
                count: 8,
                sort: "DESC",
                dataGsX: 6,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "",
                chartType: "horizontalBar",
                name: "mysqltop:Return_values_count-Call_count",
                count: 8,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 5,
                dataGsWidth: 6,
                dataGsHeight: 5,
            }
        ];
    }

    public addChartGridItem() {

    };
}