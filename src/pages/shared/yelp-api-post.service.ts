import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions, URLSearchParams } from '@angular/http';
import { YelpSearchModel } from './../../models/yelpsearch.model';
import 'rxjs/Rx';
import { Observable } from 'rxjs/Observable';

@Injectable()
export class YelpPoster {

    constructor(private http: Http) {
    }

    private extractData(res: Response) {
        let body = res.json();
        return body.data || { };
    }

    private handleError(error: any) {
        console.error('post error: ', error);
        return Observable.throw(error.statusText);
    }


    
    postYelpSearchForm(yelpSearchModel: YelpSearchModel){ 
        let body = new URLSearchParams();
            body.set('term', yelpSearchModel.term);
            body.set('location', yelpSearchModel.location);
            body.set('token', yelpSearchModel.token);
        //let body = JSON.stringify(yelpSearchModel);
        //body = body.replace(/\"([^(\")"]+)\":/g,"$1:");
        console.log('body: ', body);
        //let headers = new Headers({ 'Content-Type': 'application/json' });
        let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });
        let options = new RequestOptions({ headers: headers })

        console.log("testing yelp: ", this.http.post('https://capstone.td9175.com/ci/index.php/YelpHealthServiceRequest/search_query', body, options)
                    .map((res:Response) => res.json())
                    .catch((error:any) => Observable.throw(error.json().error || 'Server error')))

        return this.http.post('https://capstone.td9175.com/ci/index.php/YelpHealthServiceRequest/search_query', body, options)
                    .map((res:Response) => res.json())
                    .catch((error:any) => Observable.throw(error.json().error || 'Server error'));
    }

    getCurrentResult(){
    // empty for now, might be able to use extractData instead
    }
}