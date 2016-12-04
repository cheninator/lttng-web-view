import { Component } from '@angular/core';
import { ChartService } from './../chart/chart.service';

@Component({
	selector: 'app',
	templateUrl: '/templates/app/app.component.html',
	providers: [ ChartService ]
})

export class AppComponent { }