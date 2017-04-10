import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { YelpSearchModel } from './../../models/yelpsearch.model';
import 'rxjs/Rx';
import { Observable } from 'rxjs/Observable';

@Injectable()
export class YelpPoster {

    constructor(private http: Http){
    }

    private extractData(res: Response) {
        let body = res.json();
        return body.fields || { };
    }

    private handleError(error: any) {
        console.error('post error: ', error);
        return Observable.throw(error.statusText);
    }
    
    postYelpSearchForm(yelpSearchModel: YelpSearchModel){
        let body = JSON.stringify(yelpSearchModel);
        let headers = new Headers({ 'Content-Type': 'application/json' });
        let options = new RequestOptions({ headers: headers })

        return this.http.post('https://capstone.td9175.com/ci/index.php/YelpHealthServiceRequest/search_query', body, options)
                    .map(this.extractData)
                    .catch(this.handleError);

        //console.log('posting YelpSearch:', yelpSearchModel)
    }
}