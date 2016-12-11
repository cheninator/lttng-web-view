import { Component } from '@angular/core';
import { ChartGridItem } from './../gridstack/gridstack.model';

@Component({
    selector: 'cpu-dashboard',
    templateUrl: './templates/cpu-dashboard/cpu-dashboard.component.html',
})
export class CPUDashboardComponent {

    private chartTiles: ChartGridItem[];
    
    constructor() { 
        
        this.chartTiles = [
            {
                title: "CPU usage per CPU",
                chartType: "horizontalBar",
                name: "cputop:CPU-CPU_usage",
                count: 8,
                sort: "NONE",
                dataGsX: 0,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "Top CPU usage per process",
                chartType: "horizontalBar",
                name: "cputop:Process-CPU_usage",
                count: 8,
                sort: "DESC",
                dataGsX: 6,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "Top migration count per process",
                chartType: "horizontalBar",
                name: "cputop:Process-Migration_count",
                count: 8,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 5,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "CPU usage per chronological priorities",
                chartType: "horizontalBar",
                name: "cputop:Chronological_priorities-CPU_usage",
                count: 8,
                sort: "DESC",
                dataGsX: 6,
                dataGsY: 5,
                dataGsWidth: 6,
                dataGsHeight: 5,
            }
        ];
    }
}