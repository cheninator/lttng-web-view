import { Component, OnInit, Input } from '@angular/core';
import { ChartGridItem } from './gridstack.model';

declare var $: any;

@Component({
    selector: 'gridstack',
    templateUrl: '/templates/gridstack/gridstack.component.html',
})
export class GridStackComponent implements OnInit {
    
    @Input() gridItems: ChartGridItem[]; 

    constructor() { }

    public ngOnInit(): void {

    }

    public ngAfterViewInit() {
        var options = {
            cellHeight: 80,
            verticalMargin: 10
        };

        $('.grid-stack').gridstack(options);
    }
}