import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';

import { IFlamegraph } from './flamegraph.model';

@Injectable()
export class FlamegraphService {

    private _chartUrl: string = "/api/charts/";

    constructor(private _http: Http) {

    }

    public getChartData(body: any) {

        let headers = new Headers({ 'Content-Type': 'application/json' });
        let options = new RequestOptions({ headers: headers });

        return this._http.post(this._chartUrl, body, options)
                        .map((response: Response) => <IFlamegraph>response.json())
                        .catch(this.handleError);
    }

    private handleError(error: Response) {
        console.error(error);
        return Observable.throw(error.json().error || "Server error");
    }
}