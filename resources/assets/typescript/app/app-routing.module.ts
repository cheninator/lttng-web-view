import { NgModule }             from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { MainDashboardComponent } from './../main-dashboard/main-dashboard.component';
import { FlamegraphComponent } from './../flamegraph/flamegraph.component';

const routes: Routes = [
    { path: '', redirectTo: '/main', pathMatch: 'full' },
    { path: 'main', component: MainDashboardComponent },
    { path: 'php', component: FlamegraphComponent }    
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