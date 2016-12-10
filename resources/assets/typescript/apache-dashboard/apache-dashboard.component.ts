import { Component } from '@angular/core';
import { ChartGridItem } from './../gridstack/gridstack.model';

@Component({
    selector: 'apache-dashboard',
    templateUrl: './templates/apache-dashboard/apache-dashboard.component.html',
})
export class ApacheDashboardComponent {

    private chartTiles: ChartGridItem[];
    
    constructor() { 
        
        this.chartTiles = [
            {
                title: "Apache - Top request duration",
                chartType: "horizontalBar",
                name: "lamptop:Request_ID-Duration",
                count: 8,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "PHP - Top request duration",
                chartType: "horizontalBar",
                name: "lamptop:Request_ID-PHP_Execution_Duration",
                count: 8,
                sort: "DESC",
                dataGsX: 6,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "MySQL - Top table duration",
                chartType: "horizontalBar",
                name: "mysqltop:Table-Duration",
                count: 8,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 5,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "CPU - Usage per core",
                chartType: "horizontalBar",
                name: "cputop:CPU-CPU_usage",
                count: 8,
                sort: "NONE",
                dataGsX: 6,
                dataGsY: 5,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "PHP - Functions execution",
                chartType: "horizontalBar",
                name: "phptop:Function_Name-Function_duration",
                count: 8,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 10,
                dataGsWidth: 6,
                dataGsHeight: 5,
            }
        ];
    }

    public addChartGridItem() {

        var newWidget = { 
            title: "HELLOOO - Top request duration",
            chartType: "horizontalBar",
            name: "cpuusage:CPU-CPU_usage",
            count: 0,
            sort: "none",
            dataGsX: 0,
            dataGsY: 0,
            dataGsWidth: 4,
            dataGsHeight: 4,
        };

        this.chartTiles.push(newWidget);
    };
}