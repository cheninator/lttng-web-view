import { Component, OnInit, Input } from '@angular/core';
import { ChartService } from './chart.service';
import { IChart } from './chart.model';

@Component({
    selector: 'chart',
    templateUrl: '/templates/chart/chart.component.html',
})
export class ChartComponent implements OnInit {

    @Input() name: string;
    @Input() type: string = 'horizontalBar';
    
    @Input() count: number = 0;
    @Input() sort: string = "";

    public legend: boolean = false;
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

        let body = {
            name: this.name,
            count: this.count,
            sort: this.sort
        };

        this._chartService.getChartData(body)
            .subscribe(
                (chart) => {
                    this.labels = chart.labels;
                    this.datasets = chart.datasets;
                }
            );
    }

    // Events
    public chartClicked(e:any): void {
    }

    public chartHovered(e:any): void {
    }
}