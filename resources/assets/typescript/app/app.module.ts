///<reference path="../../../../typings/index.d.ts"/>

import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ChartsModule } from 'ng2-charts/ng2-charts';
import { HttpModule } from '@angular/http';
import { RouterModule } from '@angular/router';

import { AppComponent }   from './app.component';
import { BarChartComponent } from './../bar-chart/bar-chart.component';
import { GridStackComponent } from './../gridstack/gridstack.component';
import { MainDashboardComponent } from './../main-dashboard/main-dashboard.component';

@NgModule({
	imports: [ 
		BrowserModule, 
		ChartsModule,
		HttpModule,
		RouterModule.forRoot([
			{ path: 'main', component: MainDashboardComponent }
		],
		{ useHash: true })
	],
	declarations: [ 
		AppComponent, 
		BarChartComponent,
		GridStackComponent,
		MainDashboardComponent
	],
	bootstrap:    [ AppComponent ]
})

export class AppModule { }
