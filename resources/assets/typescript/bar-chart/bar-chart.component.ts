import { Component, OnInit, Input } from '@angular/core';
import { ChartService } from './chart.service';
import { IChart } from './chart.model';

@Component({
    selector: 'bar-chart',
    templateUrl: './views/bar-chart/bar-chart.component.html',
})
export class BarChartComponent implements OnInit {

    @Input() name: string;
    
    public type: string = 'bar';
    public legend: boolean = true;
    public labels: string[];
    public datasets: any[];
    public options: any = {
        scaleShowVerticalLines: false,
        responsive: true
    };

    public constructor(private _chartService: ChartService) {
        this.labels = new Array();
        this.datasets = new Array();

        this.datasets.push({
            data: new Array(),
            label: ""
        });
    }

    public ngOnInit(): void {

        this._chartService.getChart(this.name)
            .subscribe(
                (chart) => {
                    this.labels = chart.labels;
                    this.datasets = chart.datasets;                   
                }
            );
    }

    // events
    public chartClicked(e:any):void {
        //console.log(e);
    }

    public chartHovered(e:any):void {
        //console.log(e);
    }
}