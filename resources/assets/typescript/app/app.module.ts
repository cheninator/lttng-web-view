///<reference path="../../../../typings/index.d.ts"/>

import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ChartsModule } from 'ng2-charts/ng2-charts';
import { HttpModule } from '@angular/http';
import { RouterModule } from '@angular/router';
import { AppRoutingModule } from './app-routing.module';

import { AppComponent }   from './app.component';
import { ChartComponent } from './../chart/chart.component';
import { FlamegraphComponent } from './../flamegraph/flamegraph.component';
import { GridStackComponent } from './../gridstack/gridstack.component';

import { MainDashboardComponent } from './../main-dashboard/main-dashboard.component';
import { PHPDashboardComponent } from './../php-dashboard/php-dashboard.component';
import { PHPFlamegraphComponent } from './../php-dashboard/php-flamegraph.component';
import { MySQLDashboardComponent } from './../mysql-dashboard/mysql-dashboard.component';
import { CPUDashboardComponent } from './../cpu-dashboard/cpu-dashboard.component';
import { IOUsageDashboardComponent } from './../io-dashboard/io-usage-dashboard.component';
import { IOLatencyDashboardComponent } from './../io-dashboard/io-latency-dashboard.component';

@NgModule({
	imports: [ 
		BrowserModule, 
		ChartsModule,
		HttpModule,
		AppRoutingModule
	],
	declarations: [ 
		AppComponent, 
		ChartComponent,
		FlamegraphComponent,
		GridStackComponent,

		MainDashboardComponent,
		PHPDashboardComponent,
		PHPFlamegraphComponent,
		MySQLDashboardComponent,
		CPUDashboardComponent,
		IOUsageDashboardComponent,
		IOLatencyDashboardComponent
	],
	bootstrap:    [ AppComponent ]
})

export class AppModule { }
