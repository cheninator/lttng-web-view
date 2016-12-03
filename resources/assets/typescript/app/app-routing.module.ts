import { NgModule }             from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { MainDashboardComponent } from './../main-dashboard/main-dashboard.component';


const routes: Routes = [
    { path: '', redirectTo: '/main', pathMatch: 'full' },
    { path: 'main', component: MainDashboardComponent }
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