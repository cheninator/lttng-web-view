import { Component, OnInit, Input } from '@angular/core';
import { FlamegraphService } from './flamegraph.service';
import { IFlamegraph } from './flamegraph.model';

declare var d3: any;

@Component({
    selector: 'flamegraph',
    templateUrl: './templates/flamegraph/flamegraph.component.html',
})
export class FlamegraphComponent implements OnInit {

    constructor(private _flamegraphService: FlamegraphService) { 

    }

    public ngOnInit(): void {

        var flameGraph = d3.flameGraph()
            .height(766)
            .width(1366)
            .cellHeight(18)
            .transitionDuration(750)
            .transitionEase('cubic-in-out')
            .title("");

        // Example on how to use custom tooltips using d3-tip.
        var tip = d3.tip()
            .direction("s")
            .offset([8, 0])
            .attr('class', 'd3-flame-graph-tip')
            .html(function(d) { return "name: " + d.name + ", value: " + d.value; });

        flameGraph.tooltip(tip);

        let body = {
            name: "phptop:flamegraph"
        };

        this._flamegraphService.getChartData(body)
            .subscribe(
                (flamegraph) => {
                    d3.select("#chart")
                        .datum(flamegraph)
                        .call(flameGraph);
                }
            );
    }
}