import { Component } from '@angular/core';
import { ChartService } from './../charts/chart.service';

@Component({
	selector: 'app',
	templateUrl: './views/app/app.component.html',
	providers: [ ChartService ]
})

export class AppComponent { }