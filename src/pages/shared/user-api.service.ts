import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';

@Injectable()
export class UserApi {

    private baseUrl = 'https://capstone.td9175.com';
    private userid = 'umbcapstone17@gmail.com';
    // for user id.
    // encodeURI(userid);
    baseid = encodeURIComponent(this.userid)
    
    public drugToSearch: any;
    public drugToGetDetails: any;
    public fullData: any;

    constructor(private http: Http) { }

    getUserData(){
        return new Promise(resolve => {
            this.http.get(`${this.baseUrl}/ci/index.php/HealthAccount/hsa/email/${this.baseid}`)
                .subscribe(res => resolve(res.json()));
        });
    }

    // GET request: /UserAccount/user .. if it's logged in, brings up user data: name

    // https://capstone.td9175.com/ci/index.php/HealthAccount/hsa/email/umbcapstone17%40gmail.com
    

    getProductData(){
        return this.http.get(`${this.baseUrl}/ci/index.php/Drugs/search_for_drug/${this.drugToSearch}`).map(res => res.json());
    }

    getProductPrices(){
        return this.http.get(`${this.baseUrl}/ci/index.php/Drugs/price_comparison/${this.drugToGetDetails}`).map(res => res.json());
    }
    
    // Firebase test data:
    // private baseUrl = 'https://capstone17-umbhealth-i2.firebaseio.com';
} 