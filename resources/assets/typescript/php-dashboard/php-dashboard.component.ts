import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ChartGridItem } from './../gridstack/gridstack.model';

@Component({
    selector: 'php-dashboard',
    templateUrl: './templates/php-dashboard/php-dashboard.component.html',
})
export class PHPDashboardComponent {

    private chartTiles: ChartGridItem[];
    
    constructor() { 
        
        this.chartTiles = [
            {
                title: "Top function duration",
                chartType: "horizontalBar",
                name: "phptop:Function_Name-Function_duration",
                count: 24,
                sort: "DESC",
                dataGsX: 0,
                dataGsY: 0,
                dataGsWidth: 12,
                dataGsHeight: 10,
            }
        ];
    }
}