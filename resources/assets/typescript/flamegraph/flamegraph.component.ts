import { Component, OnInit } from '@angular/core';

declare var d3: any;

@Component({
    selector: 'flamegraph',
    templateUrl: './templates/flamegraph/flamegraph.component.html',
})
export class FlamegraphComponent implements OnInit {
   
    constructor() { 

    }

    public ngOnInit(): void {

        var flameGraph = d3.flameGraph()
            .height(540)
            .width(960)
            .cellHeight(18)
            .transitionDuration(750)
            .transitionEase('cubic-in-out')
            .sort(true)
            .title("");

        // Example on how to use custom tooltips using d3-tip.
        var tip = d3.tip()
            .direction("s")
            .offset([8, 0])
            .attr('class', 'd3-flame-graph-tip')
            .html(function(d) { return "name: " + d.name + ", value: " + d.value; });

        flameGraph.tooltip(tip);

        d3.json("test.json", function(error, data) {
            
            if (error) {
                return console.warn(error);
            }
            d3.select("#chart")
                .datum(data)
                .call(flameGraph);
        });
    }
}