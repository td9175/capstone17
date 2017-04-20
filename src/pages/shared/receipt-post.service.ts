import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions, URLSearchParams } from '@angular/http';
import { OcrUploadImageModel } from './../../models/ocruploadimage.model';
import 'rxjs/Rx';
import { Observable } from 'rxjs/Observable';

@Injectable()
export class ReceiptPoster {

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
    
    postReceiptForm(ocrUploadModel: OcrUploadImageModel){ 
        let body = new URLSearchParams();
        body.set('uri', ocrUploadModel.localURI);
        console.log('body: ', body);
        let headers = new Headers({ 'Content-Type': 'application/x-www-form-urlencoded' });
        let options = new RequestOptions({ headers: headers })

        return this.http.post('https://capstone.td9175.com/ci/index.php/OCRsomething', body, options)
                    .map((res:Response) => res.json())
                    .catch((error:any) => Observable.throw(error.json().error || 'Server error'));
    }

    getCurrentResult(){
    // empty for now, might be able to use extractData instead
    }
}