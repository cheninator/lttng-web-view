import { Component, OnInit } from '@angular/core';
declare var $: any;

@Component({
    selector: 'gridstack',
    templateUrl: './views/gridstack/gridstack.component.html',
})
export class GridStackComponent implements OnInit {

    constructor() { }

    public ngOnInit(): void {

        var options = {
            cell_height: 80,
            vertical_margin: 10
        };

        $('.grid-stack').gridstack(options);
    }
}