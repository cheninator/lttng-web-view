import { NgModule }             from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { MainDashboardComponent } from './../main-dashboard/main-dashboard.component';
import { PHPDashboardComponent } from './../php-dashboard/php-dashboard.component';
import { PHPFlamegraphComponent } from './../php-dashboard/php-flamegraph.component';
import { MySQLDashboardComponent } from './../mysql-dashboard/mysql-dashboard.component';
import { CPUDashboardComponent } from './../cpu-dashboard/cpu-dashboard.component';
import { IOUsageDashboardComponent } from './../io-dashboard/io-usage-dashboard.component';
import { IOLatencyDashboardComponent } from './../io-dashboard/io-latency-dashboard.component';

const routes: Routes = [
    { path: '', redirectTo: '/main', pathMatch: 'full' },
    { path: 'main', component: MainDashboardComponent },
    { path: 'php', component: PHPDashboardComponent },
    { path: 'php-flamegraph', component: PHPFlamegraphComponent },    
    { path: 'cpu', component: CPUDashboardComponent },    
    { path: 'mysql', component: MySQLDashboardComponent },
    { path: 'io-usage', component: IOUsageDashboardComponent },
    { path: 'io-latency', component: IOLatencyDashboardComponent },
];

@NgModule({
    imports: [ 
        RouterModule.forRoot(
            routes, 
            { useHash: true }
        )],
    exports: [ RouterModule ]
})

export class AppRoutingModule {}