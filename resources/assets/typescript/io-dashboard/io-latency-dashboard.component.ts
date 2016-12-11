import { Component } from '@angular/core';
import { ChartGridItem } from './../gridstack/gridstack.model';

@Component({
    selector: 'io-latency-dashboard',
    templateUrl: './templates/io-dashboard/io-latency-dashboard.component.html',
})
export class IOLatencyDashboardComponent {

    private chartTiles: ChartGridItem[];
    
    constructor() { 
        
        this.chartTiles = [
            {
                title: "Top system call duration",
                chartType: "horizontalBar",
                name: "iolatencytop:System_call-Call_duration",
                count: 8,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "Top Read-Write operation size per system call",
                chartType: "horizontalBar",
                name: "iolatencytop:System_call-Read_write_size",
                count: 8,
                sort: "DESC",
                dataGsX: 6,
                dataGsY: 0,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
            {
                title: "Top Read-Write operation size per process",
                chartType: "horizontalBar",
                name: "iolatencytop:Process-Read_write_size",
                count: 8,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 5,
                dataGsWidth: 6,
                dataGsHeight: 5,
            },
        ];
    }
}