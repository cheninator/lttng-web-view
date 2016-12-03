///<reference path="../../../../typings/index.d.ts"/>

import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ChartsModule } from 'ng2-charts/ng2-charts';
import { HttpModule } from '@angular/http';
import { RouterModule } from '@angular/router';
import { AppRoutingModule } from './app-routing.module';

import { AppComponent }   from './app.component';
import { BarChartComponent } from './../charts/bar/bar-chart.component';
import { GridStackComponent } from './../gridstack/gridstack.component';
import { MainDashboardComponent } from './../main-dashboard/main-dashboard.component';

@NgModule({
	imports: [ 
		BrowserModule, 
		ChartsModule,
		HttpModule,
		AppRoutingModule
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
