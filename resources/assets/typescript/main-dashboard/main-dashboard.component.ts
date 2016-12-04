import { Component } from '@angular/core';
import { ChartGridItem } from './../gridstack/gridstack.model';

@Component({
    selector: 'main-dashboard',
    templateUrl: './views/main-dashboard/main-dashboard.component.html',
})
export class MainDashboardComponent {

    private chartTiles: ChartGridItem[];
    
    constructor() { 
        
        this.chartTiles = [
            {
                title: "Apache - Top request duration",
                chartType: "horizontalBar",
                name: "lamptop:Request_ID-Duration",
                dataGsX: 0,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "PHP - Top request duration",
                chartType: "horizontalBar",
                name: "lamptop:Request_ID-PHP_Execution_Duration",
                dataGsX: 6,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "MySQL - Top table duration",
                chartType: "horizontalBar",
                name: "mysql:Table-Duration",
                dataGsX: 0,
                dataGsY: 5,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "CPU - Usage per core",
                chartType: "horizontalBar",
                name: "cpuusage:CPU-CPU_usage",
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
            dataGsX: 0,
            dataGsY: 0,
            dataGsWidth: 4,
            dataGsHeight: 4,
        };

        this.chartTiles.push(newWidget);
    };
}