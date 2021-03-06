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
                title: "Top database request duration",
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
                title: "Top query count",
                chartType: "horizontalBar",
                name: "mysqltop:Query-Call_count",
                count: 16,
                sort: "DESC",
                dataGsX: 6,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "Call duration standard deviation",
                chartType: "horizontalBar",
                name: "mysqltop:Query-Call_duration_standard_deviation",
                count: 8,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 5,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "Average call duration per query",
                chartType: "horizontalBar",
                name: "mysqltop:Query-Average_call_duration",
                count: 16,
                sort: "DESC",
                dataGsX: 6,
                dataGsY: 5,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },     
            {
                title: "Top query duration",
                chartType: "horizontalBar",
                name: "mysqltop:Query-Duration",
                count: 16,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 10,
                dataGsWidth: 12,
                dataGsHeight: 9,
            }
        ];
    }
}