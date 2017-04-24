import { addHsaModel } from './../../models/addhsa.model';
import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions, URLSearchParams } from '@angular/http';
import 'rxjs/Rx';
import { Observable } from 'rxjs/Observable';

@Injectable()
export class HsaPoster {

    constructor(private http: Http){
    }

    private extractData(res: Response) {
        let body = res.json();
        return body.data || { };
    }

    private handleError(error: any) {
        console.error('post error: ', error);
        return Observable.throw(error.statusText);
    }
    
    postHsaAddForm(addHsaModel: addHsaModel){ 
        let body = new URLSearchParams();
            body.set('email', addHsaModel.email);
            body.set('account_number', addHsaModel.account_number);
            body.set('token', addHsaModel.token);
        //let body = JSON.stringify(yelpSearchModel);
        //body = body.replace(/\"([^(\")"]+)\":/g,"$1:");
        console.log('body: ', body);
        //let headers = new Headers({ 'Content-Type': 'application/json' });
        let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });
        let options = new RequestOptions({ headers: headers })

        console.log("Testing Add Hsa: ", this.http.post('https://capstone.td9175.com/ci/index.php/HealthAccount/hsa', body, options)
                    .map((res:Response) => res.json())
                    .catch((error:any) => Observable.throw(error.json().error || 'Server error')))

        return this.http.post('https://capstone.td9175.com/ci/index.php/HealthAccount/hsa', body, options)
                    .map((res:Response) => res.json())
                    .catch((error:any) => Observable.throw(error.json().error || 'Server error'));
    }

}