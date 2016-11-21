///<reference path="../../../../typings/index.d.ts"/>

import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ChartsModule } from 'ng2-charts/ng2-charts';
import { HttpModule } from '@angular/http';

import { AppComponent }   from './app.component';
import { BarChartComponent } from './../bar-chart/bar-chart.component';
import { GridStackComponent } from './../gridstack/gridstack.component';


@NgModule({
	imports: [ 
		BrowserModule, 
		ChartsModule,
		HttpModule
	],
	declarations: [ 
		AppComponent, 
		BarChartComponent,
		GridStackComponent
	],
	bootstrap:    [ AppComponent ]
})

export class AppModule { }
