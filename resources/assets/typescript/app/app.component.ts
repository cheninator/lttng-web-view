import { Component } from '@angular/core';
import { ChartService } from './../bar-chart/chart.service';

@Component({
	selector: 'my-app',
	templateUrl: './views/app/app.component.html',
	providers: [ ChartService ]
})

export class AppComponent { }
