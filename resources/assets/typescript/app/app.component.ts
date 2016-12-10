import { Component } from '@angular/core';
import { ChartService } from './../chart/chart.service';
import { FlamegraphService } from './../flamegraph/flamegraph.service';

@Component({
	selector: 'app',
	templateUrl: '/templates/app/app.component.html',
	providers: [ ChartService, FlamegraphService ]
})

export class AppComponent { }