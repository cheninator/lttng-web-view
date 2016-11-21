import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';

import { IChart } from './chart.model';

@Injectable()
export class ChartService {

    private _chartUrl: string = "/api/charts/";

    constructor(private _http: Http) {

    }

    public getChart(name: string): Observable<IChart> {
        return this._http.get(this._chartUrl + name)
                        .map((response: Response) => <IChart>response.json())
                        .catch(this.handleError);
    }

    private handleError(error: Response) {
        console.error(error);
        return Observable.throw(error.json().error || "Server error");
    }
}