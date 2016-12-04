import { Component } from '@angular/core';
import { ChartService } from './../chart/chart.service';

@Component({
	selector: 'app',
	templateUrl: './views/app/app.component.html',
	providers: [ ChartService ]
})

export class AppComponent { }