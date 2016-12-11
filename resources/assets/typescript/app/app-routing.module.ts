import { NgModule }             from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { MainDashboardComponent } from './../main-dashboard/main-dashboard.component';
import { PHPDashboardComponent } from './../php-dashboard/php-dashboard.component';
import { MySQLDashboardComponent } from './../mysql-dashboard/mysql-dashboard.component';
import { CPUDashboardComponent } from './../cpu-dashboard/cpu-dashboard.component';

import { FlamegraphComponent } from './../flamegraph/flamegraph.component';

const routes: Routes = [
    { path: '', redirectTo: '/main', pathMatch: 'full' },
    { path: 'main', component: MainDashboardComponent },
    { path: 'php', component: PHPDashboardComponent },
    { path: 'cpu', component: CPUDashboardComponent },    
    { path: 'mysql', component: MySQLDashboardComponent },
    { path: 'flamegraph', component: FlamegraphComponent }
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