import { Component, OnInit } from '@angular/core';
declare var $: any;

@Component({
    selector: 'gridstack',
    templateUrl: './views/gridstack/gridstack.component.html',
})
export class GridStackComponent implements OnInit {

    private 

    constructor() { }

    public ngOnInit(): void {

        var options = {
            cellHeight: 80,
            verticalMargin: 10
        };

        $('.grid-stack').gridstack(options);
    }
}