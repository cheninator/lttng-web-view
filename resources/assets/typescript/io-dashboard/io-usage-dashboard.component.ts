import { Component } from '@angular/core';
import { ChartGridItem } from './../gridstack/gridstack.model';

@Component({
    selector: 'io-usage-dashboard',
    templateUrl: './templates/io-dashboard/io-usage-dashboard.component.html',
})
export class IOUsageDashboardComponent {

    private chartTiles: ChartGridItem[];
    
    constructor() { 
        
        this.chartTiles = [
            {
                title: "Total operation size per process",
                chartType: "horizontalBar",
                name: "iousagetop:Process-Total_operations_size",
                count: 8,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "Operation size per process",
                chartType: "horizontalBar",
                name: "iousagetop:Process-Operations_size",
                count: 8,
                sort: "DESC",
                dataGsX: 6,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "Network operation size per process",
                chartType: "horizontalBar",
                name: "iousagetop:Process-Network_operations_size",
                count: 8,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 5,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "Disk operation size per process",
                chartType: "horizontalBar",
                name: "iousagetop:Process-Disk_operations_size",
                count: 8,
                sort: "DESC",
                dataGsX: 6,
                dataGsY: 5,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "Request count per disk",
                chartType: "horizontalBar",
                name: "iousagetop:Disk-Request_count",
                count: 8,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 10,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "Operation size per file path info",
                chartType: "horizontalBar",
                name: "iousagetop:File_path_info-Operations_size",
                count: 8,
                sort: "DESC",
                dataGsX: 6,
                dataGsY: 10,
                dataGsWidth: 6,
                dataGsHeight: 5,
            }            
        ];
    }
}